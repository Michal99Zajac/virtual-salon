<?php

require_once 'AppController.php';
require_once __DIR__.'/../repository/EmployeeRepository.php';
require_once __DIR__.'/../repository/UserRepository.php';

class SheetController extends AppController {
  private $employeeRepository;
  private $userRepository;

  public function __construct() {
    parent::__construct();
    $this->employeeRepository = new EmployeeRepository();
    $this->userRepository = new UserRepository();
  }

  public function sheet() {
    if ($this->isPost()) {
      header("Location: {$this->url}/main");
      exit();
    }

    if (!isset($_GET['id'])) {
      header("Location: {$this->url}/main");
      exit();
    }

    if (!isset($_GET['date'])) {
      header("Location: {$this->url}/main");
      exit();
    }

    if (!isset($_GET['hour'])) {
      header("Location: {$this->url}/main");
      exit();
    }

    $employee = $this->employeeRepository->getEmplyeeToSheet($_GET['id'], $_GET['date'], $_GET['hour']);
    if (isset($_SESSION['id'])) {
      $user = $this->userRepository->getUserWithDetails($_SESSION['id']);
      return $this->render('sheet-page', ['employee' => $employee, 'user' => $user]);
    }

    return $this->render('sheet-page', ['employee' => $employee]);
  }
}