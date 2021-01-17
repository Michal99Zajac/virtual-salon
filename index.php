<?php

require_once 'Routing.php';

session_start();

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

Router::get('', 'DefaultController');
Router::get('search', 'DefaultController');
Router::post('login', 'SecurityController');
Router::get('register', 'SecurityController');
Router::get('edit', 'DefaultController');
Router::get('info', 'DefaultController');
Router::get('main', 'DefaultController');
Router::get('orders', 'DefaultController');
Router::get('profile', 'DefaultController');
Router::get('reservations', 'DefaultController');
Router::get('sheet', 'DefaultController');
Router::get('logout', 'DefaultController');

Router::run($path);
