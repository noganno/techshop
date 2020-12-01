<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\db\ActiveRecord;
use yii\captcha\Captcha;
use yii\widgets\Pjax;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title; ?>
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
                    <?php Pjax::begin(); ?>
                    <?php $form = ActiveForm::begin(['options' => ['id' => 'form-signup', 'class' => 'reg-form-2 was-validated']]); ?>
                    <div class="form-row">
                        <?= $form->field($model, 'last_name', ['options' => ['class' => 'form-group col-12 col-md-4']])->textInput([
                            'autofocus' => true,
                            'class' => 'form-control',
                            'required' => 'required',
                            'placeholder' => 'Имя*'
                        ])->label('') ?>
                        <?= $form->field($model, 'first_name', ['options' => ['class' => 'form-group col-12 col-md-4']])->textInput([
                            'class' => 'form-control',
                            'required' => 'required',
                            'placeholder' => 'Фамилия**'
                        ])->label('') ?>
                        <?= $form->field($model, 'middle_name', ['options' => ['class' => 'form-group col-12 col-md-4']])->textInput([
                            'class' => 'form-control',
                            'required' => 'required',
                            'placeholder' => 'Очество*'
                        ])->label('') ?>
                    </div>
                    <div class="form-row">
                        <?= $form->field($model, 'username', ['options' => ['class' => 'form-group col-12 col-md-4']])->textInput([
                            'class' => 'registration-phone form-control',
                            'required' => 'required',
                            'placeholder' => 'Телефон*',
                            'type' => 'tel'
                        ])->label('') ?>
                        <?= $form->field($model, 'email', [
                            'options' => [
                                'class' => 'form-group col-12 col-md-4',
                            ]])->textInput([
                            'class' => 'form-control',
                            'placeholder' => 'E-mail*',
                            'type' => 'email'
                        ])->label('') ?>
                      
                    </div>

                    <div class="form-row border-top mt-4 pt-4">
                        <?= $form->field($model, 'password', ['options' => ['class' => 'form-group col-12 col-md-4 show-password']])->passwordInput([
                            'placeholder' => 'Пароль*',
                        ])->label('') ?>



                        <?= $form->field($model, 'password_repeat', ['options' => ['class' => 'form-group col-12 col-md-4']])->passwordInput([
                            'class' => 'form-control',
                            'placeholder' => 'Повторите пароль*',
                        ])->label('') ?>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-12 col-md-4">
                            <div class="g-recaptcha"
                                 data-sitekey="6Ldcx8AZAAAAADDRJeXBeR1HSKiHBTB1niNP-rV5"></div>
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
                    <?php ActiveForm::end(); ?>
                    <?php Pjax::end(); ?>
                    <!-- End of .reg-form -->
                </div>
                <div class="tab-pane fade" id="reg-form-2-yuridik" role="tabpanel"
                     aria-labelledby="reg-form-2-yuridik-tab">
                    <?php $form = ActiveForm::begin(['id' => 'form-signup', 'class' => 'reg-form-2 was-validated']); ?>
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
                    <p class="btn-text mt-3" data-toggle="modal" data-target="#yuridik-modal">Форма поддержки
                        пользователей</p>

                    <!-- Modal -->
                    <?php ActiveForm::end(); ?>
                    <div class="modal fade" id="yuridik-modal" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Форма поддержки
                                        пользователей</h5>
                                    <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
                                    <div class="form-row">
                                        <div class="form-group col-12 col-sm-6 col-md-4">
                                            <?= $form->field($model, 'full_name')->textInput([
                                                'autofocus' => true,
                                                'class' => 'form-control',
                                                'required' => 'required',
                                                'placeholder' => 'Имя*'
                                            ])->label('') ?>
                                        </div>
                                        <div class="form-group col-12 col-sm-6 col-md-4">
                                            <?= $form->field($model, 'username')->textInput([
                                                'class' => 'registration-phone form-control',
                                                'required' => 'required',
                                                'placeholder' => 'Телефон*',
                                                'type' => 'tel'
                                            ])->label('') ?>
                                        </div>
                                        <div class="form-group col-12 col-sm-6 col-md-4">
                                            <?= $form->field($model, 'email')->textInput([
                                                'class' => 'form-control',
                                                'placeholder' => 'E-mail*',
                                                'type' => 'email'
                                            ])->label('') ?>
                                        </div>
                                        <div class="form-group col-12 col-sm-6 col-md-12">
                                            <input type="text" class="form-control" required
                                                   placeholder="Коммент*">
                                        </div>
                                        <div class="form-group col-12 col-sm-6 col-md-4">
                                            <input type="file" id="yuridik-input-file"
                                                   class="form-control is-valid" required
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
                                </div>
                                <div class="modal-footer">
                                    <?= Html::submitButton('Создат аккаунт', ['class' => 'btn btn-yellow-3 mt-4', 'name' => 'signup-button']) ?>
                                    <?php ActiveForm::end(); ?>
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