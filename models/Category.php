<?php
/**
 * Created by PhpStorm.
 * User: Vladislav
 * Date: 02.02.2018
 * Time: 15:29
 */

class Category {

    /**
     * получаем список категорий
     * @return array
     */
    public static function getCategoryList() {

        // соединение с БД
        $db = Db::getConnection();

        $categoryList = array();

        // производим запрос
        $result = $db->query('SELECT id, name, sort_order, status FROM category '
            . 'ORDER BY sort_order ASC');

        $i = 0;
        while ($row = $result->fetch()) {
            $categoryList[$i]['id'] = $row['id'];
            $categoryList[$i]['name'] = $row['name'];
            $categoryList[$i]['sort_order'] = $row['sort_order'];
            $categoryList[$i]['status'] = $row['status'];
            $i++;
        }

        return $categoryList;
    }

    /**
     * получаем категорию по её идентификатору
     * @param $id
     * @return bool
     */
    public static function getCategoryById($id) {

        // соединение с БД
        $db = Db::getConnection();

        // подготавливаем запрос
        $sql = 'SELECT id, name, sort_order, status FROM category '
            . 'WHERE id = :id';

        // выполняем запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();
        $result->setFetchMode(PDO::FETCH_ASSOC);
        return $result->fetch();
    }

    /**
     * Добавить категорию в БД
     * @param $options
     * @return bool
     */
    public static function createCategory($options) {

        // соединение с БД
        $db = Db::getConnection();

        // готовим запрос
        $sql = 'INSERT INTO category '
            . '(name, sort_order, status) '
            . 'VALUES '
            . '(:name, :sort_order, :status)';

        //выполняем запрос
        $result = $db->prepare($sql);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':sort_order', $options['sort_order'], PDO::PARAM_INT);
        $result->bindParam(':status', $options['status'], PDO::PARAM_INT);

        return $result->execute();
    }

    /**
     * удаление категории из БД
     * @param $id
     * @return bool
     */
    public static function deleteCategory($id) {

        // соединение с БД
        $db = Db::getConnection();

        // готовим запрос
        $sql = 'DELETE FROM category WHERE id = :id';

        // выполняем запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        return $result->execute();
    }

    /**
     * Обновление категории
     * @param $id
     * @param $options
     * @return bool
     */
    public static function updateCategoryById($id, $options) {

        // соединение с БД
        $db = Db::getConnection();

        // готовим запрос
        $sql = 'UPDATE category '
            . 'SET '
            . 'name = :name, '
            . 'sort_order = :sort_order, '
            . 'status = :status '
            . 'WHERE id = :id';

        //выполняем запрос
        $result = $db->prepare($sql);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':sort_order', $options['sort_order'], PDO::PARAM_INT);
        $result->bindParam(':status', $options['status'], PDO::PARAM_INT);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        return $result->execute();
    }
}