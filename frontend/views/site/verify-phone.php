<?php

use yii\bootstrap\Html;

?>
<?php
$this->registerCssFile('@web/css/countdown.css');
$this->registerJsFile('@web/js/countdown.js', ['depends' => 'frontend\assets\AppAsset']);
?>
<!-- Start of .main-block -->
<div class="mainx-block">
    <!-- Start of .reg-login -->
    <div class="reg-login">
        <div class="auto-container">
            <div class="reg-login__inner">
                <h1 class="title">Введите код</h1>

                <!-- Start of .reg-form -->
                <form action="" method="POST" class="reg-form was-validated mt-5">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <input type="hidden" name="_csrf-frontend" value="<?= Yii::$app->request->csrfToken ?>">
                            <input type="text" name="code" class="form-control is-valid" required placeholder="Code*"
                                   autofocus><br>

                            <?php
                            echo Html::a(Yii::t('app','resendCode'), ['resend-verify-phone'], ['class' => 'link-2 hide ', 'id' => 'time-link-a']);

                            if ($expired) {
//                               echo Html::a(Yii::t('app','resendCode'), ['resend-verify-phone'], ['class' => 'link-2 ', 'id' => 'time-link-a']);
                            }
//                            echo $seconds;
                            ?>

                        </div>
                        <div class="form-group col-md-6">
                                        <span id="minutes">
                                        <!-- section for countdown -->
                                        <input type="hidden" id="ammount" name="" value="<?= $seconds < 0 ? 0 : $seconds ?>">
                                            <section class="clock">
                                            <div class="row">
                                                <div id="timer" class="col-12">
                                                <div class="clock-wrapper">
                                                    <div id="hours-area">
                                                    <span class="hours">00</span>
                                                    <span class="dots">:</span>
                                                    </div>
                                                    <span id="minut" class="minutes">00</span>
                                                    <span class="dots">:</span>
                                                    <span id="second" class="seconds">00</span>
                                                </div>
                                                </div>
                                            </div>
                                            </section>
                                            <!-- end countdown section -->
                                        </span>

                        </div>

                        <div class="form-group col-md-12">
                            <?= Html::submitButton('подтверждение', ['class' => 'btn btn-yellow-3 mt-5']) ?>

                        </div>
                    </div>
                </form>
                <!-- End of .reg-form -->

            </div>
        </div>
    </div>
    <!-- End of .reg-login -->
</div>
<!-- Start of .main-block -->
