<?php

require_once 'AppController.php';
require_once __DIR__.'/../repository/OrderRepository.php';
require_once __DIR__.'/../repository/ClientRepository.php';
require_once __DIR__.'/../repository/ScheduleRepository.php';


class OrderController extends AppController {
  private $orderRepository;
  private $clientRepository;
  private $scheduleRepository;


  public function __construct() {
    parent::__construct();
    $this->orderRepository = new OrderRepository();
    $this->clientRepository = new ClientRepository();
    $this->scheduleRepository = new ScheduleRepository();
  }

  public function reservations() {
    if (!$this->isSession()) {
      header("Location: {$this->url}/search");
      exit();
    }

    if ($this->isPost()) {
      header("Location: {$this->url}/search");
      exit();
    }

    $clients = $this->clientRepository->getClientsUser($_SESSION['id']);
    $orders = $this->orderRepository->getOrdersReservations($clients);

    $this->render('reservations-page', ['orders' => $orders]);
  }

  public function orders() {
    if (!$this->isSession()) {
      header("Location: {$this->url}/search");
      exit();
    }

    if ($_SESSION['role'] != 'business') {
      header("Location: {$this->url}/search");
      exit();
    }

    if ($this->isPost()) {
      header("Location: {$this->url}/search");
      exit();
    }

    $clients = $this->clientRepository->getClientsEmployee($_SESSION['id']);
    $orders = $this->orderRepository->getOrdersReservations($clients);

    $this->render('orders-page', ['orders' => $orders]);
  }

  public function deleteReservation() {
    if (!$this->isSession()) {
      header("Location: {$this->url}/search");
      exit();
    }

    if (!$this->isPost()) {
      header("Location: {$this->url}/search");
      exit();
    }

    $this->scheduleRepository->unreserveSchedule($_POST['orderid']);
    $this->clientRepository->deleteClient($_POST['clientid']);

    return header("Location: {$this->url}/reservations");
  }

  public function deleteOrder() {
    if (!$this->isSession()) {
      header("Location: {$this->url}/search");
      exit();
    }

    if (!$this->isPost()) {
      header("Location: {$this->url}/search");
      exit();
    }

    $this->scheduleRepository->unreserveSchedule($_POST['orderid']);
    $this->clientRepository->deleteClient($_POST['clientid']);

    return header("Location: {$this->url}/orders");
  }
}