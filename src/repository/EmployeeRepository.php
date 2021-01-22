<?php

require_once __DIR__.'/../models/Employee.php';
require_once './Repository.php';

class EmployeeRepository extends Repository {
  public function addEmployee(int $userId) {
    $conn = $this->database->connect();

  }
}