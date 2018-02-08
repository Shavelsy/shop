<?php
/**
 * Created by PhpStorm.
 * User: Vladislav
 * Date: 04.02.2018
 * Time: 15:50
 */

/**
 * Class UserController
 * управление пользователями
 */
class UserController {

    /**
     * Страница регистрации
     * @return bool
     */
    public function actionRegister() {
        // инициализируем поля, которые получим из формы
        $name = '';
        $email = '';
        $password = '';
        $result = FALSE;

        // если форма отправлена
        if (isset($_POST['submit'])) {
            //олучаем поля
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            $errors = FALSE;

            // делаем валидацию полей
            if (!User::checkName($name)) {
                $errors[] = 'Имя не должно быть короче 2-х символов';
            }

            if (!User::checkEmail($email)) {
                $errors[] = 'Неправильный email';
            }

            if (!User::checkPassword($password)) {
                $errors[] = 'Пароль не должен быть короче 6-ти символов';
            }

            if (!User::checkEmailExists($email)) {
                $errors[] = 'Такой email уже используется';
            }

            // если ошибок нет, то регистрируем пользователя
            if ($errors == FALSE) {
                $result = User::register($name, $email, $password);
            }

        }

        // подключаем вид
        require_once(ROOT . '/views/user/register.php');
        return TRUE;
    }

    /**
     *  Вход в аккаунт
     */
    public function actionLogin() {
        // инициализируем поля, которые получим из формы
        $email = '';
        $password = '';

        // если форма отправлена
        if (isset($_POST['submit'])) {

            // получаем данные из формы
            $email = $_POST['email'];
            $password = $_POST['password'];

            $errors = FALSE;

            // валидация полей
            if (!User::checkEmail($email)) {
                $errors[] = 'Неправильный email';
            }

            if (!User::checkPassword($password)) {
                $errors[] = 'Пароль не должен быть короче 6-ти символов';
            }

            // проверяем наличие пользователя в системе
            $userId = User::checkUserData($email, $password);

            if ($userId == FALSE) {
                // если в базе нет такого пользователя, то выдадим ошибку
                $errors[] = 'Неправильные данные для входа на сайт';
            } else {
                // если в базе пользователь есть, то произведём вход в аккаунт и перейдём в кабинет
                User::auth($userId);
                header("Location: /cabinet/");
            }
        }

        // подключаем вид
        require_once ROOT . '/views/user/login.php';
        return TRUE;
    }

    /**
     * Выход из аккаунта
     */
    public function actionLogout() {

        unset($_SESSION['user']);
        header("Location: /");
    }

    /**
     * История покупок пользователя
     */
    public function actionHistory() {

        // получаем id пользователя
        $userId = User::checkLogged();

        // получаем массив его заказов
        $ordersList = Order::getOrderListByUserId($userId);

        // получаем массив с идентификаторами и количеством заказов
        foreach ($ordersList as $order) {

            $i = $order['id'];

            $productsListArray[$i] = $order['products'];
            $productsListArray[$i] = json_decode($order['products'], TRUE);

            $productsIds[$i] = array_keys($productsListArray[$i]);
            $products[$i] = Product::getProductsByIds($productsIds[$i]);
        }

        // подключаем вид
        require_once ROOT . '/views/user/history.php';
        return TRUE;
    }
}
