<?php include_once ROOT . '/views/layouts/header_admin.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <br/>

            <div>
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li><a href="/admin/order">Управление заказами</a></li>
                    <li class="active">Удалить заказа</li>
                </ol>
            </div>

            <h4>Удалить заказ #<?= $id ?></h4>

            <p>Вы действительно хотите удалить заказ?</p>

            <form action="#" method="post">
                <input type="submit" name="submit" value="Удалить">
            </form>

            <br/>

        </div>
    </div>
</section>

<?php include_once ROOT . '/views/layouts/footer.php'; ?>
