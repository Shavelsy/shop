<?php include ROOT . '/views/layouts/header.php'; ?>

<section>
    <div class="container">
        <div class="col-sm-4 col-sm-offset-4 padding-right">
            <?php if ($result): ?>
                <p>Вы зарегистрированы!</p>
            <?php else: ?>

                <?php if (isset($errors) && is_array($errors)): ?>
                    <ul>
                        <?php foreach ($errors as $error): ?>
                            <li> - <?= $error ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif ?>

                <div class="signup-form">
                    <h2>Регистрация на сайте</h2>
                    <form aaction="#" method="post">
                        <input type="text" name="name" placeholder="Имя" value="<?= $name; ?>"/>
                        <input type="email" name="email" placeholder="E-mail" value="<?= $email; ?>"/>
                        <input type="password" name="password" placeholder="Пароль" value="<?= $password; ?>"/>
                        <button type="submit" name="submit" class="btn btn-default">Регистрация</button>
                    </form>
                </div>

            <?php endif; ?>
            <br/>
            <br/>
        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer.php'; ?>
