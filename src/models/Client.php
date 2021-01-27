<?php


class Client {
  private $name;
  private $surname;
  private $ordering_name;
  private $ordering_surname;
  private $city;
  private $address;
  private $phone;
  private $email;

  public function __construct($name, $surname, $city, $address, $phone, $email) {
    $this->name = $name;
    $this->surname = $surname;
    $this->city = $city;
    $this->address = $address;
    $this->phone = $phone;
    $this->email = $email;
  }

  public function getName() {
    return $this->name;
  }

  public function setName($name): void {
    $this->name = $name;
  }

  public function getSurname() {
    return $this->surname;
  }

  public function setSurname($surname): void {
    $this->surname = $surname;
  }

  public function getOrderingName() {
    return $this->ordering_name;
  }

  public function setOrderingName($ordering_name): void {
    $this->ordering_name = $ordering_name;
  }

  public function getOrderingSurname() {
    return $this->ordering_surname;
  }

  public function setOrderingSurname($ordering_surname): void {
    $this->ordering_surname = $ordering_surname;
  }

  public function getCity() {
    return $this->city;
  }

  public function setCity($city): void {
    $this->city = $city;
  }

  public function getAddress() {
    return $this->address;
  }

  public function setAddress($address): void {
    $this->address = $address;
  }

  public function getPhone() {
    return $this->phone;
  }

  public function setPhone($phone): void {
    $this->phone = $phone;
  }

  public function getEmail() {
    return $this->email;
  }

  public function setEmail($email): void {
    $this->email = $email;
  }

}