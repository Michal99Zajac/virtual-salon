<?php

require_once 'Repository.php';
require_once 'TreatmentRepository.php';
require_once 'ScheduleRepository.php';

class OrderRepository extends Repository {
  public function addOrder($clientId, $scheduleId, $treatments, $empId) {
    $treatmentRepository = new TreatmentRepository();
    $scheduleRepository = new ScheduleRepository();

    $treatmentsIds = $treatmentRepository->getSelectedTreatments($empId, $treatments);
    $conn = $this->database->connect();

    $conn->beginTransaction();
    $stmt = $conn->prepare(
      'INSERT INTO orders (id_schedules_details, id_clients) VALUES (?, ?)'
    );
    $stmt->execute([$scheduleId, $clientId]);
    $conn->commit();
    $orderId = $conn->lastInsertId();

    $scheduleRepository->reserveSchedule($scheduleId);

    foreach ($treatmentsIds as $treatmentsId) {
      $stmt = $conn->prepare('INSERT INTO treatments_orders (id_orders, id_treatments) VALUES (?, ?)');
      $stmt->execute([$orderId, $treatmentsId]);
    };
  }
}