<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\db\ActiveRecord;
use yii\captcha\Captcha;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title; ?>
<!-- Start of .reg-login -->
<div class="reg-login">
            <!-- Start of .reg-form -->
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
<!-- Start of .main-block -->
<div class="main-block">
            <!-- Start of .breadcrumb-outer -->
            <div class="breadcrumb-outer">
                <div class="auto-container">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Главная</a></li>
                            <li class="breadcrumb-item"><a href="#">Авторизация</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Регистрация</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!-- End of .breadcrumb-outer -->

            <!-- Start of .reg-login -->
            <div class="reg-login-2">
                <div class="auto-container">
                    <div class="reg-login__inner container">
                        <h1 class="title">Регистрация</h1>
                        <p class="description">После регистрации на сайте вам будет доступно отслеживание состояния
                            заказов, личный кабинет и другие новые возможности.<br> * — Поля, обязательные для
                            заполнения.</p>
                        <ul class="nav nav-tabs mt-5" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="reg-form-2-jismoniy-tab" data-toggle="tab"
                                    href="#reg-form-2-jismoniy" role="tab" aria-controls="home"
                                    aria-selected="true">Физическое лицо</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="reg-form-2-yuridik-tab" data-toggle="tab"
                                    href="#reg-form-2-yuridik" role="tab" aria-controls="profile"
                                    aria-selected="false">Юридическое лицо</a>
                            </li>
                        </ul>
                        <div class="tab-content p-3 border border-top-0 mb-5">
                            <div class="tab-pane fade show active" id="reg-form-2-jismoniy" role="tabpanel"
                                aria-labelledby="reg-form-2-yuridik-tab">
                                <!-- Start of .reg-form -->
                                <form class="reg-form-2 was-validated">
                                    <div class="form-row">
                                        <div class="form-group col-12 col-md-4">
                                            <input type="text" class="form-control is-valid" required
                                                placeholder="Имя*">
                                        </div>
                                        <div class="form-group col-12 col-md-4">
                                            <input type="text" class="form-control is-valid" required
                                                placeholder="Фамилия*">
                                        </div>
                                        <div class="form-group col-12 col-md-4">
                                            <input type="text" class="form-control is-valid" required
                                                placeholder="Очество*">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-12 col-md-4">
                                            <input type="tel" class="registration-phone form-control is-valid" required
                                                placeholder="Телефон*">
                                        </div>
                                        <div class="form-group col-12 col-md-4">
                                            <input type="email" class="form-control is-valid" required
                                                placeholder="E-mail*">

                                        </div>
                                        <div class="form-group col-12 col-md-4">
                                            <p class="text">Если вы укажете свой e-mail это существенно ускорит
                                                обработку заказа. Пожалуйста
                                                проверяйте свою почту чаще!</p>
                                        </div>
                                    </div>

                                    <div class="form-row mt-5">
                                        <div class="form-group col-12 col-md-4">
                                            <input type="password" class="form-control is-invalid is-valid" required
                                                placeholder="Пароль*">
                                        </div>
                                        <div class="form-group col-12 col-md-4">
                                            <input type="password" class="form-control is-invalid is-valid" required
                                                placeholder="Повторите пароль*">
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-12 col-md-4">
                                            <img src="./images/jpg/robot.jpg" style=" width:100%; max-width: 300px;">
                                        </div>
                                        <div class="form-group col-12 col-md-8">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input"
                                                    id="jismoniy-shart-rozilik" required>
                                                <label class="custom-control-label" for="jismoniy-shart-rozilik">Я
                                                    принимаю <a href="#">условия использования сервиса</a></label>
                                            </div>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="jismoniy-sale">
                                                <label class="custom-control-label" for="jismoniy-sale">Получать
                                                    интересные предложения об акциях и скидках</label>
                                            </div>

                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-yellow-3 mt-4">Создат аккаунт</button>
                                </form>
                                <!-- End of .reg-form -->
                            </div>
                            <div class="tab-pane fade" id="reg-form-2-yuridik" role="tabpanel"
                                aria-labelledby="reg-form-2-yuridik-tab">
                                <form class="reg-form-2 was-validated">
                                    <div class="form-row">
                                        <div class="form-group col-12 col-md-4">
                                            <input type="text" class="form-control is-valid" required
                                                placeholder="ИНН*">
                                        </div>
                                        <div class="form-group col-12 col-md-4">
                                            <input type="text" class="form-control is-valid" required
                                                placeholder="КПП*">
                                        </div>
                                        <div class="form-group col-12 col-md-4">
                                            <input type="text" class="form-control is-valid" required
                                                placeholder="Назваеие организации*">
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-12 col-md-4">
                                            <input type="text" class="form-control is-valid" required
                                                placeholder="ОГРН*">
                                        </div>
                                        <div class="form-group col-12 col-md-4">
                                            <input type="text" class="form-control is-valid" required
                                                placeholder="Юридический адрес*">
                                        </div>
                                        <div class="form-group col-12 col-md-4">
                                            <input type="text" class="form-control is-valid" required
                                                placeholder="БИК*">
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-12 col-md-4">
                                            <input type="text" class="form-control is-valid" required
                                                placeholder="Расчётный счёт*">
                                        </div>
                                        <div class="form-group col-12 col-md-4">
                                            <input type="text" class="form-control is-valid" required
                                                placeholder="ФИО*">
                                        </div>
                                        <div class="form-group col-12 col-md-4">
                                            <input type="text" class="form-control is-valid" required
                                                placeholder="Email*">
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-12 col-md-4">
                                            <input type="tel" class="registration-phone form-control is-valid" required
                                                placeholder="Телефон*">
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-12 col-md-4">
                                            <img src="./images/jpg/robot.jpg" style=" width:100%; max-width: 300px;">
                                        </div>
                                        <div class="form-group col-12 col-md-8">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input"
                                                    id="yuridik-shart-rozilik" required>
                                                <label class="custom-control-label" for="yuridik-shart-rozilik">
                                                    Я принимаю <a href="#">условия использования сервиса</a>
                                                </label>
                                            </div>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="yuridik-sale">
                                                <label class="custom-control-label" for="yuridik-sale">
                                                    Получать интересные предложения об акциях и скидках</label>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-yellow-3">Создат аккаунт</button>
                                    <!-- Button trigger modal -->
                                    <p class="btn-text mt-3" data-toggle="modal" data-target="#yuridik-modal">Форма поддержки пользователей</p>

                                    <!-- Modal -->
                                </form>
                                <div class="modal fade" id="yuridik-modal" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Форма поддержки пользователей</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="">
                                                <div class="form-row">
                                                    <div class="form-group col-12 col-sm-6 col-md-4">
                                                        <input type="text" class="form-control" required
                                                            placeholder="ИНН*">
                                                    </div>
                                                    <div class="form-group col-12 col-sm-6 col-md-4">
                                                        <input type="text" class="form-control" required
                                                            placeholder="КПП*">
                                                    </div>
                                                    <div class="form-group col-12 col-sm-6 col-md-4">
                                                        <input type="text" class="form-control" required
                                                            placeholder="Назваеие организации*">
                                                    </div>
                                                    <div class="form-group col-12 col-sm-6 col-md-12">
                                                        <input type="text" class="form-control" required
                                                            placeholder="ИНН*">
                                                    </div>
                                                    <div class="form-group col-12 col-sm-6 col-md-4">
                                                        <input type="file" id="yuridik-input-file" class="form-control is-valid" required
                                                            placeholder="ИНН*" hidden>
                                                        <label for="yuridik-input-file" class="form-control">
                                                            <span id="yuridik-input-file-span">Прикрепите файл</span>
                                                            <i class="fa fa-upload"></i>
                                                        </label>
                                                    </div>
                                                    <div class="form-group col-12 col-sm-6 col-md-4">
                                                        <input type="text" class="form-control" required
                                                            placeholder="КПП*">
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-yellow-3">Отпровит</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- End of .reg-login -->
        </div>
        <!-- End of .main-block -->
            <?= Html::submitButton('Создат аккаунт', ['class' => 'btn btn-yellow-3 mt-4', 'name' => 'signup-button']) ?>
            <?php ActiveForm::end(); ?>
            <!-- End of .reg-form -->
</div>
<!-- End of .reg-login -->