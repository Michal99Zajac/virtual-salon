<?php

require_once 'AppController.php';
require_once __DIR__.'/../repository/UserRepository.php';
require_once __DIR__.'/../models/User.php';

class ProfileController extends AppController {
  private $userRepository;

  public function __construct() {
    parent::__construct();
    $this->userRepository = new UserRepository();
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

    return $this->render('info-page', ['user' => $user]);
  }

  private function isEmployee(User $user) {
    ;
  }
}