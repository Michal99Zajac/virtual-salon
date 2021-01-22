<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/User.php';

class UserRepository extends Repository
{
  public function getUserWithDetails(int $id) {
    // get user with role and details
    $user = $this->getUserById($id);

    // check if user exists
    if ($user === null) {
      return null;
    }

    $stmt = $this->database->connect()->prepare(
      'SELECT * FROM users_details ud RIGHT JOIN users u ON ud.id = u.id_users_details WHERE u.id = :id'
    );
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $userData = $stmt->fetch(PDO::FETCH_ASSOC);

    $user->setName($userData['name']);
    $user->setSurname($userData['surname']);
    $user->setPhone($userData['phone']);
    $user->setCountry($userData['country']);
    $user->setCity($userData['city']);
    $user->setAddress($userData['address']);
    $user->setDateBirth($userData['date_of_birth']);

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