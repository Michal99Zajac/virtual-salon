<?php


class Schedule {
  private $day;
  private $hour;
  private $reserved;
  private $date;

  public function __construct($day, $hour) {
    $this->name = $name;
    $this->hour = $hour;
  }

  public function getDay() {
    return $this->name;
  }

  public function setDay($name) {
    $this->name = $name;
  }

  public function getHour() {
    return $this->hour;
  }

  public function setHour($hour) {
    $this->hour = $hour;
  }

  public function getReserved() {
    return $this->reserved;
  }

  public function setReserved($reserved) {
    $this->reserved = $reserved;
  }

  public function getDate() {
    return $this->date;
  }

  public function setDate($date) {
    $this->date = $date;
  }
}