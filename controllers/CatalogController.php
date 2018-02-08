<?php
/**
 * Created by PhpStorm.
 * User: Vladislav
 * Date: 02.02.2018
 * Time: 17:30
 */

/**
 * Class CatalogController страницы с товарами
 */
class CatalogController {

    /**
     * Страница с последними товарами
     * @return bool
     */
    public function actionIndex() {

        // получаем список категорий
        $category = Category::getCategoryList();

        // получаем последние твоары
        $latestProduct = Product::getLatestProducts(12);

        // подключаем вид
        require_once(ROOT . '/views/catalog/index.php');
        return TRUE;
    }

    /**
     * Страница с товарами определённой категорийй
     * @param $categoryId id категории
     * @param int $page
     * @return bool
     */
    public function actionCategory($categoryId, $page = 1) {

        // получаем список категорий
        $category = Category::getCategoryList();

        // получаем список товаров данной категории и для текущей страницы
        $latestProduct = Product::getProductListByCategory($categoryId, $page);

        // получаем общее количество товаров данной категории
        $total = Product::getTotalProductInCategory($categoryId);
        $pagination = new Pagination($total, $page, Product::SHOW_BY_DEFAULT, 'page-');

        // подключаем вид
        require_once(ROOT . '/views/catalog/category.php');
        return TRUE;
    }
}