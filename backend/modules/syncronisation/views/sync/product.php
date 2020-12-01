<?php

use yii\web\View;

$this->title = t('Sync product counts');
$this->params['breadcrumbs'][] = $this->title;

$this->registerJsFile('/js/vue/axios.min.js', [
//    'position' => View::POS_HEAD
]);
$this->registerJsFile('https://cdn.jsdelivr.net/npm/sweetalert2@10', [
//    'position' => View::POS_HEAD
]);


$this->registerJsFile('/js/vue/vue.js', [
//    'position' => View::POS_HEAD
]);

$this->registerJsFile('/js/mainVue.js', [
//    'position'=>View::POS_HEAD
//    'depends'=>
]);


?>
<style>
    .loading {
        position: fixed;
        top: 0;
        left: 0;
        z-index: 100000000;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
    }

    .loader {
        z-index: 1001;
        position: relative;
        top: 50vh;
        left: 50vw;

        border: 16px solid #f3f3f3;
        border-radius: 50%;
        border-top: 16px solid #3498db;
        width: 60px;
        height: 60px;
        -webkit-animation: spin 2s linear infinite; /* Safari */
        animation: spin 2s linear infinite;
    }

    /* Safari */
    @-webkit-keyframes spin {
        0% {
            -webkit-transform: rotate(0deg);
        }
        100% {
            -webkit-transform: rotate(360deg);
        }
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }
        100% {
            transform: rotate(360deg);
        }
    }
</style>

<div class="box box-primary">
    <div class="box-body">
        <h1><?= $this->title ?></h1>
        <h3><?=t('sync_narx_soni')?></h3>
        <div id="app">
            <section v-if="errored">
                Чфесвы
            </section>

            <section class="container" v-else>
                <div class="loading" v-if="loading">
                    <div class="loader"></div>
                </div>

                <div v-else>

                    <!--            <button class="btn btn-info" type="button">-->
                    <!--                Sklad soni 1C da <span class="badge">{{info.count_1c}}</span>-->
                    <!--            </button>-->
                    <!--            <button class="btn btn-warning" type="button">-->
                    <!--                Sklad soni saytda <span class="badge">{{info.count_local}}</span>-->
                    <!--            </button>-->
                    <!--            <br><br>-->
                    <!--            <button class="btn btn-primary" v-on:click="updateSklads">Yangilash</button>-->

                </div>

            </section>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th><?= t('Sklad') ?></th>
                    <th><?= t('Number of products on the site') ?></th>
                    <th><?= t('Number of products in 1C') ?></th>
                    <th><?= t('Actions') ?></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($oldSklads as $key => $sklad): ?>
                    <?php
                    $c1 = $sklad->get1cProductsCount();
                    $p = $sklad->getProductsCount();
                    ?>

                    <tr class="<?= ($c1 != $p) ? "bg-danger" : "" ?>">
                        <th scope="row"><?= $key + 1 ?></th>
                        <td><?= $sklad->description ?></td>
                        <td><?= $p ?></td>
                        <td><?= $c1 ?></td>
                        <td>
                            <button class="btn btn-info" @click="viewSkladProducts('<?= $sklad->unique_id ?>')">
                                <i
                                        class="fa fa-eye"></i></button>
                            <button class="btn btn-danger"
                                    @click="updateSkladProducts('<?= $sklad->unique_id ?>')"><i
                                        class="fa fa-refresh"></i></button>
                        </td>
                    </tr>

                <?php endforeach; ?>
                </tbody>
            </table>


        </div>
    </div>
</div>
