<?php include ROOT . '/views/layouts/header.php'; ?>

    <section>
        <div class="container">
            <div class="row">

                <?php foreach ($ordersList as $order): ?>

                    <h4>Просмотр заказа #<?= $order['id']; ?></h4>
                    <br/>

                    <h5>Информация о заказе</h5>
                    <table class="table-admin-small table-bordered table-striped table">
                        <tr>
                            <td>Номер заказа</td>
                            <td><?= $order['id']; ?></td>
                        </tr>
                        <tr>
                            <td>Имя клиента</td>
                            <td><?= $order['user_name']; ?></td>
                        </tr>
                        <tr>
                            <td>Телефон клиента</td>
                            <td><?= $order['user_phone']; ?></td>
                        </tr>
                        <tr>
                            <td>Комментарий клиента</td>
                            <td><?= $order['user_comment']; ?></td>
                        </tr>
                        <tr>
                            <td><b>Дата заказа</b></td>
                            <td><?= $order['date']; ?></td>
                        </tr>
                    </table>

                    <h5>Товары в заказе</h5>

                    <table class="table-admin-medium table-bordered table-striped table ">
                        <tr>
                            <th>ID товара</th>
                            <th>Артикул товара</th>
                            <th>Название</th>
                            <th>Цена</th>
                            <th>Количество</th>
                        </tr>
                        <?php foreach ($products[$order['id']] as $product): ?>
                            <tr>
                                <td><?= $product['id']; ?></td>
                                <td><?= $product['code']; ?></td>
                                <td><?= $product['name']; ?></td>
                                <td><?= $product['price'] . ' руб.'; ?></td>
                                <td><?= $productsListArray[$order['id']][$product['id']]; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>


                    <br/>
                    <br/>
                <?php endforeach; ?>
            </div>
        </div>


    </section>

<?php include ROOT . '/views/layouts/footer.php'; ?>