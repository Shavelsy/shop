<?php
/**
 * Created by PhpStorm.
 * User: Vladislav
 * Date: 07.02.2018
 * Time: 20:59
 */

/**
 * Class AdminCategoryController
 * управление категориями
 */
class AdminCategoryController extends AdminBase {

    /**
     * Страница с категориями
     * @return bool
     */
    public function actionIndex() {

        //проверка доступа
        self::checkAdmin();

        //получаем список товаров
        $categoryList = Category::getCategoryList();

        //подключаем вид
        require_once ROOT . '/views/admin_category/index.php';
        return TRUE;
    }

    public function actionDelete($id) {

        //проверка доступа
        self::checkAdmin();

        // если форма отправлена
        if (isset($_POST['submit'])) {
            // удаляем категорию и переходим на страницу категорий
            Category::deleteCategory($id);
            header("Location: /admin/category");
        }

        //подключаем вид
        require_once ROOT . '/views/admin_category/delete.php';
        return TRUE;
    }

    /**
     * Создание новой категории
     * @return bool
     */
    public function actionCreate() {

        //проверка доступа
        self::checkAdmin();

        if (isset($_POST['submit'])) {
            //если форма отправлена
            //получаем поля из формы
            $options['name'] = $_POST['name'];
            $options['sort_order'] = $_POST['sort_order'];
            $options['status'] = $_POST['status'];

            // добавляем категорию
            $result = Category::createCategory($options);

            // переадресация на страницу с категориями
            header("Location: /admin/category");
        }

        //подключаем вид
        require_once ROOT . '/views/admin_category/create.php';
        return TRUE;
    }

    /**
     * изменяем категорию
     * @param $id
     * @return bool
     */
    public function actionUpdate($id) {

        //проверка доступа
        self::checkAdmin();

        // получим категорию
        $category = Category::getCategoryById($id);

        if (isset($_POST['submit'])) {
            // если форма отправлена
            // получаем данные из формы
            $options['name'] = $_POST['name'];
            $options['sort_order'] = $_POST['sort_order'];
            $options['status'] = $_POST['status'];

            // добавляем категорию
            $result = Category::updateCategoryById($id, $options);

            // переадресация на страницу с категориями
            header("Location: /admin/category");
        }

        //подключаем вид
        require_once ROOT . '/views/admin_category/update.php';
        return TRUE;
    }
}