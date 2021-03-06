<?php

require_once __DIR__.'/../models/Employee.php';
require_once 'ProfessionRepository.php';
require_once 'TreatmentRepository.php';
require_once 'ScheduleRepository.php';
require_once 'Repository.php';

class EmployeeRepository extends Repository {
  public function getFullEmployee(int $userid, $dateFrom=0) {
    $professionRepository = new ProfessionRepository();
    $treatmentRepository = new TreatmentRepository();
    $scheduleRepository = new ScheduleRepository();
    $conn = $this->database->connect();
    $stmt = $conn->prepare(
      'SELECT * FROM users_details ud INNER JOIN (SELECT * FROM users u
      INNER JOIN (SELECT *, e.id as empid FROM employees e
      INNER JOIN employees_details ed ON ed.id = e.id_employees_details) e ON e.id_users = u.id) eu 
      ON eu.id_users_details = ud.id WHERE id_users = ?'
    );
    $stmt->execute([$userid]);
    $employee = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($employee === false) {
      return null;
    }

    $emp = new Employee($employee['email']);
    $emp->setName($employee['name']);
    $emp->setSurname($employee['surname']);
    $emp->setDateBirth($employee['date_of_birth']);
    $emp->setCountry($employee['country']);
    $emp->setPhone($employee['phone']);
    $emp->setDescription($employee['description']);
    $emp->setLastJob($employee['last_job']);
    $emp->setWeb($employee['web']);
    $emp->setCertificate($employee['certificate']);
    $emp->setFavTreatment($employee['favorite_treatment']);
    $emp->setCity($employee['city']);
    $emp->setAddress($employee['address']);

    $emp->setPayment($this->getEmployeePayments($employee['id_employees_details']));
    $emp->setProfession($professionRepository->getProfession($employee['id_professions'])['name']);
    $emp->setTreatments($treatmentRepository->getTreatments($employee['empid']));
    $emp->setSchedules($scheduleRepository->getScheduleFrom($employee['empid'], $dateFrom));

