<?php include ROOT . '/views/layouts/header.php'; ?>

    <section>
        <div class="container">
            <h1>Кабинет пользователя</h1>

            <h3>Привет, <?php echo $user['name']; ?></h3>
            <ul>
                <li><a href="/cabinet/edit">Редактирование данных</a></li>
                <li><a href="/user/history">Список покупок</a></li>
            </ul>
        </div>
    </section>

<?php include ROOT . '/views/layouts/footer.php'; ?>