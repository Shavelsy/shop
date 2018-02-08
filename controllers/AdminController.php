<?php
/**
 * Created by PhpStorm.
 * User: Vladislav
 * Date: 06.02.2018
 * Time: 17:26
 */

/**
 * Class AdminController
 * Главная страница администрации
 */
class AdminController extends AdminBase {

    public function actionIndex() {

        // проверка доступа
        self::checkAdmin();

        // подключаем вид
        require_once ROOT . '/views/admin/index.php';
        return TRUE;
    }
}