<?php
/**
 * Created by PhpStorm.
 * User: Vladislav
 * Date: 05.02.2018
 * Time: 23:32
 */

class Order {

    /**
     * Добавить заказ в БД
     * @param $userName
     * @param $userPhone
     * @param $userComment
     * @param $userId
     * @param $products
     */
    public static function save($userName, $userPhone, $userComment, $userId, $products) {

        $products = json_encode($products);

        $db = Db::getConnection();

        $sql = 'INSERT INTO product_order (user_name, user_phone, user_comment, user_id, products) '
            . 'VALUES (:user_name, :user_phone, :user_comment, :user_id, :products)';

        $result = $db->prepare($sql);
        $result->bindParam('user_name', $userName, PDO::PARAM_STR);
        $result->bindParam('user_phone', $userPhone, PDO::PARAM_STR);
        $result->bindParam('user_comment', $userComment, PDO::PARAM_STR);
        $result->bindParam('user_id', $userId, PDO::PARAM_STR);
        $result->bindParam('products', $products, PDO::PARAM_STR);

        return $result->execute();
    }

    /**
     * получаем список всех заказов из БД
     * @return array
     */
    public static function getOrderList() {

        //подготавливаем массив для заказов
        $orderList = array();

        // соединяемся с базой данных
        $db =Db::getConnection();

        // подготавливам запрос
        $sql = 'SELECT id, user_name, user_phone, date, status FROM product_order';

        // выполняем запрос
        $result = $db->query($sql);

        // получаем данные из запроса
        $i = 0;
        while ($row = $result->fetch()) {
            $orderList[$i]['id'] = $row['id'];
            $orderList[$i]['user_name'] = $row['user_name'];
            $orderList[$i]['user_phone'] = $row['user_phone'];
            $orderList[$i]['date'] = $row['date'];
            $orderList[$i]['status'] = $row['status'];
            $i++;
        }

        return $orderList;
    }

    /**
     * получаем список всех заказов конкретного пользователя из БД
     * @return array
     */
    public static function getOrderListByUserId($userId) {

        //подготавливаем массив для заказов
        $orderList = array();

        // соединяемся с базой данных
        $db =Db::getConnection();

        // подготавливам запрос
        $sql = 'SELECT id, user_name, user_phone, user_comment, date, products FROM product_order WHERE user_id = :id';

        // выполняем запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $userId, PDO::PARAM_INT);
        $result->execute();

        // получаем данные из запроса
        $i = 0;
        while ($row = $result->fetch()) {
            $orderList[$i]['id'] = $row['id'];
            $orderList[$i]['user_name'] = $row['user_name'];
            $orderList[$i]['user_phone'] = $row['user_phone'];
            $orderList[$i]['user_comment'] = $row['user_comment'];
            $orderList[$i]['date'] = $row['date'];
            $orderList[$i]['products'] = $row['products'];
            $i++;
        }

        return $orderList;
    }

    /**
     * Удаляем заказ из БД
     * @param $id
     * @return bool
     */
    public static function deleteOrder($id){

        // соединяемся с базой данных
        $db =Db::getConnection();

        // подготавливам запрос
        $sql = 'DELETE FROM product_order WHERE id = :id';

        // выполняем запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        return $result->execute();
    }

    /**
     * получить заказ по идентификатору
     * @param $id
     * @return mixed
     */
    public static function getOrderById($id) {

        // соединяемся с базой данных
        $db =Db::getConnection();

        // подготавливам запрос
        $sql = 'SELECT id, user_name, user_phone, user_comment, user_id, date, status, products FROM product_order WHERE id = :id';

        // выполняем запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();
        $result->setFetchMode(PDO::FETCH_ASSOC);

        return $result->fetch();
    }

    /**
     * изменение заказа в БД
     * @param $id
     * @param $options
     * @return bool
     */
    public static function updateOrderById($id, $options) {

        // соединяемся с базой данных
        $db =Db::getConnection();

        // подготавливам запрос
        $sql = 'UPDATE product_order '
            . 'SET '
            . 'user_name = :user_name, '
            . 'user_phone = :user_phone, '
            . 'user_comment = :user_comment, '
            . 'date = :date, '
            . 'status = :status '
            . 'WHERE id = :id';

        // выполняем запрос
        $result = $db->prepare($sql);
        $result->bindParam(':user_name', $options['user_name'], PDO::PARAM_STR);
        $result->bindParam(':user_phone', $options['user_phone'], PDO::PARAM_STR);
        $result->bindParam(':user_comment', $options['user_comment'], PDO::PARAM_STR);
        $result->bindParam(':date', $options['date'], PDO::PARAM_STR);
        $result->bindParam(':status', $options['status'], PDO::PARAM_INT);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        return $result->execute();
    }

    /**
     * Получение статуса заказа в текстовом виде
     * @param $status
     * @return string
     */
    public static function getStatusText($status) {

         switch ($status) {
             case 0:
                 return 'Закрыт';
             case 1:
                 return 'Доставляется';
             case 2:
                 return 'В обработке';
             case 3:
                 return 'Новый заказ';
         }
    }
}