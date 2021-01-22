<?php

require_once __DIR__.'/../models/Employee.php';
require_once 'Repository.php';

class EmployeeRepository extends Repository {
  public function getEmployee(int $userid) {
    ;
  }

  public function addEmployee(int $userId) {
    $conn = $this->database->connect();
    $idEmpDetail = $this->addEmployeeDetail($conn);

    $stmt = $conn->prepare(
      'INSERT INTO employees (id_users, id_employees_details) VALUES (?, ?)'
    );
    $stmt->execute([$userId, $idEmpDetail]);
  }

  private function addEmployeeDetail($conn) {
    $stmt = $conn->prepare(
      'INSERT INTO employees_details DEFAULT VALUES'
    );
    $conn->beginTransaction();
    $stmt->execute();
    $conn->commit();

    return $conn->lastInsertId();
  }
}