<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/User.php';

class UserRepository extends Repository
{
  public function getUser(string $email) {
    $stmt = $this->database->connect()->prepare(
      'SELECT * FROM "users" WHERE "usersEmail" = :email'
    );
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user === false) {
      return null;
    } else {
      return new User(
        $user['usersId'],
        $user['usersName'],
        $user['usersSurname'],
        $user['usersEmail'],
        $user['usersPassword']
      );
    }
  }

  public function createUser(string $name, string $surname, string $email, string $pwd) {
    $stmt = $this->database->connect()->prepare(
      'INSERT INTO "users" ("usersName", "usersSurname", "usersEmail", "usersPassword") VALUES ( :name, :surname, :email, :pwd)'
    );
    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':surname', $surname, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':pwd', $hashedPwd, PDO::PARAM_STR);
    $stmt->execute();
  }
}