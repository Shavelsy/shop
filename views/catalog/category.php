<?php include ROOT . '/views/layouts/header.php'; ?>

    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="left-sidebar">
                        <h2>Каталог</h2>

                        <div class="panel-group category-products">
                            <?php foreach ($category as $categoryItem): ?>
                                <?php if ($categoryItem['status'] == 1): ?>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a href="/category/<?= $categoryItem['id']; ?>"
                                                   class="<?php if ($categoryItem['id'] == $categoryId) echo 'active'; ?>">
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

                <div class="col-sm-9 padding-right">
                    <div class="features_items"><!--features_items-->
                        <h2 class="title text-center">Последние товары</h2>
                        <?php foreach ($latestProduct as $product): ?>
                            <div class="col-sm-4">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img src="<?= Product::getImage($product['id']); ?>" alt=""/>
                                            <h2><?= $product['price'] . ' руб.'; ?></h2>
                                            <p>
                                                <a href="/product/<?= $product['id']; ?>">
                                                    <?= $product['name']; ?>
                                                </a>
                                            </p>
                                            <a href="/cart/add/<?= $product['id']; ?>"
                                               class="btn btn-default add-to-cart"><i
                                                        class="fa fa-shopping-cart"></i>Вкорзину</a>
                                            <?php if ($product['is_new'] == 1): ?>
                                                  <img src="template/images/home/new.png" class="new" alt=""/>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>

                    </div><!--features_items-->

                    <!-- Постраничная навигация -->
                    <?php echo $pagination->get(); ?>

                </div>
            </div>
        </div>
    </section>

<?php include ROOT . '/views/layouts/footer.php'; ?>