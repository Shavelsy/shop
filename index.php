<?php
/**
 * Created by PhpStorm.
 * User: Vladislav
 * Date: 30.01.2018
 * Time: 19:01
 */

//FRONT CONTROLLER

//  Общие настройки
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();

// Подключение файлов системы
define('ROOT', dirname(__FILE__));
require_once(ROOT . '/components/Autoload.php');

// Вызов Router
$router = new Router();
$router->run();