<?php
/**
 * Created by PhpStorm.
 * User: Vladislav
 * Date: 02.02.2018
 * Time: 15:55
 */

class Product {

    const SHOW_BY_DEFAULT = 6;

    // возвращает список последних товаров
    public static function getLatestProducts($count = self::SHOW_BY_DEFAULT) {

        $count = intval($count);

        $db = Db::getConnection();

        $productList = array();

        $result = $db->query('SELECT id, name, price, is_new FROM product '
            . 'WHERE status = "1"'
            . 'ORDER BY id DESC '
            . 'LIMIT ' . $count);

        $i = 0;
        while ($row = $result->fetch()) {
            $productList[$i]['id'] = $row['id'];
            $productList[$i]['name'] = $row['name'];
            $productList[$i]['price'] = $row['price'];
            $productList[$i]['is_new'] = $row['is_new'];
            $i++;
        }

        return $productList;
    }

    // возвращает список товаров, опеределённой категории
    public static function getProductListByCategory($categoryId, $page = 1) {

        $page = intval($page);
        $offset = ($page - 1) * self::SHOW_BY_DEFAULT;

        $db = Db::getConnection();
        $productList = array();
        $result = $db->query('SELECT id, name, price, is_new FROM product '
            . 'WHERE status = "1" AND category_id = ' . $categoryId . ' '
            . 'ORDER BY id DESC '
            . 'LIMIT ' . self::SHOW_BY_DEFAULT
            . ' OFFSET ' . $offset);

        $i = 0;
        while ($row = $result->fetch()) {
            $productList[$i]['id'] = $row['id'];
            $productList[$i]['name'] = $row['name'];
            $productList[$i]['price'] = $row['price'];
            $productList[$i]['is_new'] = $row['is_new'];
            $i++;
        }

        return $productList;
    }

    //возвращает продукт по id
    public static function getProductById($id) {

        $db = Db::getConnection();

        $sql = 'SELECT id, name, price, code, description, brand, is_new, category_id, '
            . 'is_recomenended, avalibillity, status FROM product WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();
        $result->setFetchMode(PDO::FETCH_ASSOC);

        return $result->fetch();
    }

    // возвращает общее число товаров в категории
    public static function getTotalProductInCategory($categoryId) {

        $db = Db::getConnection();

        $result = $db->query('SELECT count(id) AS count FROM product '
            . 'WHERE status = "1" AND category_id = ' . $categoryId);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $row = $result->fetch();

        return $row['count'];
    }

    /**
     * Возвращает массив товаров по спи ску их id
     * @param $idsArray
     * @return array
     */
    public static function getProductsByIds($idsArray) {

        $products = array();

        $db = Db::getConnection();

        $idsString = implode(', ', $idsArray);

        $sql = 'SELECT id, code, name, price FROM product WHERE status = 1 AND id IN(' . $idsString . ')';

        $result = $db->query($sql);

        $result->setFetchMode(PDO::FETCH_ASSOC);

        $i = 0;
        while ($row = $result->fetch()) {
            $products[$i]['id'] = $row['id'];
            $products[$i]['code'] = $row['code'];
            $products[$i]['name'] = $row['name'];
            $products[$i]['price'] = $row['price'];

            $i++;
        }

        return $products;
    }

    /**
     * Возвращает список рекомендованых товаров
     * @return array
     */
    public static function getRecommendedProducts() {

        $productsList = array();

        $db = Db::getConnection();

        $sql = 'SELECT id, name, price, is_new FROM product '
            . 'WHERE status = "1" AND '
            . 'is_recomenended = "1" '
            . 'ORDER BY id DESC';

        $result = $db->query($sql);

        $i = 0;
        while ($row = $result->fetch()) {
            $productsList[$i]['id'] = $row['id'];
            $productsList[$i]['name'] = $row['name'];
            $productsList[$i]['price'] = $row['price'];
            $productsList[$i]['is_new'] = $row['is_new'];
            $i++;
        }
        return $productsList;
    }

    /**
     * @return array список всех товаров
     */
    public static function getProductsList() {

        // подготоваливаем массив
        $productsList = array();

        // соединяемся с базой данных и готовим запрос
        $db = Db::getConnection();
        $sql = 'SELECT id, code, name, price FROM product ORDER BY id';

        // выполняем запрос
        $result = $db->query($sql);

        // заполняем массив полученными данными
        $i = 0;
        while ($row = $result->fetch()) {
            $productsList[$i]['id'] = $row['id'];
            $productsList[$i]['code'] = $row['code'];
            $productsList[$i]['name'] = $row['name'];
            $productsList[$i]['price'] = $row['price'];
            $i++;
        }

        return $productsList;
    }

