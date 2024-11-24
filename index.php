<?php

require_once "autoloader.php";
require_once "config.php";

$cmd = $_GET['cmd'] ?? '';

$controller = new \Application\Controller($cmd, $config);
$className = $controller->getObjectName();

$database = new \Drivers\DataBase($config['db']);
$db = $database->dbConnect();

$user = new \Model\User($db);
$message = new \Model\Message($db);
$friendship = new \Model\Friendship($db);
$status = new \Model\Status($db);

session_start();

if (class_exists($className)) {
    $page = new $className($cmd, $config);
    $page->registerObject($controller);
    $page->registerObject($database);
    $page->registerObject($user);
    $page->registerObject($message);
    $page->registerObject($friendship);
    $page->registerObject($status);
    $page->show();
} else {
    if (isset($_SESSION['user']))
        $controller->redirectPage("/Web/Chat", true);
    else
        $controller->redirectPage("/Web/Auth", true);
}