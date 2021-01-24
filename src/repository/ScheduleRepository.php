<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Schedule.php';

class ScheduleRepository extends Repository {
  public function getBasicSchedule($empId) {
    $result = [];
    $stmt = $this->database->connect()->prepare(
      'SELECT day, hour FROM schedules s WHERE s.id_employees = :empId ORDER BY hour'
    );
    $stmt->bindParam(':empId', $empId, PDO::PARAM_INT);
    $stmt->execute();
    $schedules = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($schedules as $schedule) {
      if (!isset($result[$schedule['day']])) {
        $result[$schedule['day']] = [];
      }
      array_push($result[$schedule['day']], new Schedule($schedule['day'], $schedule['hour']));
    }

    return $result;
  }

  public function deleteSchedule() {
    $conn = $this->database->connect();
    $stmt = $conn->prepare(
      'SELECT id FROM employees WHERE id_users = ?'
    );
    $stmt->execute([$_SESSION['id']]);
    $empId = $stmt->fetch(PDO::FETCH_ASSOC)['id'];

    $stmt = $conn->prepare(
      'DELETE FROM schedules WHERE id_employees = ? AND day = ? AND hour = ?'
    );
    $stmt->execute([
      $empId,
      $_POST['day'],
      $_POST['hour']
    ]);
  }

  public function addSchedule() {
    $conn = $this->database->connect();
    $stmt = $conn->prepare(
      'SELECT id FROM employees WHERE id_users = ?'
    );
    $stmt->execute([$_SESSION['id']]);
    $empId = $stmt->fetch(PDO::FETCH_ASSOC)['id'];

    $stmt = $conn->prepare(
      'INSERT INTO schedules (id_employees, day, hour) VALUES (?, ?, ?)'
    );
    $stmt->execute([
      $empId,
      $_POST['day'],
      $_POST['hour']
    ]);
  }
}