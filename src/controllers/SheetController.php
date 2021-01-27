<?php

require_once 'AppController.php';
require_once __DIR__.'/../repository/EmployeeRepository.php';
require_once __DIR__.'/../repository/UserRepository.php';
require_once __DIR__.'/../repository/ClientRepository.php';
require_once __DIR__.'/../repository/ScheduleRepository.php';
require_once __DIR__.'/../repository/OrderRepository.php';
require_once __DIR__.'/../models/Client.php';
require_once __DIR__.'/../models/Treatment.php';

class SheetController extends AppController {
  private $employeeRepository;
  private $userRepository;
  private $clientRepository;
  private $scheduleRepository;
  private $orderRepository;

  public function __construct() {
    parent::__construct();
    $this->employeeRepository = new EmployeeRepository();
    $this->userRepository = new UserRepository();
    $this->clientRepository = new ClientRepository();
    $this->scheduleRepository = new ScheduleRepository();
    $this->orderRepository = new OrderRepository();
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

  public function order() {
    if (!$this->isPost()) {
      header("Location: {$this->url}/main");
      exit();
    }

    if (!$this->emptyInput()) {
      header("Location: {$this->url}/main?date={$_POST['date']}&id={$_POST['id']}&hour={$_POST['hour']}&error=emptyinput");
      exit();
    }

    $client = new Client($_POST['name'], $_POST['surname'], $_POST['city'], $_POST['address'], $_POST['phone'], $_POST['email']);
    if (empty($_POST['ordering_name']) && empty($_POST['ordering_surname'])) {
      $client->setOrderingName($_POST['name']);
      $client->setOrderingSurname($_POST['surname']);
    } else {
      $client->setOrderingName($_POST['ordering_name']);
      $client->setOrderingSurname($_POST['ordering_surname']);
    }

    $clientId = $this->clientRepository->addClient($client);

    $empid = $this->employeeRepository->getEmployeeId($_POST['id']);
    $scheduleId = $this->scheduleRepository->getScheduleId($empid, $_POST['hour'], $_POST['date']);

    $treatments = [];
    foreach ($_POST['treatments'] as $treatment) {
      $treatments[] = new Treatment($treatment, '');
    }

    $this->orderRepository->addOrder($clientId, $scheduleId, $treatments, $empid);

    header("Location: {$this->url}/main");
  }

  private function emptyInput() {
    if (empty($_POST['name'])) {
      return false;
    }

    if (empty($_POST['surname'])) {
      return false;
    }

    if (empty($_POST['city'])) {
      return false;
    }

    if (empty($_POST['address'])) {
      return false;
    }

    if (empty($_POST['phone'])) {
      return false;
    }

    if (empty($_POST['email'])) {
      return false;
    }

    return true;
  }
}