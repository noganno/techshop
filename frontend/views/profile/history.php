<?php


$this->title = t('Personal data');
$this->params['breadcrumbs'][] = t('Personal cabinet');
$this->params['breadcrumbs'][] = t('Credit History');

use kartik\grid\GridView;

$css = <<<CSS

    div.required label:after{
        content: " *";
    }

CSS;


$sumDogovor = 0;
$sumDebt = 0;

$this->registerCss($css);

?>

<!-- Start of .personal-page -->
<div class="main-block personal-page universal-page">

    <!--    --><? //= dump($history) ?>
    <div class="auto-container main-container">
        <?= $this->render('_profileLeft') ?>


        <div class="article">
            <div class="p-3 p-md-5">
                <h1 class="title"><?= t('Dogovori') ?></h1>
                <p class="description">
                    <?= t('Welcome') ?>
                    <strong><?= $history['info'][0]['FIO'] ?></strong>
                </p>


                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'columns' => [
                        [
                            'class' => '\kartik\grid\ExpandRowColumn',

                            'expandIcon' => "<i class='fa fa-plus-square-o'></i>",

                            'collapseIcon' => "<i class='fa fa-minus-square-o'></i>",

                            'format' => 'raw',

                            'value' => function () {
                                return GridView::ROW_COLLAPSED;
                            },

                            'expandOneOnly' => true,

                            'detail' => function ($model) {

                                return Yii::$app->view->render('_order_items', ['model' => $model]);

                            }
                        ],
                        [
                            'attribute' => "ContractNumber",
                            'label' => t('ContractNumber')
                        ],
                        [
                            'attribute' => "ContractDate",
                            'format' => 'datetime',
                            'label' => t('ContractDate')
                        ],
                        [
                            'attribute' => "Sum",
                            'format' => 'sum',
                            'label' => t('Sum')
                        ],
                        [
                            'attribute' => "DebtTotal",
                            'format' => 'sum',
                            'label' => t('DebtTotal')
                        ],
//                        'Status'=>t('Status'),
                    ],
                ]) ?>


                <!--                <div class="bonus-table mt-5">-->
                <!--                    <h1 class="title">Бонусная система</h1>-->
                <!--                    <table>-->
                <!--                        <tr>-->
                <!--                            <th>Тип бонусной карты:</th>-->
                <!--                            <td>-->
                <? //= $history['info'][1] ? $history['info'][1]['Name'] : "" ?><!--</td>-->
                <!--                        </tr>-->
                <!--                        <tr>-->
                <!--                            <th>Остаток бонусов:</th>-->
                <!--                            <td>0</td>-->
                <!--                        </tr>-->
                <!--                        <tr>-->
                <!--                            <th>Процнт конвертации:</th>-->
                <!--                            <td>0</td>-->
                <!--                        </tr>-->
                <!--                        <tr>-->
                <!--                            <th>Сумма конвертации:</th>-->
                <!--                            <td>0</td>-->
                <!--                        </tr>-->
                <!---->
                <!--                    </table>-->
                <!--                </div>-->
            </div>
        </div>
    </div>
</div>


