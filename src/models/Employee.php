<?php


class Employee {
  private $treatments;
  private $schedules;

  private $description;
  private $favTreatment;
  private $certificate;
  private $web;
  private $lastJob;
  private $profession;

  public function getTreatments() {
    return $this->treatments;
  }

  public function setTreatments($treatments) {
    $this->treatments = $treatments;
  }

  public function getSchedules() {
    return $this->schedules;
  }

  public function setSchedules($schedules) {
    $this->schedules = $schedules;
  }

  public function getDescription() {
    return $this->description;
  }

  public function setDescription($description) {
    $this->description = $description;
  }

  public function getFavTreatment() {
    return $this->favTreatment;
  }

  public function setFavTreatment($favTreatment) {
    $this->favTreatment = $favTreatment;
  }

  public function getCertificate() {
    return $this->certificate;
  }

  public function setCertificate($certificate) {
    $this->certificate = $certificate;
  }

  public function getWeb() {
    return $this->web;
  }

  public function setWeb($web) {
    $this->web = $web;
  }

  public function getLastJob() {
    return $this->lastJob;
  }

  public function setLastJob($lastJob) {
    $this->lastJob = $lastJob;
  }

  public function getProfession() {
    return $this->profession;
  }

  public function setProfession($profession) {
    $this->profession = $profession;
  }


}