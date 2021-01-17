<?php


class User
{
  private $name;
  private $surname;
  private $email;
  private $pwd;
  private $uid;
  private $role;

  public function __construct(string $uid, string $name, string $surname, string $email, string $pwd)
  {
    $this->uid = $uid;
    $this->name = $name;
    $this->surname = $surname;
    $this->email = $email;
    $this->pwd = $pwd;
  }

  public function getId(): string
  {
    return $this->uid;
  }

  public function getName(): string
  {
    return $this->name;
  }

  public function setName(string $name)
  {
    $this->name = $name;
  }

  public function getSurname(): string
  {
    return $this->surname;
  }

  public function setSurname(string $surname)
  {
    $this->surname = $surname;
  }

  public function getEmail(): string
  {
    return $this->email;
  }

  public function setEmail(string $email)
  {
    $this->email = $email;
  }

  public function getPwd(): string
  {
    return $this->pwd;
  }

  public function setPwd(string $pwd)
  {
    $this->pwd = $pwd;
  }
}
