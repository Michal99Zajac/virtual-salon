<?php

require_once 'AppController.php';
require_once __DIR__.'/../repository/UserRepository.php';
require_once __DIR__.'/../repository/EmployeeRepository.php';
require_once __DIR__.'/../repository/ScheduleRepository.php';
require_once __DIR__.'/../repository/TreatmentRepository.php';
require_once __DIR__.'/../models/User.php';

class ProfileController extends AppController {
  private $userRepository;
  private $employeeRepository;
  private $scheduleRepository;
  private $treatmentRepository;

  public function __construct() {
    parent::__construct();
    $this->userRepository = new UserRepository();
    $this->employeeRepository = new EmployeeRepository();
    $this->scheduleRepository = new ScheduleRepository();
    $this->treatmentRepository = new TreatmentRepository();
  }

  public function edit() {
    if (!$this->isSession()) {
      header("Location: {$this->url}/search");
      exit();
    }

    if (!$this->isGet()) {
      return $this->render('search-page');
    }

    if(!$this->isItForMe()) {
      header("Location: {$this->url}/search?error=notforyou");
      exit();
    }

    $user = $this->userRepository->getUserWithDetails($_SESSION['id']);
    if (!$user) {
      header("Location: {$this->url}/search?error=noneuser");
      exit();
    }

    if ($user->getRole() == 'business') {
      $employee = $this->employeeRepository->getEmployee($_SESSION['id']);
      $empId = $this->employeeRepository->getEmployeeId($_SESSION['id']);

      $schedules = $this->scheduleRepository->getBasicSchedule($empId);
      $treatments = $this->treatmentRepository->getTreatments($empId);

      return $this->render('edit-page', [
        'user' => $user,
        'employee' => $employee,
        'schedules' => $schedules,
        'treatments' => $treatments
      ]);
    }

    return $this->render('edit-page', ['user' => $user]);
  }

  public function info() {
    if (!$this->isSession()) {
      header("Location: {$this->url}/search");
      exit();
    }

    if (!$this->isGet()) {
      return $this->render('search-page');
    }

    if(!$this->isItForMe()) {
      header("Location: {$this->url}/search?error=notforyou");
      exit();
    }

    $user = $this->userRepository->getUserWithDetails($_SESSION['id']);
    if (!$user) {
      header("Location: {$this->url}/search?error=noneuser");
      exit();
    }

    if ($user->getRole() == 'business') {
      $employee = $this->employeeRepository->getEmployee($_SESSION['id']);
      $empId = $this->employeeRepository->getEmployeeId($_SESSION['id']);

      $schedules = $this->scheduleRepository->getBasicSchedule($empId);
      $treatments = $this->treatmentRepository->getTreatments($empId);

      return $this->render('info-page', [
        'user' => $user,
        'employee' => $employee,
        'schedules' => $schedules,
        'treatments' => $treatments
      ]);
    }

    return $this->render('info-page', ['user' => $user]);
  }
}