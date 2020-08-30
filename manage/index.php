<?php

include './vendor/autoload.php';

$contro = $_GET['control'] ?? 'Index';
$action = $_GET['action'] ?? 'index';
//var_dump($contro);
//var_dump($action);
$calss = "app\\$contro";

if (!class_exists($calss)) {
    throw  new Exception('Class Not Exists:' . $calss);
    return;
}

$contro = (new $calss());
if (!method_exists($contro, $action)) {
    throw new Exception('Method Not Exists:' . $action);
    return;
}
$contro->$action();