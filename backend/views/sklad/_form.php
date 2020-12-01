<?php

use soft\kartik\SActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Sklad */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sklad-form">

    <?php $form = SActiveForm::begin(); ?>

    <?= $form->languageSwitcher($model) ?>

    <?= \soft\form\SFormGrid::widget([
        'model' => $model,
        'form' => $form,
        'autoGenerateColumns' => false,
        'rows' => [
            [
                'columns' => 1,
                'compactGrid' => true,
                'attributes' => [
                    'address',
                    'name',
                    'description',
                ]
            ],
            [
                'columns' => 2,
                'attributes' => [
                    'region_id' => [
                        'map' => [
                            'array' => \common\models\Towns::find()->all(),
                            'to' => 'name',
                        ]
                    ],
                ]
            ],
            [
                'columns' => 2,
                'attributes' => [
                    'lat',
                    'long'
                ]
            ],
            [
                'columns' => 2,
                'attributes' => [
                    'work_time',
                    'phone'
                ]
            ],
            [
                'columns' => 2,
                'attributes' => [
                    'status',
                    'in_map' => [
                        'type' => 'widget',
                        'widgetClass' => \kartik\widgets\SwitchInput::class,
//                        'pluginOptions' => [
//                            'onText' => "Da",
//                            'offText' => t('No','yii'),
//                        ]
                    ]
                ]
            ]
        ]

    ]);

    ?>
    <?= \soft\helpers\SHtml::submitButton() ?>
    <?php SActiveForm::end(); ?>


</div>
