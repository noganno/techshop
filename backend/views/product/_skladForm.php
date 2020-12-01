<?php

use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

$sklads = \common\models\Sklad::find()->all();

echo $form->field($model, 'sklad_values')->widget(\unclead\multipleinput\MultipleInput::className(), [


    'sortable' => true,
    'columns' => [
        [
            'type' => Select2::class,
            'options' => [
                'data' => ArrayHelper::map($sklads, 'id', 'description'),
                'options' => [
                    'placeholder' => t('Select'),

                ],
                'pluginOptions' => [
                    'allowClear' => true,
                ]
            ],
            'name' => 'sklad_id',
            'title' => Yii::t('app', 'Sklad'),
        ],
        [
            'name' => 'quantity',
            'title' => t('Quantity'),
            'options' => [
                'type' => 'number',
                'min' => 0,
            ],
            'defaultValue' => 1,
        ]
    ]
])->label(false);
?>