<?php include ROOT . '/views/layouts/header_admin.php'; ?>

    <section>
        <div class="container">
            <div class="row">

                <br/>

                <div>
                    <ol class="breadcrumb">
                        <li><a href="/admin">Админпанель</a></li>
                        <li><a href="/admin/product">Управление товарами</a></li>
                        <li class="active">Добавить товар</li>
                    </ol>
                </div>

                <h4>Добавить новый товар</h4>

                <br/>

                <?php if (isset($errors) && is_array($errors)): ?>
                    <ul>
                        <?php foreach ($errors as $error): ?>
                            <li> - <?= $error; ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>

                <div class="col-lg-4">
                    <div class="login-form">
                        <form action="#" method="post" enctype="multipart/form-data">

                            <p>Название товара</p>
                            <input type="text" name="name" placeholder="" value="<?= $product['name'] ?>">

                            <p>Артикул</p>
                            <input type="text" name="code" placeholder="" value="<?= $product['code'] ?>">

                            <p>Стоимость, руб.</p>
                            <input type="text" name="price" placeholder="" value="<?= $product['price'] ?>">

                            <p>Категория</p>
                            <select name="category_id">
                                <?php if (is_array($categoriesList)): ?>
                                    <?php foreach ($categoriesList as $category): ?>
                                        <option value="<?= $category['id']; ?>"
                                            <?php if ($product['category_id'] == $category['id']) echo ' selected="selected"'; ?>>
                                            <?= $category['name']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>

                            <br/><br/>

                            <p>Производитель</p>
                            <input type="text" name="brand" placeholder="" value="<?= $product['brand'] ?>">

                            <p>Детальное описание</p>
                            <textarea name="description"><?= $product['description'] ?></textarea>

                            <br/><br/>

                            <p>Наличие на складе</p>
                            <select name="availability">
                                <option value="1" <?php if ($product['avalibillity'] == 1) echo ' selected="selected"'; ?>>
                                    Да
                                </option>
                                <option value="0" <?php if ($product['avalibillity'] == 0) echo ' selected="selected"'; ?>>
                                    Нет
                                </option>
                            </select>

                            <br/><br/>

                            <p>Новинка</p>
                            <select name="is_new">
                                <option value="1" <?php if ($product['is_new'] == 1) echo ' selected="selected"'; ?>>
                                    Да
                                </option>
                                <option value="0" <?php if ($product['is_new'] == 0) echo ' selected="selected"'; ?>>
                                    Нет
                                </option>
                            </select>

                            <br/><br/>

                            <p>Рекомендуемые</p>
                            <select name="is_recommended">
                                <option value="1" <?php if ($product['is_recomenended'] == 1) echo ' selected="selected"'; ?>>
                                    Да
                                </option>
                                <option value="0" <?php if ($product['is_recomenended'] == 0) echo ' selected="selected"'; ?>>
                                    Нет
                                </option>
                            </select>

                            <br/><br/>

                            <p>Статус</p>
                            <select name="status">
                                <option value="1" <?php if ($product['status'] == 1) echo ' selected="selected"'; ?>>
                                    Отображается
                                </option>
                                <option value="0" <?php if ($product['status'] == 0) echo ' selected="selected"'; ?>>
                                    Скрыт
                                </option>
                            </select>

                            <br/><br/>

                            <input type="submit" name="submit" class="btn btn-default" value="Сохранить">

                            <br/><br/>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>

<?php include ROOT . '/views/layouts/footer.php'; ?>