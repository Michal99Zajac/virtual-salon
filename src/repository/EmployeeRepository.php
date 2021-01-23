<?php

require_once __DIR__.'/../models/Employee.php';
require_once 'ProfessionRepository.php';
require_once 'Repository.php';

class EmployeeRepository extends Repository {
  public function getEmployee(int $userid): ?Employee {
    $empDetail = $this->getEmployeeDetail($userid);
    $emp = new Employee();
    $emp->setDescription($empDetail['description']);
    $emp->setFavTreatment($empDetail['favorite_treatment']);
    $emp->setCertificate($empDetail['certificate']);
    $emp->setWeb($empDetail['web']);
    $emp->setLastJob($empDetail['last_job']);

    $profRepository = new ProfessionRepository();
    $emp->setProfession($profRepository->getProfession($empDetail['id_professions'])['name']);

    $payments = $this->getEmployeePayments($empDetail['id_employees_details']);
    $emp->setPayment($payments);

    return $emp;
  }

  public function addEmployee(int $userId): void {
    $conn = $this->database->connect();
    $idEmpDetail = $this->addEmployeeDetail($conn);

    $stmt = $conn->prepare(
      'INSERT INTO employees (id_users, id_employees_details) VALUES (?, ?)'
    );
    $stmt->execute([$userId, $idEmpDetail]);
  }

  public function getEmployeeId(int $userId): ?int {
    $stmt = $this->database->connect()->prepare(
      'SELECT id FROM employees e WHERE e.id_users = :userId'
    );
    $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
    $stmt->execute();
    $empId = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($empId === false) {
      return null;
    }

    return $empId['id'];
  }

  private function addEmployeeDetail($conn): int {
    $stmt = $conn->prepare(
      'INSERT INTO employees_details DEFAULT VALUES'
    );
    $conn->beginTransaction();
    $stmt->execute();
    $conn->commit();

    return $conn->lastInsertId();
  }

  private function getEmployeeDetail($userid) {
    $conn = $this->database->connect();
    $stmt = $conn->prepare(
      'SELECT * FROM employees_details ed RIGHT JOIN employees e on ed.id = e.id_employees_details WHERE e.id_users = :userid'
    );
    $stmt->bindParam(':userid', $userid, PDO::PARAM_STR);
    $stmt->execute();
    $empDetail = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($empDetail === false) {
      return null;
    }

    return $empDetail;
  }

  private function getEmployeePayments($empDetailId) {
    $result = [];
    $stmt = $this->database->connect()->prepare(
      'SELECT name FROM payment_methods pm INNER JOIN payment_methods_employees_details pmed ON pm.id = pmed.id_payment_methods WHERE pmed.id_employees_details = :empDetailId'
    );
    $stmt->bindParam(':empDetailId', $empDetailId, PDO::PARAM_INT);
    $stmt->execute();
    $payments = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($payments === false) {
      return $result;
    }

    foreach ($payments as $payment) {
      $result[] = $payment['name'];
    }

    return $result;
  }
}