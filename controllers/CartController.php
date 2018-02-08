<?php
/**
 * Created by PhpStorm.
 * User: Vladislav
 * Date: 05.02.2018
 * Time: 18:22
 */

class CartController {

    /**
     * добавляем товар в корзину
     * @param $id
     * @return bool
     */
    public function actionAdd($id) {

        // добавляем товар в корзину по его идентификатору
        Cart::addProduct($id);

        // переходим на текущую страницу
        $referrer = $_SERVER['HTTP_REFERER'];
        header("Location: $referrer");
        return TRUE;
    }

    /**
     * Главная страница корзины
     * @return bool
     */
    public function actionIndex() {

        // получаем список категорий в виде массива
        $categories = Category::getCategoryList();

        // получаем список товаров в корзине в виде массива
        $productsInCart = Cart::getProducts();

        // если в корзине есть товарф
        if ($productsInCart) {

            // получаем id всех товаров
            $productIds = array_keys($productsInCart);

            // получаем список товаров по их id
            $products = Product::getProductsByIds($productIds);

            // подсчитываем стоимость всех товаров в корзине
            $totalPrice = Cart::getTotalPrice($products);
        }


        // подключаем вид
        require_once ROOT . '/views/cart/index.php';
        return TRUE;
    }

    /**
     * обработка заказа
     * @return bool
     */
    public function actionCheckout() {

        //список категорий
        $categories = array();
        $categories = Category::getCategoryList();

        // статут успешного офрмления заказза
        $result = FALSE;

        //форма отправлена?
        if (isset($_POST['submit'])) {

            //форма отправлена
            //получаем данные из формы
            $userName = $_POST['name'];
            $userPhone = $_POST['phone'];
            $userComment = $_POST['comment'];

            //валидация полей
            $errors = FALSE;
            if (!User::checkName($userName)) {
                $errors[] = 'Некорректное имя';
            }
            if (!User::checkPhone($userPhone)) {
                $errors[] = 'Некорректный телефон';
            }

            //если форма заполена корректно
            if (!$errors) {

                //собираем информацию о заказе и о пользователе
                $productsInCart = Cart::getProducts();
                if (User::isGuest()) {
                    $userId = FALSE;
                } else {
                    $userId = User::checkLogged();
                }

                // сохраняем заказ
                $result = Order::save($userName, $userPhone, $userComment, $userId, $productsInCart);

                if ($result) {

                    $adminEmail = 'vladushk@rambler.ru';
                    $massage = '';
                    $subject = 'Новый заказ';
                    //mail($adminEmail, $subject, $massage);

                    Cart::clear();
                }
            } else {

                // форма заполена некорректно
                $productsInCart = Cart::getProducts();
                $productsIds = array_keys($productsInCart);
                $products = Product::getProductsByIds($productsIds);
                $totalPrice = Cart::getTotalPrice($products);
                $totalQuantity = Cart::countItem();
            }

        } else {
            // форма не отправлена
            $productsInCart = Cart::getProducts();

            if ($productsInCart == FALSE) {
                // в корзине нет товаров
                header("location: /");
            } else {

                // собираем данные о заказе
                $productsIds = array_keys($productsInCart);
                $products = Product::getProductsByIds($productsIds);
                $totalPrice = Cart::getTotalPrice($products);
                $totalQuantity = Cart::countItem();

                // данные из формы
                $userName = FALSE;
                $userPhone = FALSE;
                $userComment = FALSE;

                if (!User::isGuest()) {
                    $userId = User::checkLogged();
                    $user = User::getUserById($userId);
                    $userName = $user['name'];
                }
            }
        }

        // подключаем вид
        require_once ROOT . '/views/cart/checkout.php';
        return TRUE;
    }

    /**
     * удаление товара из корзины
     * @param $id
     * @return bool
     */
    public function actionDelete($id) {

        // удаляем товар по его идентификатору
        Cart::deleteProduct($id);
        header("Location: /cart");
    }
}