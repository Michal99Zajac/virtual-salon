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

    if ($this->isPost()) {
      $this->update();
    }

    if (!isset($_GET['day'])) {
      if (isset($_POST['day'])) {
        $_GET['day'] = $_POST['day'];
      } else {
        $_GET['day'] = 'Monday';
      }
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

  private function update() {
    if ($_POST['update'] == 'standard-data') {
      $this->userRepository->updateStandard();
    } elseif ($_POST['update'] == 'password-data') {
      $this->userRepository->updatePassword();
    } elseif ($_POST['update'] == 'address-data') {
      $this->userRepository->updateAddress();
    } elseif ($_POST['update'] == 'schedule-del-data') {
      $this->scheduleRepository->deleteSchedule();
    } elseif ($_POST['update'] == 'schedule-add-data') {
      $this->scheduleRepository->addSchedule();
    } elseif ($_POST['update'] == 'description-data') {
      $this->employeeRepository->updateDescription();
    } elseif ($_POST['update'] == 'profession-data') {
      $this->employeeRepository->updateProfession();
    } elseif ($_POST['update'] == 'payment-data') {
      $this->employeeRepository->updatePayment();
    } elseif ($_POST['update'] == 'certificate-data') {
      $this->employeeRepository->updateCertificate();
    } elseif ($_POST['update'] == 'web-data') {
      $this->employeeRepository->updateWeb();
    } elseif ($_POST['update'] == 'exp-data') {
      $this->employeeRepository->updateExp();
    } elseif ($_POST['update'] == 'fav-data') {
      $this->employeeRepository->updateFav();
    } elseif ($_POST['update'] == 'product-del-data') {
      $this->treatmentRepository->deleteTreatment();
    } elseif ($_POST['update'] == 'product-add-data') {
      $this->treatmentRepository->addTreatment();
    }
  }
}