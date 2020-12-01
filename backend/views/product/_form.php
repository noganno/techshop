<?php

use common\models\Attribute;
use common\models\AttributeGroup;
use common\models\Category;
use common\models\Length;
use common\models\Manufacturer;
use common\models\StockStatus;
use common\models\Weight;
use kartik\select2\Select2;
use kartik\switchinput\SwitchInput;
use mihaildev\ckeditor\CKEditor;
use unclead\multipleinput\MultipleInput;
use unclead\multipleinput\MultipleInputColumn;
use yeesoft\multilingual\widgets\ActiveForm;
use yii\helpers\Html;
use zxbodya\yii2\galleryManager\GalleryManager;


/* @var $this yii\web\View */
/* @var $model common\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->errorSummary($model) ?>
    <div class="row">
        <div class="col-md-12">
            <?= \yii\bootstrap\Tabs::widget([
                'navType' => "nav-pills",
                'itemOptions' => [
                    'style' => [
                        'padding' => '10px',
                        'padding-top' => '30px'
                    ]
                ],
                'items' => [
                    [
                        'label' => t('mainElements'),
                        'content' => $this->render('_mainElements', [
                            'model' => $model,
                            'form' => $form
                        ]),
                        'active' => true
                    ],
                    [
                        'label' => t('Description'),
                        'content' => $this->render('_descElements', [
                            'model' => $model,
                            'form' => $form
                        ]),
                    ],
                    [
                        'label' => t('extraElements'),
                        'content' => $this->render('_extraElements', [
                            'model' => $model,
                            'form' => $form
                        ]),
                    ],
                    [
                        'label' => t('attributes'),
                        'content' => $this->render('_attributes', [
                            'model' => $model,
                            'form' => $form,
                            'attribute_form' => $attribute_form
                        ]),
                    ],
                    [
                        'label' => t('Images'),
                        'content' => $this->render('_images', [
                            'model' => $model,
                            'form' => $form
                        ]),
                    ],

                    [
                        'label' => t('Sklad'),
                        'content' => $this->render('_skladForm', [
                            'model' => $model,
                            'form' => $form
                        ]),
                    ],


                ],
            ]); ?>
        </div>
    </div>

    <!--    <div class="col-md-12">-->
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>
    <!--        </div>-->
    <?php ActiveForm::end(); ?>
</div>