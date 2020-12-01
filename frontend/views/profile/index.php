<?php

$this->title = t('Profile');
$this->params['breadcrumbs'][] = t('Profile');

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
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <p><?= t('Account') ?></p>
                            <h4 class="card-title">
                                <b><?= $history['info'][0]['FIO'] ? $history['info'][0]['FIO'] : "" ?></b></h4>
                            <h6 class="card-subtitle mb-2 text-muted"><?= t('Phone') . ": " . Yii::$app->help->clearPhoneNumber($history['info'][0]['TelefonNumber'][0]['telephone'] ? $history['info'][0]['TelefonNumber'][0]['telephone'] : "") ?></h6>
                            <br>
                            <a href="<?= url_to(['profile/personal-data']) ?>"
                               class="card-link"><i class="fa fa-pencil"></i> <?= t('Edit data') ?></a>
                            <!--                            <a href="#" class="card-link">Another link</a>-->
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <p><?= t('Мои покупки') ?></p>
                            <h4 class="card-title"><b><?= $countProducts . " товара" ?></b></h4>
                            <h6 class="card-subtitle mb-2 text-muted"><?=t('Address').": "?><?= $history['info'][0]['Address'][0]['address'] ? $history['info'][0]['Address'][0]['address'] : "" ?></h6>
                            <br>
                            <a href="<?= url_to(['profile/moi-pokupki']) ?>"
                               class="card-link"><i class="fa fa-eye"></i> <?= t('Podrobnee') ?></a>
                            <!--                            <a href="#" class="card-link">Another link</a>-->
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <p><?= t('Мои бонусы') ?></p>
                            <h5 class="card-title text-danger"><?= "Ведутся технические работы" ?></h5>
                            <h6 class="card-subtitle mb-2 text-muted"><?= "Используйте баллы для погошение рассрочки" ?></h6>
                            <br>
                            <!--                            <a href="-->
                            <? //= url_to(['profile/personal-data']) ?><!--"-->
                            <!--                               class="card-link">--><? //= t('Edit data') ?><!--</a>-->
                            <!--                            <a href="#" class="card-link">Another link</a>-->
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <p><?= t('Моя карта') ?></p>
                            <h4 class="card-title"><b><?= t('Карта') ?>
                                    «<?= $history['info'][1] ? $history['info'][1]['Name'] : t('Not inserted') ?>»</b>
                            </h4>
                            <h6 class="card-subtitle mb-2 text-muted"></h6>
                            <br>
                            <a href="<?= url_to(['profile/moya-karta']) ?>"
                               class="card-link"><i class="fa fa-eye"></i> <?= t('Podrobnee') ?></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <p><?= t('Мои договора') ?></p>
                            <h2 class="card-title"><b><?= (is_array($history['info'][2])) && count($history['info'][2]) > 0 ? "Договор:
                                    № ".$history['info'][2][array_key_last($history['info'][2])]['ContractNumber'] : t('No dogovors') ?></b>
                            </h2>
                            <h6 class="card-subtitle mb-2 text-muted"><?= t("Просмотреть все договора о покупках") ?></h6>
                            <br>
                            <a href="<?= url_to(['profile/credit-history']) ?>"
                               class="card-link"><i class="fa fa-eye"></i> <?= t('Podrobnee') ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>