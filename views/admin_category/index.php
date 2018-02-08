<?php include_once ROOT . '/views/layouts/header_admin.php'; ?>

    <section>
        <div class="container">
            <div class="row">

                <br/>

                <div>
                    <ol class="breadcrumb">
                        <li><a href="/admin">Админпанель</a></li>
                        <li class="active">Управление категориями</li>
                    </ol>
                </div>

                <a href="/admin/category/create" class="btn btn-default back"><i class="fa fa-plus"></i>Добавить
                    категорию</a>

                <h4>Список категорий</h4>

                <br/>

                <table class="table-bordered table-striped table">
                    <tr>
                        <th>Id категории</th>
                        <th>Название категории</th>
                        <th>Порядковый номер</th>
                        <th>Статус</th>
                        <th></th>
                        <th></th>
                    </tr>
                    <?php foreach ($categoryList as $category): ?>
                        <tr>
                            <th><?= $category['id'] ?></th>
                            <th><?= $category['name'] ?></th>
                            <th><?= $category['sort_order'] ?></th>
                            <th><?php if ($category['status'] == 1) echo 'Отображается'; else echo 'Не отображается'; ?></th>
                            <th><a href="/admin/category/update/<?= $category['id'] ?>" title="Редактировать"><i
                                        class="fa fa-pencil-square-o"></i></a></th>
                            <th><a href="/admin/category/delete/<?=$category['id'] ?>" title="Удалить"><i
                                        class="fa fa-times"></i></a></th>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </section>

<?php include_once ROOT . '/views/layouts/footer.php'; ?>