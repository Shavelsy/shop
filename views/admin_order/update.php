<?php include ROOT . '/views/layouts/header_admin.php'; ?>

    <section>
        <div class="container">
            <div class="row">

                <br/>

                <div>
                    <ol class="breadcrumb">
                        <li><a href="/admin">Админпанель</a></li>
                        <li><a href="/admin/order">Управление заказами</a></li>
                        <li class="active">Редактировать заказ</li>
                    </ol>
                </div>

                <h4>Редактиовать заказ #<?= $id ?></h4>

                <br/>

                <div class="col-lg-4">
                    <div class="login-form">
                        <form action="#" method="post" enctype="multipart/form-data">

                            <p>Имя клиента</p>
                            <input type="text" name="user_name" placeholder="" value="<?= $order['user_name'] ?>">

                            <p>Телефон клиента</p>
                            <input type="text" name="user_phone" placeholder="" value="<?= $order['user_phone'] ?>">

                            <p>Комментарий клиента</p>
                            <input type="text" name="user_comment" placeholder="" value="<?= $order['user_comment'] ?>">

                            <p>Дата оформления заказа</p>
                            <input type="text" name="date" placeholder="" value="<?= $order['date'] ?>">

                            <p>Статус</p>
                            <select name="status">
                                <option value="3" <?php if ($order['status'] == 3) echo 'selected="selected"'; ?>>Новый заказ</option>
                                <option value="2" <?php if ($order['status'] == 2) echo 'selected="selected"'; ?>>В обработке</option>
                                <option value="1" <?php if ($order['status'] == 1) echo 'selected="selected"'; ?>>Доставляется</option>
                                <option value="0" <?php if ($order['status'] == 0) echo 'selected="selected"'; ?>>Закрыт</option>
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