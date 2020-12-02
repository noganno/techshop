<?php

use kartik\switchinput\SwitchInput;
use kartik\select2\Select2;

?>

<div class="row">
    <div class="col-md-6">
        <?= $form->field($model, 'country_id')->widget(Select2::classname(), [
            'data' => \yii\helpers\ArrayHelper::map(\backend\models\Country::find()->all(), 'id', 'name'),
            'options' => [
                'placeholder' => Yii::t('app', "Select country"),
                'multiple' => false,
            ],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]); ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($model, 'manufacturer_id')->widget(Select2::classname(), [
            'data' => \yii\helpers\ArrayHelper::map(\common\models\Manufacturer::find()->all(), 'id', 'name'),
            'language' => 'uz',
            'options' => [
                'placeholder' => Yii::t('app', "Select Manufacturers"),
                'multiple' => false,
            ],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]); ?>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <?= $form->field($model, 'model')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($model, 'warranty_id')->widget(Select2::classname(), [
            'data' => \yii\helpers\ArrayHelper::map(\backend\models\Warranty::find()->all(), 'id', 'name'),
            'options' => [
                'placeholder' => Yii::t('app', "Warranties"),
                'multiple' => false,
            ],
            'pluginOptions' => [
                'allowClear' => true
            ],

        ]); ?>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <?= $form->field($model, 'price')->widget(\kartik\money\MaskMoney::classname(), [
            'pluginOptions' => [
                'prefix' => '$ ',
                'suffix' => ' UZS',
                'allowNegative' => false
            ]
        ]); ?>

    </div>

    <div class="col-md-6">
        <?= $form->field($model, 'sale_price')->widget(\kartik\money\MaskMoney::classname(), [
            'pluginOptions' => [
                'prefix' => '$ ',
                'suffix' => ' UZS',
                'allowNegative' => false
            ]
        ]);?>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <?= $form->field($model, 'loan_price')->widget(\kartik\money\MaskMoney::classname(), [
            'pluginOptions' => [
                'prefix' => '$ ',
                'suffix' => ' UZS',
                'allowNegative' => false
            ]
        ]);?>
    </div>
    <div class="col-md-4">
        <?= $form->field($model, 'deposit')->textInput() ?>
    </div>

    <div class="col-md-4">
        <?= $form->field($model, 'discount')->input('number', ['min' => 0, 'max' => 100 ]); ?>
    </div>
</div>


<?= $form->field($model, 'status')->widget(SwitchInput::classname(), [
    'pluginOptions' => [
        'onText' => Yii::t('app', 'Active'),
        'offText' => Yii::t('app', 'Inactive'),
    ],
]); ?>

<?= $form->field($model, 'recommend')->widget(SwitchInput::classname(), []); ?>
<?= $form->field($model, 'xit')->widget(SwitchInput::classname(), [

]); ?>

<?= $form->field($model, 'yellow_friday')->widget(SwitchInput::classname(), [

]); ?>

