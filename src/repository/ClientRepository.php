<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Client.php';

class ClientRepository extends Repository {
//  public function getClient($email) {
//    $conn = $this->database->connect();
//    $stmt = $conn->prepare(
//      'SELECT * FROM clients WHERE '
//    );
//  }

  public function addClient(Client $client) {
    $conn = $this->database->connect();
    $conn->beginTransaction();

    if (isset($_SESSION['id'])) {
      $stmt = $conn->prepare(
        'INSERT INTO clients (id_users, name, surname, ordering_name, ordering_surname, city, address, phone, email)  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)'
      );
      $stmt->execute([
        $_SESSION['id'],
        $client->getName(),
        $client->getSurname(),
        $client->getOrderingName(),
        $client->getOrderingSurname(),
        $client->getCity(),
        $client->getAddress(),
        $client->getPhone(),
        $client->getEmail()
      ]);

    } else {
      $stmt = $conn->prepare(
        'INSERT INTO clients (name, surname, ordering_name, ordering_surname, city, address, phone, email)  VALUES (?, ?, ?, ?, ?, ?, ?, ?)'
      );
      $stmt->execute([
        $client->getName(),
        $client->getSurname(),
        $client->getOrderingName(),
        $client->getOrderingSurname(),
        $client->getCity(),
        $client->getAddress(),
        $client->getPhone(),
        $client->getEmail()
      ]);
    }
    $conn->commit();
    return$conn->lastInsertId();
  }
}