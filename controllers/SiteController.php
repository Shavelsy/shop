<?php
/**
 * Created by PhpStorm.
 * User: Vladislav
 * Date: 31.01.2018
 * Time: 12:01
 */

/**
 * Class SiteController главная страница сайта
 */
class SiteController {

    /**
     * Главная страница сайта
     * @return bool
     */
    public function actionIndex() {

        // получаем список категорий
        $category = Category::getCategoryList();

        // получаем список последних товаров
        $latestProduct = Product::getLatestProducts(3);

        // получаем список рекомендованных товаров
        $sliderProducts = Product::getRecommendedProducts();

        // подключаем вид
        require_once(ROOT . '/views/site/index.php');
        return TRUE;
    }

    /**
     * О магазине
     * @return bool
     */
    public function actionAbout() {
        // подключаем вид
        require_once(ROOT . '/views/site/about.php');
        return TRUE;
    }
}