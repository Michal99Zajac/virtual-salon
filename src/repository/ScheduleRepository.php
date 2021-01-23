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
}