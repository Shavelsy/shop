<?php
/**
 * Created by PhpStorm.
 * User: Vladislav
 * Date: 31.01.2018
 * Time: 13:07
 */

/**
 * Class ProductController страница с описанием товара
 */
class ProductController {

    /**
     * Страница с товаром
     * @param $id
     * @return bool
     */
    public function actionView($id) {

       // получаем список категорий
        $category = Category::getCategoryList();

        // получаем товар, который нужно вывести
        $product = Product::getProductById($id);

        // подключаем вид
        require_once(ROOT . '/views/product/view.php');
        return TRUE;
    }
}