    /**
     * Удаляет товар по его индентификатору
     * @param $id
     * @return bool
     */
    public static function deleteProductById($id) {

        // соединение с БД
        $db = Db::getConnection();

        // текст запроса
        $sql = 'DELETE FROM product WHERE id = :id';

        // выполнение запроса
        $result = $db->prepare($sql);
        $result->bindParam('id', $id, PDO::PARAM_INT);
        return $result->execute();
    }

    /**
     * Добавление нового товара в БД
     * @param $options
     * @return int|string
     */
    public static function createProduct($options) {

        // соединение с БД
        $db = Db::getConnection();

        // подготавливаем запрос
        $sql = 'INSERT INTO product '
            . '(name, code, price, category_id, brand, avalibillity, description, is_new, is_recomenended, status)'
            . 'VALUES '
            . '(:name, :code, :price, :category_id, :brand, :availability, '
            . ':description, :is_new, :is_recommended, :status)';

        // выполняем запрос
        $result = $db->prepare($sql);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':code', $options['code'], PDO::PARAM_STR);
        $result->bindParam(':price', $options['price'], PDO::PARAM_STR);
        $result->bindParam(':category_id', $options['category_id'], PDO::PARAM_INT);
        $result->bindParam(':brand', $options['brand'], PDO::PARAM_STR);
        $result->bindParam(':availability', $options['availability'], PDO::PARAM_INT);
        $result->bindParam(':description', $options['description'], PDO::PARAM_STR);
        $result->bindParam('is_new', $options['is_new'], PDO::PARAM_INT);
        $result->bindParam('is_recommended', $options['is_recommended'], PDO::PARAM_INT);
        $result->bindParam('status', $options['status'], PDO::PARAM_INT);

        if ($result->execute()) {
            //если было успешно добавлено
            return $db->lastInsertId();
        }
        // иначе возвращаем 0
        return 0;
    }

    public static function updateProductById($id, $options) {

        // соединение с БД
        $db = Db::getConnection();

        // подготавливаем запрос
        $sql = 'UPDATE product '
            . 'SET '
            . 'name = :name, '
            . 'code = :code, '
            . 'price = :price, '
            . 'category_id = :category_id, '
            . 'brand = :brand, '
            . 'avalibillity = :availability, '
            . 'description = :description, '
            . 'is_new = :is_new, '
            . 'is_recomenended = :is_recommended, '
            . 'status = :status '
            . 'WHERE id = :id';

        // выполняем запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':code', $options['code'], PDO::PARAM_STR);
        $result->bindParam(':price', $options['price'], PDO::PARAM_STR);
        $result->bindParam(':category_id', $options['category_id'], PDO::PARAM_INT);
        $result->bindParam(':brand', $options['brand'], PDO::PARAM_STR);
        $result->bindParam(':availability', $options['availability'], PDO::PARAM_INT);
        $result->bindParam(':description', $options['description'], PDO::PARAM_STR);
        $result->bindParam('is_new', $options['is_new'], PDO::PARAM_INT);
        $result->bindParam('is_recommended', $options['is_recommended'], PDO::PARAM_INT);
        $result->bindParam('status', $options['status'], PDO::PARAM_INT);

        if ($result->execute()) {
            //если было успешно добавлено
            return $db->lastInsertId();
        }
        // иначе возвращаем 0
        return 0;
    }

    /**
     * Возвращает путь к изображению
     * @param integer $id
     * @return string <p>Путь к изображению</p>
     */
    public static function getImage($id)
    {
        // Название изображения-пустышки
        $noImage = 'no-image.jpg';

        // Путь к папке с товарами
        $path = '/upload/images/products/';

        // Путь к изображению товара
        $pathToProductImage = $path . $id . '.jpg';

        if (file_exists($_SERVER['DOCUMENT_ROOT'].$pathToProductImage)) {
            // Если изображение для товара существует
            // Возвращаем путь изображения товара
            return $pathToProductImage;
        }

        // Возвращаем путь изображения-пустышки
        return $path . $noImage;
    }
}