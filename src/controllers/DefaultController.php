<?php

require_once 'AppController.php';

class DefaultController extends AppController {
  public function edit() {
    $this->render('edit-page');
  }

  public function info() {
    $this->render('info-page');
  }

  public function main() {
    $this->render('main-page');
  }

  public function orders() {
    $this->render('orders-page');
  }

  public function profile() {
    $this->render('profile-page');
  }

  public function reservations() {
    $this->render('reservations-page');
  }

  public function sheet() {
    $this->render('sheet-page');
  }

  public function search() {
    $this->render('search-page');
  }

  //public function login() {
  //  $this->render('login-page');
  //}
}
