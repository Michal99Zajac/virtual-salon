<?php

require_once __DIR__.'/../repository/EmployeeRepository.php';
require_once __DIR__.'/../repository/ProfessionRepository.php';
require_once 'AppController.php';


class WorkersController extends AppController {
  private $employeeRepository;
  private $professionRepository;

  public function __construct() {
    $this->employeeRepository = new EmployeeRepository();
    $this->professionRepository = new ProfessionRepository();
  }

  public function main() {
    if ($this->isPost()) {
      header("Location: {$this->url}/search");
      exit();
    }

    if (isset($_GET['search'])) {
      if ($_GET['search'] == 'person') {
        $employees = $this->employeeRepository->getEmployeesByName($_GET['person']);
      } elseif ($_GET['search'] == 'spec') {
        $employees = $this->employeeRepository->getEmployeesByParams($_GET['city'], $_GET['street'], $_GET['professions']);
      }
    } else {
      $employees = $this->employeeRepository->getEmployees();
    }

    $professions = $this->professionRepository->getProfessions();
    $this->render('main-page', [
      'employees' => $employees,
      'professions' => $professions
    ]);
  }

  public function profile() {
    $employee = null;
    if ($this->isPost()) {
      header("Location: {$this->url}/search");
      exit();
    }

    if (!isset($_GET['id'])) {
      header("Location: {$this->url}/search");
      exit();
    }

    $date = new DateTime();
    if (!isset($_GET['add'])) {
      $employee = $this->employeeRepository->getFullEmployee($_GET['id']);
      $_SESSION['from'] = $date->format('Y-m-d');
    } else {
      $_SESSION['from'] = date('Y-m-d', strtotime($_SESSION['from']."{$_GET['add']} day"));
      $employee = $this->employeeRepository->getFullEmployee($_GET['id'], $_SESSION['from']);
    }

    if (date_create($_SESSION['from']) < date_create($date->format('Y-m-d'))) {
      header("Location: {$this->url}/profile?id={$_GET['id']}");
      exit();
    }

    if ($employee == null) {
      header("Location: {$this->url}/search");
      exit();
    }

    $this->render('profile-page', ['employee' => $employee]);
  }
}