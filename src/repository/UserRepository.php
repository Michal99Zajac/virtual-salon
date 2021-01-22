<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/User.php';

class UserRepository extends Repository
{
  public function getUserWithDetails(int $id) {
    // get user with role and details
    $stmt = $this->database->connect()->prepare(
      'SELECT * FROM (SELECT u.id, u.id_users_details, u.email, u.password, ru.name as role FROM users u
    LEFT JOIN (SELECT ur.id_users, r.name FROM roles r RIGHT JOIN users_roles ur ON r.id = ur.id_roles) ru ON u.id = ru.id_users
    WHERE u.id = :id) u RIGHT JOIN users_details ud ON u.id_users_details = ud.id'
    );
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $ordinaryUser = $stmt->fetch(PDO::FETCH_ASSOC);

    // check if user exists
    if ($ordinaryUser === false) {
      return null;
    }

    $user = new User(
      $ordinaryUser['email'],
      $ordinaryUser['password'],
      $ordinaryUser['role'],
      $ordinaryUser['name'],
      $ordinaryUser['surname']
    );
    $user->setPhone($ordinaryUser['phone']);
    $user->setCountry($ordinaryUser['country']);
    $user->setCity($ordinaryUser['city']);
    $user->setAddress($ordinaryUser['address']);
    $user->setDateBirth($ordinaryUser['date_of_birth']);

    return $user;
  }

  public function getUserById(int $id) {
    // get user with role
    $stmt = $this->database->connect()->prepare(
      'SELECT u.id, u.id_users_details, u.email, u.password, ru.name as role FROM users u 
    LEFT JOIN (SELECT ur.id_users, r.name FROM roles r RIGHT JOIN users_roles ur ON r.id = ur.id_roles) ru ON u.id = ru.id_users 
    WHERE u.id = :id'
    );
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user === false) {
      return null;
    }

    return new User(
      $user['email'],
      $user['password'],
      $user['role']
    );
  }

  public function getUserByEmail(string $email) {
    // get user with role
    $stmt = $this->database->connect()->prepare(
      'SELECT u.id, u.id_users_details, u.email, u.password, ru.name as role FROM users u 
    LEFT JOIN (SELECT ur.id_users, r.name FROM roles r RIGHT JOIN users_roles ur ON r.id = ur.id_roles) ru ON u.id = ru.id_users 
    WHERE u.email = :email'
    );
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user === false) {
      return null;
    }

    return new User(
      $user['email'],
      $user['password'],
      $user['role']
    );
  }

  public function addUser(User $user) {
    $conn = $this->database->connect();
    // add user in users_details
    $stmt = $conn->prepare(
      'INSERT INTO users_details (name, surname) VALUES (?, ?)'
    );
    $conn->beginTransaction();
    $stmt->execute([$user->getName(), $user->getSurname()]);
    $conn->commit();
    $userDetailId = intval($conn->lastInsertId());

    // add user in users
    $stmt = $conn->prepare(
      'INSERT INTO "users" (id_users_details, email, password)
            VALUES (?, ?, ?)'
    );
    $hashedPwd = password_hash($user->getPwd(), PASSWORD_DEFAULT); // hash password
    $conn->beginTransaction();
    $stmt->execute([$userDetailId, $user->getEmail(), $hashedPwd]);
    $conn->commit();
    $userId = intval($conn->lastInsertId());

    // update users_roles table
    $this->updateRoleUser($userId, $user);
  }

  public function getUserId(string $email) {
    $stmt = $this->database->connect()->prepare(
      'SELECT id FROM users WHERE email = :email'
    );
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC)['id'];
  }

  private function updateRoleUser(int $userId, User $user) {
    $stmt = $this->database->connect()->prepare(
      'SELECT id FROM roles r WHERE ? = name'
    );
    $stmt->execute([$user->getRole()]);
    $roleId = $stmt->fetch(PDO::FETCH_ASSOC)['id'];

    $stmt = $this->database->connect()->prepare(
      'INSERT INTO users_roles (id_users, id_roles) VALUES (?, ?)'
    );
    $stmt->execute([$userId, $roleId]);
  }
}