<?php

require_once 'Routing.php';

session_start();

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

Router::get('', 'DefaultController');
Router::get('search', 'DefaultController');
Router::post('login', 'SecurityController');
Router::get('register', 'SecurityController');
Router::get('edit', 'ProfileController');
Router::get('info', 'ProfileController');
Router::get('main', 'WorkersController');
Router::get('orders', 'OrderController');
Router::get('profile', 'WorkersController');
Router::get('reservations', 'OrderController');
Router::get('sheet', 'SheetController');
Router::get('logout', 'DefaultController');
Router::post('order', 'SheetController');
Router::post('deleteReservation', 'OrderController');
Router::post('deleteOrder', 'OrderController');

Router::run($path);
