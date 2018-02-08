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

                    <?php if ($productsInCart): ?>

                        <p>Вы выбрали такие товары</p>
                        <table class="table-bordered table-striped table">
                            <tr>
                                <th>Код товара</th>
                                <th>Название</th>
                                <th>Стоимость, руб.</th>
                                <th>Количество, шт</th>
                                <th>Удалить</th>
                            </tr>
                            <?php foreach ($products as $product): ?>
                                <tr>
                                    <td><?= $product['code'] ?></td>
                                    <td>
                                        <a href="/product/<?= $product['id'] ?>">
                                            <?= $product['name'] ?>
                                        </a>
                                    </td>
                                    <td><?= $product['price'] ?></td>
                                    <td><?= $productsInCart[$product['id']] ?></td>
                                    <td>
                                        <a class="btn btn-default checkout"
                                           href="/cart/delete/<?php echo $product['id']; ?>">
                                            <i class="fa fa-times"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <tr>
                                <td colspan="3">Общая стоимость:</td>
                                <td><?= $totalPrice ?></td>
                            </tr>
                        </table>

                        <a class="btn btn-default checkout" href="/cart/checkout"><i class="fa fa-shopping-cart"></i>
                            Оформить заказ</a>
                    <?php else: ?>
                        <p>Корзина пуста</p>
                    <?php endif; ?>
                </div>
            </div>

            <br/>
        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer.php'; ?>

