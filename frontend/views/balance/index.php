<?php


use common\models\ProductAttribute;
$this->title = t('Balance');
$this->params['breadcrumbs'][] = $this->title;
$lang = Yii::$app->language;


?>

<!-- Start of .main-block-2 -->
<div class="main-block-2 compare">
    <div class="auto-container table-responsive table-responsive-xl">
        <?php if ($products): ?>
            <table class="table table-bordered ">
                <thead>
                <tr>
                    <th scope="col"></th>

                    <?php foreach ($products as $product): ?>
                        <th scope="col">
                            <div class="table-product">
                                <a href="<?= $product->detailUrl ?>" class="img">
                                    <img src="<?= $product->image ?>">
                                </a>
                                <a href="<?= $product->detailUrl ?>" class="name"><?= $product->name ?></a>
                                <div class="btns">
                                <span href="#" class="btn btn-yellow-2 add-to-cart"
                                      data-product-id="<?= $product->id ?>"><i class="fa fa-cart-arrow-down"></i></span>
                                    <a href="<?= \yii\helpers\Url::to(['balance/remove-from-balance', 'id' => $product->id]) ?>"
                                       class="link-delete"><i class="fa fa-remove"></i> <?= t("Delete") ?></a>
                                </div>
                            </div>
                        </th>
                    <?php endforeach; ?>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th scope="row"><?= Yii::t('app', 'Sale Price') ?></th>
                    <?php foreach ($products as $product): ?>
                        <td><span><?= Yii::$app->formatter->asSum($product->sale_price) ?></span></td>
                    <?php endforeach; ?>
                </tr>
                <tr>
                    <th scope="row"><?= Yii::t('app', 'Loan Price') ?></th>
                    <?php foreach ($products as $product): ?>
                        <td><span><?= Yii::$app->formatter->asSum($product->loan_price) ?></span></td>
                    <?php endforeach; ?>
                </tr>
                <tr>
                    <th scope="row"><?= Yii::t('app', 'Model') ?></th>
                    <?php foreach ($products as $product): ?>
                        <td><span><?= $product->model ?></span></td>
                    <?php endforeach; ?>
                </tr>
                <tr>
                    <th scope="row"><?= Yii::t('app', 'Manufacturer') ?></th>
                    <?php foreach ($products as $product): ?>
                        <td><span><?= $product->manufacturer == null ? "" : $product->manufacturer->name ?></span>
                        </td>
                    <?php endforeach; ?>
                </tr>
                <?php foreach ($attributes as $attribute): ?>

                    <tr>
                        <th scope="row"><?= $attribute->title ?></th>
                        <?php foreach ($products as $product): ?>
                        <?php $pAttribute = ProductAttribute::findOne([
                                'attribute_id' => $attribute->id,
                                'product_id' => $product->id,
                                'language' => $lang
                            ]); ?>
                            <td>
                                <span>
                                    <?= $pAttribute == null ? '' : $pAttribute->text ?>
                                </span>
                            </td>
                        <?php endforeach; ?>
                    </tr>

                <?php endforeach ?>


                </tbody>
            </table>
        <?php else: ?>
        <div class="container">
        <h1><?=t('There is any products! Please add products to balance first!')?></h1>
        </div>
        <?php endif;?>
    </div>
</div>
<!-- End of .main-block-2 -->


