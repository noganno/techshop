<?php


$this->title = t('Personal data');
$this->params['breadcrumbs'][] = t('Personal cabinet');
$this->params['breadcrumbs'][] = t('Order History');


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

    <div class="auto-container main-container">
        <?= $this->render('_profileLeft') ?>

        <!--        --><? //= dump($history) ?>

        <div class="article">
            <div class="p-3 p-md-5">
                <h1 class="title"><?= t('Orders') ?></h1>

                <div class="table-responsive mt-4">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col"><?= t('Order ID') ?></th>
                            <th scope="col"><?= t('Order Amount') ?></th>
                            <th scope="col"><?= t('Order Status') ?></th>
                        </tr>
                        </thead>
                        <?php if ($orders): ?>
                            <tbody>


                            <?php foreach ($orders as $order): ?>

                                <?php $sumDogovor += $order->amount; ?>
                                <tr>
                                    <td>
                                        <a href="#">
                                            #<?= $order->id ?>
                                        </a>
                                    </td>
                                    <td><span>  <?= $order->amount ?></span> сум</td>
                                    <td><span><?= $order->orderStatus->title ?></span></td>
                                </tr>

                            <?php endforeach; ?>
                            <!--                        <tr class="residue">-->
                            <!--                            <td>-->
                            <!--                                <a href="#">-->
                            <!--                                    Договор № M1_2016_211 от марта 2016 года-->
                            <!--                                </a>-->
                            <!--                            </td>-->
                            <!--                            <td><span>1 304 481</span> сум</td>-->
                            <!--                            <td><span>198 000</span> сум</td>-->
                            <!--                        </tr>-->
                            <!--                        <tr class="residue">-->
                            <!--                            <td>-->
                            <!--                                <a href="#">-->
                            <!--                                    Договор № M1_2016_211 от марта 2016 года-->
                            <!--                                </a>-->
                            <!--                            </td>-->
                            <!--                            <td><span>1 304 481</span> сум</td>-->
                            <!--                            <td><span>390 000</span> сум</td>-->
                            <!--                        </tr>-->


                            </tbody>
                        <?php endif ?>
                        <tfoot>
                        <tr>
                            <td>Итоговоя сумма:</td>
                            <td><span><?= $sumDogovor ?></span> сум</td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


