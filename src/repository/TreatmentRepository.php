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
}