    return $emp;
  }

  public function getEmplyeeToSheet(int $userId, $date, $hour): ?Employee {
    $professionRepository = new ProfessionRepository();
    $treatmentRepository = new TreatmentRepository();
    $scheduleRepository = new ScheduleRepository();
    $conn = $this->database->connect();
    $stmt = $conn->prepare(
      'SELECT * FROM users_details ud INNER JOIN (SELECT * FROM users u
      INNER JOIN (SELECT *, e.id as empid FROM employees e
      INNER JOIN employees_details ed ON ed.id = e.id_employees_details) e ON e.id_users = u.id) eu 
      ON eu.id_users_details = ud.id WHERE id_users = ?'
    );
    $stmt->execute([$userId]);
    $employee = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($employee === false) {
      return null;
    }

    $emp = new Employee($employee['email']);
    $emp->setName($employee['name']);
    $emp->setSurname($employee['surname']);
    $emp->setDateBirth($employee['date_of_birth']);
    $emp->setCountry($employee['country']);
    $emp->setPhone($employee['phone']);
    $emp->setDescription($employee['description']);
    $emp->setLastJob($employee['last_job']);
    $emp->setWeb($employee['web']);
    $emp->setCertificate($employee['certificate']);
    $emp->setFavTreatment($employee['favorite_treatment']);
    $emp->setCity($employee['city']);
    $emp->setAddress($employee['address']);

    $emp->setPayment($this->getEmployeePayments($employee['id_employees_details']));
    $emp->setProfession($professionRepository->getProfession($employee['id_professions'])['name']);
    $emp->setTreatments($treatmentRepository->getTreatments($employee['empid']));
    $emp->setSchedules($scheduleRepository->getScheduleToSheet($employee['empid'], $date, $hour));

    return $emp;
  }

  public function getEmployeeFromId($empId) {
    $stmt = $this->database->connect()->prepare(
      'SELECT * FROM employees e INNER JOIN (SELECT email, surname, u.id as id, name, phone FROM users u INNER JOIN users_details ud ON u.id_users_details = ud.id) ud ON ud.id = e.id_users WHERE e.id = ?'
    );
    $stmt->execute([$empId]);
    $employee = $stmt->fetch(PDO::FETCH_ASSOC);
    $emp = new Employee($employee['email']);
    $emp->setName($employee['name']);
    $emp->setSurname($employee['surname']);
    $emp->setPhone($employee['phone']);

    return $emp;
  }

  public function getEmployee(int $userid): ?Employee {
    $empDetail = $this->getEmployeeDetail($userid);
    $emp = new Employee('');
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

  public function getEmployees() {
    $conn = $this->database->connect();
    $stmt = $conn->prepare(
      'SELECT name, surname, profession, description, email, empId, e.id as id FROM users_details ud
      INNER JOIN (SELECT profession, description, email, id_users_details, id, empId FROM users u
      INNER JOIN (SELECT description, name as profession, e.id_users, e.id as empId FROM employees e LEFT JOIN professions p
      ON p.id = e.id_professions) e ON e.id_users = u.id) e ON ud.id = e.id_users_details'
    );
    $stmt->execute();
    $employees = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $result = $this->composeEmployee($employees);

    return $result;
  }

  public function getEmployeesByName(string $fullname) {
    $full = explode(' ', $fullname);
    $name = '_';
    $surname = '_';

    if (count($full) == 2) {
      $name = '%'.strtolower($full[0]).'%';
      $surname = '%'.strtolower($full[1]).'%';
    } else {
      $name = '%'.strtolower($full[0]).'%';
      $surname = '%'.strtolower($full[0]).'%';
    }

    $conn = $this->database->connect();
    $stmt = $conn->prepare(
      "SELECT name, surname, profession, description, email, empId, e.id as id FROM users_details ud
      INNER JOIN (SELECT profession, description, email, id_users_details, id, empId FROM users u
      INNER JOIN (SELECT description, name as profession, e.id_users, e.id as empId FROM employees e LEFT JOIN professions p
      ON p.id = e.id_professions) e ON e.id_users = u.id) e ON ud.id = e.id_users_details WHERE name LIKE ? OR surname LIKE ?"
    );
    $stmt->execute([$name, $surname]);
    $employees = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $result = $this->composeEmployee($employees);

    return $result;
  }

  public function getEmployeesByParams($city, $street, $professions = []) {
    $condition = $this->composeCondition($city, $street, $professions);
    $conn = $this->database->connect();
    $stmt = $conn->prepare(
      "SELECT name, surname, profession, description, email, empId, e.id as id, city, address FROM users_details ud
      INNER JOIN (SELECT profession, description, email, id_users_details, id, empId FROM users u
      INNER JOIN (SELECT e.description, p.name as profession, e.id_users, e.id as empId FROM employees e LEFT JOIN professions p
      ON p.id = e.id_professions) e ON e.id_users = u.id) e ON ud.id = e.id_users_details" . $condition
    );
    $stmt->execute();
    $employees = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $result = $this->composeEmployee($employees);

    return $result;
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

  // start update section
  public function updateDescription() {
    if (strlen($_POST['description']) > 1024) {
      return null;
    }

    $stmt = $this->database->connect()->prepare(
      'UPDATE employees SET description = ? WHERE id_users = ?'
    );
    $stmt->execute([
      $_POST['description'],
      $_SESSION['id']
    ]);
  }

  public function updateProfession() {
    $conn = $this->database->connect();
    $stmt = $conn->prepare(
      'SELECT id FROM employees WHERE id_users = ?'
    );
    $stmt->execute([$_SESSION['id']]);
    $empId = $stmt->fetch(PDO::FETCH_ASSOC)['id'];

    $profRepository = new ProfessionRepository();
    $professionId = $profRepository->getProfessionId($_POST['profession']);

    $stmt = $conn->prepare(
      'UPDATE employees SET id_professions = ? WHERE id = ?'
    );
    $stmt->execute([
      $professionId,
      $empId
    ]);
  }

  public function updatePayment() {
    $conn = $this->database->connect();
    $id = $this->getEmployeeDetail($_SESSION['id'])['id_employees_details'];

    $stmt = $conn->prepare(
      'DELETE FROM payment_methods_employees_details WHERE id_employees_details = ?'
    );
    $stmt->execute([$id]);

    if (isset($_POST['payment-cash'])) {
      $stmt = $conn->prepare(
        'SELECT id FROM payment_methods WHERE name = ?'
      );
      $stmt->execute([$_POST['payment-cash']]);
      $paymentId = $stmt->fetch(PDO::FETCH_ASSOC)['id'];

      $stmt = $conn->prepare(
        'INSERT INTO payment_methods_employees_details (id_employees_details, id_payment_methods)  VALUES (?, ?)'
      );
      $stmt->execute([$id, $paymentId]);
    }

    if (isset($_POST['payment-terminal'])) {
      $stmt = $conn->prepare(
        'SELECT id FROM payment_methods WHERE name = ?'
      );
      $stmt->execute([$_POST['payment-terminal']]);
      $paymentId = $stmt->fetch(PDO::FETCH_ASSOC)['id'];

      $stmt = $conn->prepare(
        'INSERT INTO payment_methods_employees_details (id_employees_details, id_payment_methods)  VALUES (?, ?)'
      );
      $stmt->execute([$id, $paymentId]);
    }

    if (isset($_POST['payment-app'])) {
      $stmt = $conn->prepare(
        'SELECT id FROM payment_methods WHERE name = ?'
      );
      $stmt->execute([$_POST['payment-app']]);
      $paymentId = $stmt->fetch(PDO::FETCH_ASSOC)['id'];

      $stmt = $conn->prepare(
        'INSERT INTO payment_methods_employees_details (id_employees_details, id_payment_methods)  VALUES (?, ?)'
      );
      $stmt->execute([$id, $paymentId]);
    }
  }

  public function updateCertificate() {
    $conn = $this->database->connect();
    $id = $this->getEmployeeDetail($_SESSION['id'])['id_employees_details'];

    $stmt = $conn->prepare(
      'UPDATE employees_details SET certificate = ? WHERE id = ?'
    );
    $stmt->execute([$_POST['certificate'], $id]);
  }

  public function updateWeb() {
    $conn = $this->database->connect();
    $id = $this->getEmployeeDetail($_SESSION['id'])['id_employees_details'];

    $stmt = $conn->prepare(
      'UPDATE employees_details SET web = ? WHERE id = ?'
    );
    $stmt->execute([$_POST['web'], $id]);
  }

  public function updateExp() {
    $conn = $this->database->connect();
    $id = $this->getEmployeeDetail($_SESSION['id'])['id_employees_details'];

    $stmt = $conn->prepare(
      'UPDATE employees_details SET last_job = ? WHERE id = ?'
    );
    $stmt->execute([$_POST['exp'], $id]);
  }

  public function updateFav() {
    $conn = $this->database->connect();
    $id = $this->getEmployeeDetail($_SESSION['id'])['id_employees_details'];

    $stmt = $conn->prepare(
      'UPDATE employees_details SET favorite_treatment = ? WHERE id = ?'
    );
    $stmt->execute([$_POST['fav'], $id]);
  }
  // end update section

  public function deleteEmployee($userid) {
    $userRepositoty = new UserRepository();
    $conn = $this->database->connect();

    $stmt = $conn->prepare(
      'SELECT * FROM clients c INNER JOIN
      (SELECT id_clients FROM orders o INNER JOIN
      (SELECT id as sdid, empid FROM schedules_details sd INNER JOIN
      (SELECT s.id as schid, e.id as empid FROM schedules s INNER JOIN
      (SELECT id FROM employees e WHERE e.id_users = ?) e ON e.id = s.id_employees) e
      ON sd.id_schedules =  e.schid) sd ON sd.sdid = o.id_schedules_details) o
      ON o.id_clients = c.id'
    );
    $stmt->execute([$userid]);
    $invalid = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($invalid) {
      return false;
    }

    $stmt = $conn->prepare(
      'SELECT id as edid FROM employees_details ed INNER JOIN 
    (SELECT id_employees_details FROM employees e INNER JOIN users u ON u.id = e.id_users 
    WHERE u.id = ?) e ON e.id_employees_details = ed.id'
    );
    $stmt->execute([$userid]);
    $edid = $stmt->fetch(PDO::FETCH_ASSOC)['edid'];

    $valid = $userRepositoty->deleteUser($userid);

    if (!$valid) {
      return false;
    }

    $stmt = $conn->prepare(
      'DELETE FROM employees_details WHERE id = ?'
    );
    $stmt->execute([$edid]);

    return true;
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

  private function composeEmployee($employees) {
    $treatmentRepository = new TreatmentRepository();
    $scheduleRepository = new ScheduleRepository();
    $result = [];

    foreach ($employees as $employee) {
      $emp = new Employee($employee['email']);
      $emp->setName($employee['name']);
      $emp->setSurname($employee['surname']);
      $emp->setProfession($employee['profession']);
      $emp->setDescription($employee['description']);
      $emp->setTreatments(
        $treatmentRepository->getTreatments($employee['empid'])
      );
      $emp->setSchedules(
        $scheduleRepository->getThreeShedule($employee['empid'])
      );
      $result[$employee['id']] = $emp;
    }

    return $result;
  }

  private function composeCondition($city, $street, $professions = []) {
    $substmt = [];

    if (!$city == '') {
      $city = strtolower($city);
      $substmt[] = "LOWER(city) LIKE '%{$city}%'";
    }

    if (!$street == '') {
      $street = strtolower($street);
      $substmt[] = "LOWER(address) LIKE '%{$street}%'";
    }

    if (!$professions == []) {
      $values = '';
      for($i=0; $i < count($professions); $i++) {
        if ($i == 0) {
          $values = "'" . $professions[$i] . "'";
        } else {
          $values = $values . ' , ' . "'" . $professions[$i] . "'";
        }
      }
      $substmt[] = "profession IN ({$values})";
    }

    $condition = '';
    for ($i=0; $i < count($substmt); $i++) {
      if ($i == 0) {
        $condition = ' WHERE ' . $substmt[$i];
      } else {
        $condition = $condition . ' AND ' . $substmt[$i];
      }
    }

    return $condition;
  }
}