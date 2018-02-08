<?php
/**
 * Created by PhpStorm.
 * User: Vladislav
 * Date: 05.02.2018
 * Time: 18:30
 */

/**
 * Class Cart модель корзины
 */
class Cart {

    /**
     * добавляем товар в корзину
     * храним в сессии в массиве
     * @param $id
     */
    public static function addProduct($id) {

        $id = intval($id);

        $productsInCart = array();

        if (isset($_SESSION['products'])) {
            $productsInCart = $_SESSION['products'];
        }

        if (array_key_exists($id, $productsInCart)) {
            $productsInCart[$id]++;
        } else {
            $productsInCart[$id] = 1;
        }

        $_SESSION['products'] = $productsInCart;

        return self::countItem();
    }

    /**
     * возвращает количество товаров в корзине
     * @return int
     */
    public static function countItem() {

        if (isset($_SESSION['products'])) {
            $count = 0;
            foreach ($_SESSION['products'] as $id => $quantity) {
                $count = $count + $quantity;
            }
        } else {
            $count = 0;
        }
        return $count;
    }

    /**
     * возвращает массив заказов, если он есть
     * @return bool
     */
    public static function getProducts() {

        if (isset($_SESSION['products'])) {
            return $_SESSION['products'];
        }
        return FALSE;
    }

    /**
     * возвращает общую стоимость товаров
     * @param $products
     * @return int
     */
    public static function getTotalPrice($products) {

        $productsInCart = self::getProducts();

        $total = 0;

        foreach ($products as $item) {
            $total = $total + $item['price'] * $productsInCart[$item['id']];
        }

        return $total;
    }

    /**
     * Очистка корзины
     */
    public static function clear() {

        if (isset($_SESSION['products'])) {
            unset($_SESSION['products']);
        }
    }

    /**
     * удаление товара из корзины
     * @param $id
     */
    public static function deleteProduct($id) {

        $productsInCart = self::getProducts();

        unset($productsInCart[$id]);

        $_SESSION['products'] = $productsInCart;
    }
}