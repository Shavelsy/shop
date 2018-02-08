<?php
/**
 * Created by PhpStorm.
 * User: Vladislav
 * Date: 31.01.2018
 * Time: 11:12
 */

class DB {

    public static function getConnection() {

        $paramsPath = ROOT . '/config/db_params.php';
        $params = include($paramsPath);

        $dsn = "mysql:host={$params['host']};dbname={$params['dbname']}";
        $db = new PDO($dsn, $params['user'], $params['password']);
        $db->exec("set names utf8");

        return $db;
    }
}