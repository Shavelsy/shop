<?php
/**
 * Created by PhpStorm.
 * User: Vladislav
 * Date: 06.02.2018
 * Time: 18:30
 */

/**
 * Class AdminProductController
 * управление товарами на сайте
 */
class AdminProductController extends AdminBase {

    /**
     * Выводит страницу управления товарами
     * @return bool
     */
    public function actionIndex() {

        //проверка доступа
        self::checkAdmin();

        //получаем список товаров
        $productsList = Product::getProductsList();

        //подключаем вид
        require_once ROOT . '/views/admin_product/index.php';
        return TRUE;
    }

    /**
     * Удаление товара
     * @param $id
     * @return bool
     */
    public function actionDelete($id) {

        //проверка доступа
        self::checkAdmin();

        // обработка формы
        if (isset($_POST['submit'])) {
            // если форма отправлена
            // удаляем товар
            Product::deleteProductById($id);

            if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/upload/images/products/{$id}.jpg")) {
                // Если изображение для товара существует
                // Удаляем изображение
                unlink($_SERVER['DOCUMENT_ROOT'] . "/upload/images/products/{$id}.jpg");
            }

            //еренаправление на страницу управления товарами
            header("Location: /admin/product");
        }

        //подключаем вид
        require_once ROOT . '/views/admin_product/delete.php';
        return TRUE;
    }

    /**
     * Добавить товар в БД
     * @return bool
     */
    public function actionCreate() {

        //проверка доступа
        self::checkAdmin();

        // получаем список категорий
        $categoriesList = Category::getCategoryList();

        // Обработка формы
        if (isset($_POST['submit'])) {
            //если форма отпралена
            //получаем данные из формы
            $options['name'] = $_POST['name'];
            $options['code'] = $_POST['code'];
            $options['price'] = $_POST['price'];
            $options['category_id'] = $_POST['category_id'];
            $options['brand'] = $_POST['brand'];
            $options['description'] = $_POST['description'];
            $options['availability'] = $_POST['availability'];
            $options['is_new'] = $_POST['is_new'];
            $options['is_recommended'] = $_POST['is_recommended'];
            $options['status'] = $_POST['status'];

            $errors = FALSE;

            // валидация полей
            if (!isset($options['name']) || empty($options['name'])) {
                $errors[] = 'Заполните поля';
            }

            if (!$errors) {
                // если ошибок нет
                // добавляем новый товар
                $id = Product::createProduct($options);

                //если запись добавлена
                if ($id) {
                    // загрузилось ли изображение?
                    if (is_uploaded_file($_FILES["image"]["tmp_name"])) {
                        // если загрузилось, то переместим его в нужную папку, дав нужное имя
                        move_uploaded_file($_FILES["image"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/images/products/{$id}.jpg");
                    }
                }

                // перенапрвление на таблицу с товарами
                header("Location: /admin/product");
            }
        }

        //подключаем вид
        require_once ROOT . '/views/admin_product/create.php';
        return TRUE;
    }

    /**
     * Изменение товара
     * @param $id
     * @return bool
     */
    public function actionUpdate($id) {

        // получаем товар
        $product = Product::getProductById($id);

        // получаем список категорий
        $categoriesList = Category::getCategoryList();

        // Обработка формы
        if (isset($_POST['submit'])) {
            //если форма отпралена
            //получаем данные из формы
            $options['name'] = $_POST['name'];
            $options['code'] = $_POST['code'];
            $options['price'] = $_POST['price'];
            $options['category_id'] = $_POST['category_id'];
            $options['brand'] = $_POST['brand'];
            $options['description'] = $_POST['description'];
            $options['availability'] = $_POST['availability'];
            $options['is_new'] = $_POST['is_new'];
            $options['is_recommended'] = $_POST['is_recommended'];
            $options['status'] = $_POST['status'];

            $errors = FALSE;

            // валидация полей
            if (!isset($options['name']) || empty($options['name'])) {
                $errors[] = 'Заполните поля';
            }

            if (!$errors) {
                // если ошибок нет
                // Проводим изменения
                $id = Product::updateProductById($id, $options);

                // перенапрвление на таблицу с товарами
                header("Location: /admin/product");
            }
        }

        //подключаем вид
        require_once ROOT . '/views/admin_product/update.php';
        return TRUE;
    }
}