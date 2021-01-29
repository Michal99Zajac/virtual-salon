<?php

require_once 'AppController.php';
require_once __DIR__.'/../repository/UserRepository.php';
require_once __DIR__.'/../repository/EmployeeRepository.php';

class DeleteController extends AppController {
  public function delete() {
    if (!$this->isSession()) {
      header("Location: {$this->url}/search");
      exit();
    }

    if (!$this->isPost()) {
      header("Location: {$this->url}/info");
      exit();
    }

    $deleted = false;
    if ($_SESSION['role'] == 'business') {
      $employeRepository = new EmployeeRepository();
      $deleted = $employeRepository->deleteEmployee($_SESSION['id']);
    } else {
      $userRepository = new UserRepository();
      $deleted = $userRepository->deleteUser($_SESSION['id']);
    }

    if ($deleted) {
      return $this->logout();
    }

    return header("Location: {$this->url}/info");
  }
}