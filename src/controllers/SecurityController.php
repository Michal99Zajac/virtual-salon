<?php

require_once 'AppController.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__.'/../repository/UserRepository.php';


class SecurityController extends AppController {
  private $userRepository;

  public function __construct()
  {
    parent::__construct();
    $this->userRepository = new UserRepository();
  }

  public function login()
  {
    if ($this->isSession()) {
      header("Location: {$this->url}/search");
      exit();
    }

    if (!$this->isPost()) {
      return $this->render('login-page');
    }

    $email = $_POST['email'];
    $pwd = $_POST['pwd'];

    if ($this->emptyInputLogin($email, $pwd)) {
      header("Location: {$this->url}/login?error=emptyinput");
      exit();
    }

    $user = $this->userExists($email);
    if ($user === false) {
      header("Location: {$this->url}/login?error=userdoesntexists");
      exit();
    }

    if (!$this->pwdCorrect($pwd, $user->getPwd())) {
      header("Location: {$this->url}/login?error=badpassword");
      exit();
    }

    $this->loginUser($user);
    header("Location: {$this->url}/search");
  }

  public function register() {
    if ($this->isSession()) {
      header("Location: {$this->url}/search");
      exit();
    }

    if (!$this->isPost()) {
      return $this->render('account-page');
    }

    $email = $_POST['email'];
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $pwd = $_POST['pwd'];
    $pwdRepeat = $_POST['pwdrepeat'];
    $role = $_POST['role'];

    if ($this->emptyInputSignup($email, $name, $surname, $pwd, $pwdRepeat, $role) !== false) {
      header("Location: {$this->url}/register?error=emptyinput");
      exit();
    }

    if ($this->invalidEmail($email) !== false) {
      header("Location: {$this->url}/register?error=invalidemail");
      exit();
    }

    if ($this->pwdMatch($pwd, $pwdRepeat) !== false) {
      header("Location: {$this->url}/register?error=passwordsdontmatch");
      exit();
    }

    if ($this->userExists($email) !== false) {
      header("Location: {$this->url}/register?error=userexists");
      exit();
    }

    $user = new User($email, $pwd, $role, $name, $surname);

    $this->registerUser($user);
    return $this->render('search-page');
  }

  private function registerUser(User $user) {
    $this->userRepository->addUser($user);
  }

  private function loginUser(User $user) {
    $_SESSION['email'] = $user->getEmail();
    $_SESSION['role'] = $user->getRole();
    $_SESSION['id'] = $this->userRepository->getUserId($user->getEmail());
  }

  private function emptyInputSignup($email, $name, $surname, $pwd, $pwdRepeat, $role) {
    $result = false;
    if (empty($email) || empty($name) || empty($surname) || empty($pwd) || empty($pwdRepeat) || empty($role)) {
      $result = true;
    }
    return $result;
  }

  private function emptyInputLogin($email, $pwd) {
    $result = false;
    if (empty($email) || empty($pwd)) {
      $result = true;
    }
    return $result;
  }

  private function invalidEmail($email) {
    $result = false;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $result = true;
    }
    return $result;
  }

  private function pwdMatch($pwd, $pwdRepeat) {
    $result = false;
    if ($pwd !== $pwdRepeat) {
      $result = true;
    }
    return $result;
  }

  private function userExists($email) {
    $user = $this->userRepository->getUserByEmail($email);
    if ($user) {
      return $user;
    } else {
      $result = false;
      return $result;
    }
  }

  private function pwdCorrect($pwd, $hashedPwd) {
    $checkedPwd = password_verify($pwd, $hashedPwd);
    return $checkedPwd;
  }
}