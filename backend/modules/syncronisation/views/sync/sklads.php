<?php


$this->registerJsFile('/js/vue/axios.min.js', [
//    'position' => View::POS_HEAD
]);


$this->registerJsFile('/js/vue/vue.js', [
//    'position' => View::POS_HEAD
]);

$this->registerJsFile('/js/mainVue.js', [
//    'position'=>View::POS_HEAD
//    'depends'=>
]);

$this->title =  t('Updating Sklads');
$this->params['breadcrumbs'][] = $this->title;
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

<div id="app">
    <h1><?= $this->title ?></h1>

    <section v-if="errored">
        Чфесвы
    </section>

    <section class="container" v-else>
        <div class="loading" v-if="loading">
            <div class="loader"></div>
        </div>

        <div v-else>
            <button class="btn btn-info" type="button">
                <?= t('Sklad soni 1C da') ?> <span class="badge">{{info.count_1c}}</span>
            </button>
            <button class="btn btn-warning" type="button">
                <?= t('Sklad soni saytda') ?> <span class="badge">{{info.count_local}}</span>
            </button>
         
            <br><br>
            <button class="btn btn-primary" v-on:click="updateSklads"><?= t('Yangilash') ?></button>

        </div>

    </section>
</div>

