<?php

require_once 'Repository.php';

class PaymentRepository extends Repository {
  public function getPayments() {
    $stmt = $this->database->connect()->prepare(
      'SELECT * FROM payment_methods'
    );
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
}