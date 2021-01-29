<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Client.php';

class ClientRepository extends Repository {
  public function getClientsUser($userId) {
    $result = [];
    $conn = $this->database->connect();
    $stmt = $conn->prepare(
      'SELECT * FROM clients WHERE id_users = ?'
    );
    $stmt->execute([$userId]);
    $clients = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($clients as $client) {
      $cli = new Client(
        $client['name'],
        $client['surname'],
        $client['city'],
        $client['address'],
        $client['phone'],
        $client['email']
      );
      $cli->setOrderingSurname($client['ordering_surname']);
      $cli->setOrderingName($client['ordering_name']);
      $cli->setId($client['id']);
      $result[] = $cli;
    }

    return $result;
  }

  public function getClientsEmployee($userid) {
    $result = [];
    $conn = $this->database->connect();
    $stmt = $conn->prepare(
      'SELECT * FROM clients c INNER JOIN 
    (SELECT id_clients FROM orders o INNER JOIN 
    (SELECT id as sdid, empid FROM schedules_details sd INNER JOIN 
    (SELECT s.id as schid, e.id as empid FROM schedules s INNER JOIN 
    (SELECT id FROM employees e WHERE e.id_users = ?) e ON e.id = s.id_employees) e 
    ON sd.id_schedules =  e.schid) sd ON sd.sdid = o.id_schedules_details) o 
    ON o.id_clients = c.id'
    );
    $stmt->execute([$userid]);
    $clients = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($clients as $client) {
      $cli = new Client(
        $client['name'],
        $client['surname'],
        $client['city'],
        $client['address'],
        $client['phone'],
        $client['email']
      );
      $cli->setOrderingSurname($client['ordering_surname']);
      $cli->setOrderingName($client['ordering_name']);
      $cli->setId($client['id']);
      $result[] = $cli;
    }

    return $result;
  }

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

  public function deleteClient($id) {
    $stmt = $this->database->connect()->prepare(
      'DELETE FROM clients WHERE id = ?'
    );
    $stmt->execute([$id]);
  }
}