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
      $user['role'],
      $user['password']
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
      $user['role'],
      $user['password']
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

  public function updateStandard() {
    $conn = $this->database->connect();
    $stmt = $conn->prepare(
      'UPDATE users u SET email = ? WHERE u.id = ?'
    );
    $stmt->execute([$_POST['email'], $_SESSION['id']]);

    $stmt = $conn->prepare(
      'SELECT id_users_details FROM users WHERE id = ?'
    );
    $stmt->execute([$_SESSION['id']]);
    $detailId = $stmt->fetch(PDO::FETCH_ASSOC)['id_users_details'];

    $stmt = $conn->prepare(
      'UPDATE users_details SET name = ?, surname = ?, date_of_birth = ?, country = ?, phone = ? WHERE  id = ?'
    );

    if (!$_POST['dateBirth']) {
      $date = new DateTime();
      $_POST['dateBirth'] = $date->format('Y-m-d');
    }

    $stmt->execute([
      $_POST['name'],
      $_POST['surname'],
      $_POST['dateBirth'],
      $_POST['country'],
      $_POST['phone'],
      $detailId
    ]);
  }

  public function updatePassword() {
    $conn = $this->database->connect();
    $stmt = $conn->prepare(
      'SELECT password FROM users WHERE id = ?'
    );
    $stmt->execute([$_SESSION['id']]);
    $password = $stmt->fetch(PDO::FETCH_ASSOC)['password'];

    if (!password_verify($_POST['old-password'], $password)) {
      return null;
    }

    if ($_POST['new-password'] != $_POST['repeat-password']) {
      return null;
    }

    $hashPassword = password_hash($_POST['new-password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare(
      'UPDATE users SET password = ? WHERE id = ?'
    );
    $stmt->execute([$hashPassword, $_SESSION['id']]);
  }

  public function updateAddress() {
    $conn = $this->database->connect();
    $stmt = $conn->prepare(
      'SELECT id_users_details FROM users WHERE id = ?'
    );
    $stmt->execute([$_SESSION['id']]);
    $detailId = $stmt->fetch(PDO::FETCH_ASSOC)['id_users_details'];

    $stmt = $conn->prepare(
      'UPDATE users_details SET city = ?, address = ? WHERE id = ?'
    );
    $stmt->execute([
      $_POST['city'],
      $_POST['address'],
      $detailId
    ]);
  }

  public function deleteUser(int $userid) {
    $conn = $this->database->connect();

    $stmt = $conn->prepare(
      'SELECT * FROM clients WHERE id_users = ?'
    );
    $stmt->execute([$userid]);
    $invalid = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($invalid) {
      return false;
    }

    $stmt = $conn->prepare(
      'SELECT id_users_details as udId FROM users WHERE id = ?'
    );
    $stmt->execute([$userid]);
    $userDetailId = $stmt->fetch(PDO::FETCH_ASSOC)['udId'];

    $stmt = $conn->prepare(
      'DELETE FROM users_details WHERE id = ?'
    );
    $stmt->execute([$userDetailId]);

    return true;
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