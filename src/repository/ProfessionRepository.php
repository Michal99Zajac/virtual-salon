<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Profession.php';

class ProfessionRepository extends Repository {
  public function getProfessionId(string $name) {
    $stmt = $this->database->connect()->prepare(
      'SELECT id FROM professions WHERE name = :name'
    );
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->execute();
    $id = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($id === false) {
      $id = $this->addProfession($name);
      return $id;
    }
    return $id['id'];
  }

  public function getProfession($id) {
    $stmt = $this->database->connect()->prepare(
      'SELECT * FROM professions p WHERE p.id = :id'
    );
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $profession = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($profession == false) {
      return null;
    }

    return $profession;
  }

  public function addProfession(string $name) {
    $conn = $this->database->connect();
    $stmt = $conn->prepare(
      'INSERT INTO professions (name) VALUES (:name)'
    );
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $conn->beginTransaction();
    $stmt->execute();
    $conn->commit();

    return $conn->lastInsertId();
  }

  public function getProfessions() {
    $result = [];
    $stmt = $this->database->connect()->prepare(
      'SELECT * FROM professions'
    );
    $stmt->execute();
    $professions = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($professions as $profession) {
      $result[] = new Profession($profession['name']);
    }

    return $result;
  }
}
