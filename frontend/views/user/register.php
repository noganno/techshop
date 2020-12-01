<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model \frontend\models\SignupForm */

$this->title = t('Signup');
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
                        <a class="nav-link <?= Yii::$app->help->tab('jismoniy') ? "active" : "d-none" ?>"
                           id="reg-form-2-jismoniy-tab" data-toggle="tab"
                           href="#reg-form-2-jismoniy" role="tab" aria-controls="home"
                           aria-selected="true">Физическое лицо</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= Yii::$app->help->tab('yuridik') ? "active" : "d-none" ?>"
                           id="reg-form-2-yuridik-tab" data-toggle="tab"
                           href="#reg-form-2-yuridik" role="tab" aria-controls="profile"
                           aria-selected="false">Юридическое лицо</a>
                    </li>
                </ul>
                <div class="tab-content p-3 border border-top-0 mb-5">
                    <div class="tab-pane fade <?= Yii::$app->help->tab('jismoniy') ? "show active" : "d-none" ?>"
                         id="reg-form-2-jismoniy" role="tabpanel"
                         aria-labelledby="reg-form-2-yuridik-tab">
                        <?php if (Yii::$app->session->get('tempUserVerified')): ?>
                            <?= $this->render('@frontend/views/user/_userPartials/_register', [
                                'person' => $person
                            ]) ?>
                        <?php else: ?>
                            <?= $this->render('@frontend/views/user/_userPartials/_phoneVerify', [
                                'phone' => $phone
                            ]) ?>
                        <?php endif; ?>
                    </div>
                    <div class="tab-pane fade <?= Yii::$app->help->tab('yuridik') ? "show active" : "d-none" ?>"
                         id="reg-form-2-yuridik" role="tabpanel"
                         aria-labelledby="reg-form-2-yuridik-tab">
                        <?= $this->render('@frontend/views/user/_userPartials/_legalRegister', [
                            'model' => $legal
                        ]) ?>
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
