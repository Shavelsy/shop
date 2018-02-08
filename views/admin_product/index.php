<?php include_once ROOT . '/views/layouts/header_admin.php'; ?>

    <section>
        <div class="container">
            <div class="row">

                <br/>

                <div>
                    <ol class="breadcrumb">
                        <li><a href="/admin">Админпанель</a></li>
                        <li class="active">Управление товарами</li>
                    </ol>
                </div>

                <a href="/admin/product/create" class="btn btn-default back"><i class="fa fa-plus"></i>Добавить
                    товар</a>

                <h4>Список товаров</h4>

                <br/>

                <table class="table-bordered table-striped table">
                    <tr>
                        <th>Id товара</th>
                        <th>Артикул</th>
                        <th>Название товара</th>
                        <th>Цена</th>
                        <th></th>
                        <th></th>
                    </tr>
                    <?php foreach ($productsList as $product): ?>
                        <tr>
                            <th><?= $product['id'] ?></th>
                            <th><?= $product['code'] ?></th>
                            <th><?= $product['name'] ?></th>
                            <th><?= $product['price'] ?></th>
                            <th><a href="/admin/product/update/<?= $product['id'] ?>" title="Редактировать"><i
                                            class="fa fa-pencil-square-o"></i></a></th>
                            <th><a href="/admin/product/delete/<?= $product['id'] ?>" title="Удалить"><i
                                            class="fa fa-times"></i></a></th>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </section>

<?php include_once ROOT . '/views/layouts/footer.php'; ?>