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

  public function getScheduleFrom($empId, $dateFrom = '') {
    $result = [];
    $from = '';
    if ($dateFrom == '') {
      $dateTime = new DateTime();
      $from = $dateTime->format('Y-m-d');
    } else {
      $from = $dateFrom;
    }

    $result[date('Y-m-d', strtotime($from))] = [];
    $result[date('Y-m-d', strtotime($from . "+1 day"))] = [];
    $result[date('Y-m-d', strtotime($from . "+2 day"))] = [];
    $result[date('Y-m-d', strtotime($from . "+3 day"))] = [];
    $result[date('Y-m-d', strtotime($from . "+4 day"))] = [];
    $result[date('Y-m-d', strtotime($from . "+5 day"))] = [];

    $conn = $this->database->connect();
    $stmt = $conn->prepare(
      'SELECT * FROM schedules s LEFT JOIN schedules_details sd on s.id = sd.id_schedules 
      WHERE id_employees = ? 
      AND ( sd.date = ? OR sd.date = ? OR sd.date = ? OR sd.date = ? OR sd.date = ? OR sd.date = ? OR sd.date is NULL ) 
      AND (s.day = ? OR s.day = ? OR s.day = ? OR s.day = ? OR s.day = ? OR s.day = ?) ORDER BY hour'
    );
    $stmt->execute([
      $empId,
      $from,
      date('Y-m-d', strtotime($from . "+1 day")),
      date('Y-m-d', strtotime($from . "+2 day")),
      date('Y-m-d', strtotime($from . "+3 day")),
      date('Y-m-d', strtotime($from . "+4 day")),
      date('Y-m-d', strtotime($from . "+5 day")),
      date('l', strtotime(date('Y-m-d', strtotime($from)))),
      date('l', strtotime(date('Y-m-d', strtotime($from . "+1 day")))),
      date('l', strtotime(date('Y-m-d', strtotime($from . "+2 day")))),
      date('l', strtotime(date('Y-m-d', strtotime($from . "+3 day")))),
      date('l', strtotime(date('Y-m-d', strtotime($from . "+4 day")))),
      date('l', strtotime(date('Y-m-d', strtotime($from . "+5 day"))))
    ]);

    $schedules = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($schedules as $schedule) {
      $sch = new Schedule($schedule['day'], $schedule['hour']);
      $sch->setReserved($schedule['reserved']);
      $sch->setDate(date('Y-m-d', strtotime("next {$schedule['day']}", strtotime($from . '-1 day'))));

      array_push($result[$sch->getDate()], $sch);
    }

    return $result;
  }

  public function getThreeShedule($empId) {
    $result = [];
    $date = new DateTime();
    $today = $date->format('Y-m-d');
    $tomorrow = date('Y-m-d', strtotime($today . '+1 day'));
    $dayafter = date('Y-m-d', strtotime($today . '+2 day'));
    $todayDay = date('l', strtotime($today));
    $tomorrowDay = date('l', strtotime($tomorrow));
    $dayafterDay = date('l', strtotime($dayafter));

    $result[$today] = [];
    $result[$tomorrow] = [];
    $result[$dayafter] = [];

    $conn = $this->database->connect();
    $stmt = $conn->prepare(
      'SELECT * FROM schedules s LEFT JOIN schedules_details sd on s.id = sd.id_schedules 
    WHERE id_employees = ? 
    AND ( sd.date = ? OR sd.date = ? OR sd.date = ? OR sd.date is NULL ) 
    AND (s.day = ? OR s.day = ? OR s.day = ?) ORDER BY hour'
    );
    $stmt->execute([$empId, $today, $tomorrow, $dayafter, $todayDay, $tomorrowDay, $dayafterDay]);
    $schedules = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($schedules as $schedule) {
      $sch = new Schedule($schedule['day'], $schedule['hour']);
      $sch->setReserved($schedule['reserved']);
      $sch->setDate(date('Y-m-d', strtotime("next {$schedule['day']}", strtotime($today . '-1 day'))));

      array_push($result[$sch->getDate()], $sch);
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