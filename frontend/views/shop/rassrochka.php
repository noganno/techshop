<?php


use yii\bootstrap4\ActiveForm;
use yii\widgets\MaskedInput;


$sum = 0;
$total = 0;
$this->title = t("Оформить рассрочку");
$this->params['breadcrumbs'][] = $this->title;


?>
    <!-- Start of .main-block -->
    <div class="main-block ordering">

        <?php $form = ActiveForm::begin(['options' => ['class' => 'auto-container']]); ?>

        <div class="container">
            <h1 class="title"><?= $this->title ?></h1>
            <p class="text">* - <?= t('Required fields.') ?></p>

            <div class="form-row mt-4">
                <?= $form->field($model, 'fio', ['options' => ['class' => 'form-group col-md-6 col-12 col-xl-4']])->textInput([
                    'class' => 'form-control',
                    'placeholder' => t('FIO'),
                ]) ?>

                <?= $form->field($model, 'address', ['options' => ['class' => 'form-group col-md-6 col-12 col-xl-4']])->textInput([
                    'class' => 'form-control',
                    'placeholder' => t('Address'),

                ]) ?>

                <?= $form->field($model, 'phone', ['options' => ['class' => 'form-group col-md-6 col-12 col-xl-4']])->textInput([
                    'class' => 'form-control registration-phone',
//                    'hidden'=>true,
                    'placeholder' => t("Phone"),

                ])?>



            </div>
            <div class="form-row mt-4">

                <?= $form->field($model, 'comment', ['options' => ['class' => 'form-group col-md-12 col-12 col-xl-4']])->textarea([
                    'class' => 'form-control',
                    'rows' => 10,
                    'placeholder' => t('Comment')
                ]) ?>
                <?=  $form->field($model, 'payment_type', ['options' => ['class' => 'form-group col-md-6 col-12 col-xl-4']])->dropDownList(
                    \yii\helpers\ArrayHelper::map(\common\models\PaymentTypes::find()->all(), 'id', 'name')) ?>


            </div>

            <div class="form-group my-5 pb-3 col-12 form-check">
                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" required>
                    Я принимаю <a href="#">условия использования сервиса</a>
                </label>
            </div>


            <div class="table-responsive table-responsive-lg mt-5 ordering-table">
                <table class="table border-bottom">
                    <thead>
                    <tr>
                        <!-- <th scope="col">#</th> -->
                        <th scope="col"></th>
                        <th scope="col"><?= t('Product Name') ?></th>
                        <th scope="col"><?= t('Amount') ?></th>
                        <!--                        <th scope="col">--><?//= t('Sale Price') ?><!--</th>-->
                    </tr>
                    </thead>
                    <tbody>

                    <?php foreach (Yii::$app->cart->items as $id => $count): ?>
                        <tr>
                            <th>
                                <div class="img">
                                    <img src="<?= $products[$id]->image ?>">
                                </div>
                            </th>
                            <td><?= $products[$id]->name ?></td>
                            <td><?= $count ?></td>
                            <!--                            <td>-->
                            <? //= Yii::$app->formatter->asSum($products[$id]->sale_price) ?><!--</td>-->
                        </tr>
                        <?php
                        $sum = $products[$id]->sale_price * $count;
                        $total += $sum;
                        ?>

                    <?php endforeach; ?>

                    </tbody>
                </table>
            </div>

            <div class="ordering-total">
                <i class="fa fa-cart-arrow-down"></i>
                <p class="text"><?= t('Total') ?>: <?= t('Products count') ?>: <span
                            class="count-product"><?= Yii::$app->cart->getCountItems() ?></span>, <?php // t('Total price') ?>
                    <!-- --><? /*= Yii::$app->formatter->asSum($total) */ ?>
                </p>
                <button class="btn btn-yellow-3"><?= t('Оформить рассрочку') ?></button>
            </div>

        </div>
        <?php ActiveForm::end(); ?>
    </div>
    <!-- End of .main-block -->
<?php
