<?php

require_once __DIR__.'/../repository/UserRepository.php';
require_once __DIR__.'/../repository/EmployeeRepository.php';
require_once __DIR__.'/../repository/ScheduleRepository.php';
require_once __DIR__.'/../repository/TreatmentRepository.php';
require_once __DIR__.'/../repository/ProfessionRepository.php';
require_once __DIR__.'/../repository/PaymentRepository.php';
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
}