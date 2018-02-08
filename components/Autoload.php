<?php
/**
 * Created by PhpStorm.
 * User: Vladislav
 * Date: 03.02.2018
 * Time: 10:19
 */

function __autoload($class_name) {

    $array_path = array(
        '/models/',
        '/components/'
    );

    foreach($array_path as $path) {
        $path = ROOT . $path . $class_name . '.php';
        if (is_file($path)) {
            include_once $path;
        }
    }
}