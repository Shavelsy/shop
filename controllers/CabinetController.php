<?php
/**
 * Created by PhpStorm.
 * User: Vladislav
 * Date: 04.02.2018
 * Time: 20:15
 */

/**
 * Class CabinetController работа с кабинетом пользователя
 */
class CabinetController {

    /**
     * @return bool
     * показывает страницу кабинета
     */
    public function actionIndex() {

        // проверяем был ли выполнен вход и если он был, то получаем пользователя
        $userId = User::checkLogged();
        $user = User::getUserById($userId);

        // подключаем вид
        require_once ROOT . '/views/cabinet/index.php';
        return TRUE;
    }

    /**
     * редактирование аккаунта
     * @return bool
     */
    public function actionEdit() {

        // проверяем был ли выполнен вход и если он был, то получаем пользователя
        $userId = User::checkLogged();
        $user = User::getUserById($userId);

        // результат изменений
        $result = FALSE;

        // получаем данные пользователя
        $name = $user['name'];
        $password = $user['password'];

        // если форма отправлена
        if (isset($_POST['submit'])) {
            // получаем данные из формы
            $name = $_POST['name'];
            $password = $_POST['password'];

            $errors = FALSE;

            // проводим валидацию полей
            if (!User::checkName($name)) {
                $errors[] = 'Имя длолжно быть не короче 2-х символов';
            }
            if (!User::checkPassword($password)) {
                $errors[] = 'Пароль должен быть не короче 6-ти символов';
            }

            // если ошибок нет
            if ($errors == FALSE) {
                // производим изменение
                $result = User::edit($userId, $name, $password);
            }
        }

        // подключаем вид
        require_once ROOT . '/views/cabinet/edit.php';
        return TRUE;
    }
}