<?php include_once ROOT . '/views/layouts/header_admin.php'; ?>

    <section>
        <div class="container">
            <div class="row">

                <br/>

                <div>
                    <ol class="breadcrumb">
                        <li><a href="/admin">Админпанель</a></li>
                        <li class="active">Управление заказами</li>
                    </ol>
                </div>

                <h4>Список заказов</h4>

                <br/>

                <table class="table-bordered table-striped table">
                    <tr>
                        <th>Id заказа</th>
                        <th>Имя покупателя</th>
                        <th>Телефон покупателя</th>
                        <th>Дата оформления</th>
                        <th>Статус</th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                    <?php foreach ($orderList as $order): ?>
                        <tr>
                            <th><?= $order['id'] ?></th>
                            <th><?= $order['user_name'] ?></th>
                            <th><?= $order['user_phone'] ?></th>
                            <th><?= $order['date'] ?></th>
                            <th><?= Order::getStatusText($order['status']) ?>
                            </th>
                            <td><a href="/admin/order/view/<?= $order['id']; ?>" title="Смотреть"><i
                                            class="fa fa-eye"></i></a></td>
                            <th><a href="/admin/order/update/<?= $order['id'] ?>" title="Редактировать"><i
                                            class="fa fa-pencil-square-o"></i></a></th>
                            <th><a href="/admin/order/delete/<?= $order['id'] ?>" title="Удалить"><i
                                            class="fa fa-times"></i></a></th>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </section>

<?php include_once ROOT . '/views/layouts/footer.php'; ?>