<?php


class User
{
  private $name;
  private $surname;
  private $email;
  private $pwd;
  private $role;
  private $date_birth;
  private $country;
  private $phone;
  private $city;
  private $address;

  public function __construct(string $email, string $role = '', string $pwd = '', string $name = '', string $surname = '')
  {
    $this->name = $name;
    $this->surname = $surname;
    $this->email = $email;
    $this->pwd = $pwd;
    $this->role = $role;
  }

  public function getRole(): string {
    return $this->role;
  }

  public function getDateBirth() {
    return $this->date_birth;
  }

  public function setDateBirth($date_birth) {
    $this->date_birth = $date_birth;
  }

  public function getCountry() {
    return $this->country;
  }

  public function setCountry($country) {
    $this->country = $country;
  }

  public function getPhone() {
    return $this->phone;
  }

  public function setPhone($phone) {
    $this->phone = $phone;
  }

  public function getCity() {
    return $this->city;
  }

  public function setCity($city) {
    $this->city = $city;
  }

  public function getAddress() {
    return $this->address;
  }

  public function setAddress($address) {
    $this->address = $address;
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
