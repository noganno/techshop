<?php

use yii\bootstrap4\ActiveForm;
use yii\widgets\MaskedInput;

$count = $fastOrderModel->count;
$js = <<<JS

       $('#fast-order-tel').inputmask('+999 (99) 999-99-99')

JS;
$this->registerJs($js);

?>

<?php $form = ActiveForm::begin([
    'action' => ['fast-order/send'],
    'id' => 'fast-order-form',
]); ?>
    <ul class="product-wrapper">
        <li class="product-item" data-id="<?= $product->id ?>">
            <div class="img">
                <img src="<?= $product->getImage('cart') ?>">
            </div>
            <h1 class="name"><?= e($product->name) ?></h1>
            <div class="count-product">
                <span class="control minus minus-from-fast-order">-</span>
                <span class="value" id="span-count"><?= $count ?></span>
                <span class="control plus plus-to-fast-order">+</span>
            </div>
            <span class="price total-summ">
                <?= \yii\helpers\Html::hiddenInput('', $product->sale_price, ['id' => 'product-sale-price']) ?>
                <?= Yii::$app->formatter->asSum($product->sale_price * $count) ?>
                </span>
        </li>
    </ul>
    <div class="form-row">
        <div class="form-group col-md-6">
            <?= $form->field($fastOrderModel, 'name')->textInput(['placeholder' => t('Your name')]) ?>
            <?= $form->field($fastOrderModel, 'count')->hiddenInput(['id' => 'fast-order-count'])->label(false) ?>
            <?= $form->field($fastOrderModel, 'product_id')->hiddenInput()->label(false) ?>
        </div>
        <div class="form-group col-md-6">
            <?= $form->field($fastOrderModel, 'tel')->textInput([
                    'id' => 'fast-order-tel',
                    'value' => '+998',
                    'readOnly' => $telReadOnly,

            ])?>
        </div>
    </div>
<?php ActiveForm::end(); ?>