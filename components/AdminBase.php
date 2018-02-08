<?php
/**
 * Created by PhpStorm.
 * User: Vladislav
 * Date: 06.02.2018
 * Time: 17:29
 */

/**
 * Class AdminBase используется как базовый класс для всех AdminController
 */
abstract class AdminBase {

    /**
     *  является ли пользователь администратором
     * @return bool
     */
    public static function checkAdmin() {

        // получаем id пользователя, если он не авторизирован, то будет переадресация
        $userId = User::checkLogged();

        // получаем пользователя
        $user = User::getUserById($userId);

        // если это администратор, то возвращает true
        if ($user['role'] == 'admin') {
            return TRUE;
        }

        // если это не администратор, то выходим
        die('Access denied');
    }
}