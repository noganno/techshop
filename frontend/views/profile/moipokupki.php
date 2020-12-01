<?php

$this->title = t('Profile');
$this->params['breadcrumbs'][] = t('Profile');
$this->params['breadcrumbs'][] = t('Moi Pokupki');

//$css = <<<CSS
//
//    div.required label:after{
//        content: " *";
//    }
//
//CSS;
//
//
//$this->registerCss($css);
//
//?>
<!-- Start of .personal-page -->
<div class="main-block personal-page universal-page">

    <div class="auto-container main-container">
        <?= $this->render('_profileLeft') ?>
        <div class="article" style="background: #F4F4F4">
            <div class="container" style=" min-height: 400px">
                <?php if (is_array($history['info'][2])): ?>
                    <?php foreach ($history['info'][2] as $dogovor): ?>

                        <div class="row p-4 mt-4" style="background: #fff">
                            <div class="col-md-3">
                                <div class="cab-item-card_info">
                                    <p>
                                        Дата<br> <?= Yii::$app->formatter->asFullDateUz(strtotime($dogovor['ContractDate'])) ?>
                                    </p>
                                    <p>Договор:<br> № <?= $dogovor['ContractNumber'] ?></p>
                                    <p>Адрес<br><?= $history['info'][0]['Address'][0]['address'] ?></p>
                                    <p>Общая сумма заказа: <br> <?= Yii::$app->formatter->asSum($dogovor['Sum']) ?></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <?php foreach ($dogovor['GoodsList'] as $item): ?>
                                    <?php
                                    $product = \common\models\Product::findOne([['unique_id' => $item['ID']]]);
                                    ?>
                                    <div class="row">
                                        <div class="col-3">
                                            <!--                                            <img border="0"-->
                                            <!--                                                 src="-->
                                            <? //= $product->name ?><!--"-->
                                            <!--                                                 alt="-->
                                            <? //= $product->name ?><!--" title="--><? //= $product->name ?><!--">-->
                                        </div>
                                        <div class="col-9">
                                            <p><?= $item['Good'] ?>
                                                <br><b><?= Yii::$app->formatter->asSum($item['Price']) ?></b></p>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <div class="col-md-3">
                                <div class="cab-item-card_num-wrap">
                                    <div class="cab-item-card_num_item">
                                        <p>Сумма предоплаты <br>
                                            <b><?= Yii::$app->formatter->asSum($dogovor['Prepayment']) ?></b></p>

                                        <!--                                <i class="fa fa-check"></i>-->
                                    </div>
                                    <div class="cab-item-card_num_item">
                                        <p>Обшая сумма к оплате
                                            <br><b><?= Yii::$app->formatter->asSum($dogovor['Sum']) ?></b></p>

                                    </div>
                                    <div class="cab-item-card_num_item bb-none">
                                        <p>Ежемесячный оплата
                                            <br><b><?= Yii::$app->formatter->asSum($dogovor['MonthlyCredit']) ?></b></p>

                                    </div>

                                    <div class="cab-item-card_num_total">
                                        <?= $dogovor['Status'] ? '<div class="text-success cab-item-card_num_total_und"><b>Договор закрыт</b></div>' : "" ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif ?>
            </div>
        </div>
    </div>
</div>
</div>