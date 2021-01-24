<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Treatment.php';

class TreatmentRepository extends Repository {
  public function getTreatments($empId) {
    $result = [];
    $stmt = $this->database->connect()->prepare(
      'SELECT name, price FROM treatments t WHERE t.id_employees = :empId'
    );
    $stmt->bindParam(':empId', $empId, PDO::PARAM_INT);
    $stmt->execute();
    $treatments = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($treatments === false) {
      return $result;
    }

    foreach ($treatments as $treatment) {
      $result[] = new Treatment($treatment['name'], $treatment['price']);
    }

    return $result;
  }

  public function deleteTreatment() {
    $conn = $this->database->connect();
    $stmt = $conn->prepare(
      'SELECT id FROM employees WHERE id_users = ?'
    );
    $stmt->execute([$_SESSION['id']]);
    $empId = $stmt->fetch(PDO::FETCH_ASSOC)['id'];

    $stmt = $conn->prepare(
      'DELETE FROM treatments WHERE name = ? AND id_employees = ?'
    );
    $stmt->execute([$_POST['name'], $empId]);
  }

  public function addTreatment() {
    if (!$_POST['name'] || !$_POST['price']) {
      return null;
    }

    $conn = $this->database->connect();
    $stmt = $conn->prepare(
      'SELECT id FROM employees WHERE id_users = ?'
    );
    $stmt->execute([$_SESSION['id']]);
    $empId = $stmt->fetch(PDO::FETCH_ASSOC)['id'];

    $stmt = $conn->prepare(
      'INSERT INTO treatments (id_employees, name, price) VALUES (?, ?, ?)'
    );
    $stmt->execute([$empId, $_POST['name'], $_POST['price']]);
  }
}