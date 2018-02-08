<?php
/**
 * Created by PhpStorm.
 * User: Vladislav
 * Date: 04.02.2018
 * Time: 16:02
 */

class User {

    /**
     * добавление нового пользователя
     * @param $name
     * @param $email
     * @param $password
     */
    public static function register($name, $email, $password) {
        $db = Db::getConnection();

        $sql = 'INSERT INTO user (name, email, password) '
            . 'VALUES (:name, :email, :password)';

        $result = $db->prepare($sql);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);

        return $result->execute();
    }

    /**
     * проверка имени
     */
    public static function checkName($name) {
        if (strlen($name) >= 2) {
            return TRUE;
        }
        return FALSE;
    }

    /**
     * проверка пароля
     */
    public static function checkPassword($password) {
        if (strlen($password) >= 6) {
            return TRUE;
        }
        return FALSE;
    }

    /**
     * проверка email
     */
    public static function checkEmail($email) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return TRUE;
        }
        return FALSE;
    }

    /**
     * проверка телефона
     * @param $phone
     * @return bool
     */
    public static function checkPhone($phone) {
        if (strlen($phone) >= 11) {
            return TRUE;
        }
        return FALSE;
    }

    /**
     * проверка email на существование в базе данных
     */
    public static function checkEmailExists($email) {

        $db = Db::getConnection();

        $sql = 'SELECT COUNT(*) FROM user WHERE email = :email';

        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->execute();

        $row = $result->fetch();

        if ($row[0] == 0) {
            return TRUE;
        }
        return FALSE;
    }

    /**
     * Проверяем наличие пользователя в БД, если есть, возвращаем его id
     * @param $email
     * @param $password
     * @return bool
     */
    public static function checkUserData($email, $password) {
        $db = Db::getConnection();

        $sql = 'SELECT * FROM user WHERE email = :email AND password = :password';

        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_INT);
        $result->bindParam(':password', $password, PDO::PARAM_INT);
        $result->execute();

        $user = $result->fetch();
        if ($user) {
            return $user['id'];
        }
        return FALSE;
    }

    /**
     * Запоминаем пользователя
     * @param $userId
     */
    public static function auth($userId) {

        $_SESSION['user'] = $userId;
    }

    /**
     * Проверяем был ли вход в аккаунт, если да, то возвращаем id
     * @return mixed
     */
    public static function checkLogged() {

        if (isset($_SESSION['user'])) {
            return $_SESSION['user'];
        }
        header("Location: /user/login/");
    }

    /**
     * Возвращает является ли пользователь гостем, либо авторезированным пользователем
     * @return bool
     */
    public static function isGuest() {

        if (isset($_SESSION['user'])) {
            return FALSE;
        }
        return TRUE;
    }

    /**
     *  возвращает пользователя по id
     * @param $id
     * @return mixed
     */
    public static function getUserById($id) {

        if ($id) {
            $db = Db::getConnection();
            $sql = 'SELECT * FROM user WHERE id = :id';

            $result = $db->prepare($sql);
            $result->bindParam(':id', $id, PDO::PARAM_INT);

            // показываем, что хотим получить массив
            $result->setFetchMode(PDO::FETCH_ASSOC);
            $result->execute();

            return $result->fetch();
        }
    }

    /**
     * изменение аккаунта
     * @param $id
     * @param $name
     * @param $password
     * @return bool
     */
    public static function edit($id, $name, $password) {
        $db = Db::getConnection();
        $sql = 'UPDATE user SET name = :name, password = :password WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }
}