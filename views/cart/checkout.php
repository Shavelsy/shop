<?php include ROOT . '/views/layouts/header.php'; ?>

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">
                    <h2>Каталог</h2>
                    <div class="panel-group category-products">
                        <?php foreach ($categories as $categoryItem): ?>
                            <?php if ($categoryItem['status'] == 1): ?>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a href="/category/<?= $categoryItem['id']; ?>">
                                                <?= $categoryItem['name']; ?>
                                            </a>
                                        </h4>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <div calss="col-sm-9 padding-right">
                <div class="features_items">
                    <h2 class="title text-center">Корзина</h2>

                    <?php if ($result): ?>
                        <p>Заказ оформлен. Мы вам перезвоним</p>
                    <?php else: ?>

                        <p>Выбрано товаров: <?= $totalQuantity ?>, на сумму <?= $totalPrice ?></p>

                        <div class="col-sm-4">
                            <?php if (isset($errors) && is_array($errors)): ?>
                                <ul>
                                    <?php foreach ($errors as $error): ?>
                                        <li>- <?= $error ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>

                            <p>Для оформления заказа заполните форму. Наш менеджер свяжется с вами</p>

                            <div class="login-form">
                                <form action="#" method="post">

                                    <p>Ваше имя</p>
                                    <input type="text" name="name" value="<?= $userName ?>">

                                    <p>Номер телефона</p>
                                    <input type="text" name="phone" value="<?= $userPhone ?>">

                                    <p>Комментарий к заказу</p>
                                    <input type="text" name="comment" placeholder="Сообщение"
                                           value="<?= $userComment ?>">

                                    <br/>
                                    <br/>
                                    <input type="submit" name="submit" class="btn btn-default" value="Оформить">
                                </form>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer.php'; ?>

