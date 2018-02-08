<?php
/**
 * Created by PhpStorm.
 * User: Vladislav
 * Date: 07.02.2018
 * Time: 22:04
 */

/**
 * Class AdminOrderController
 * Управление заказами
 */
class AdminOrderController extends AdminBase {

    /**
     * отображаем список заказов
     * @return bool
     */
    public function actionIndex() {

        // проверяем доступ
        self::checkAdmin();

        // получаем список заказов
        $orderList = Order::getOrderList();

        // подключаем вид
        require_once ROOT . '/views/admin_order/index.php';
        return TRUE;
    }

    /**
     * Удалить заказ
     * @param $id
     * @return bool
     */
    public function actionDelete($id) {

        // проверяем доступ
        self::checkAdmin();

        if (isset($_POST['submit'])) {
            //если форма отправлена
            // удаляем заказ
            $result = Order::deleteOrder($id);

            // переходим на страницу с заказами
            header("Location: /admin/order");
        }

        // подключаем вид
        require_once ROOT . '/views/admin_order/delete.php';
        return TRUE;
    }

    /**
     * редактирование товара
     * @param $id
     * @return bool
     */
    public function actionUpdate($id) {

        // проверяем доступ
        self::checkAdmin();

        // получаем заказ
        $order = Order::getOrderById($id);

        if (isset($_POST['submit'])) {
            // если форма отправлена
            // получаем данные из формы
            $options['user_name'] = $_POST['user_name'];
            $options['user_phone'] = $_POST['user_phone'];
            $options['user_comment'] = $_POST['user_comment'];
            $options['date'] = $_POST['date'];
            $options['status'] = $_POST['status'];

            // обновляем заказ
            $result = Order::updateOrderById($id, $options);

            // переадресация
            header("Location: /admin/order");
        }

        // подключаем вид
        require_once ROOT . '/views/admin_order/update.php';
        return TRUE;
    }

    /**
     * Просмотр заказа
     * @param $id
     * @return bool
     */
    public function actionView($id) {

        // проверяем доступ
        self::checkAdmin();

        // получаем заказ
        $order = Order::getOrderById($id);

        // получаем массив с идентификаторами и количеством заказов
        $productsQuantity = json_decode($order['products'], true);

        // получаем массив с идентификаторами заказов
        $productsIds = array_keys($productsQuantity);

        // получаем список товаров в заказе
        $products = Product::getProductsByIds($productsIds);

        // подключаем вид
        require_once ROOT . '/views/admin_order/view.php';
        return TRUE;
    }
}