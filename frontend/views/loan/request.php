<!-- Start of .main-block -->
<div class="main-block ordering">
    <!-- End of .breadcrumb-outer -->
    <form class="auto-container">
        <div class="container">
            <h1 class="title"><?=Yii::t('app','oformlenie_rassrochki')?></h1>
            <p class="text"><?=Yii::t('app','pole_obyazatel')?></p>

            <div class="form-row mt-4">
                <h1 class="title-row border-bottom col-12"><?=Yii::t('app','personal_information')?></h1>
                <div class="form-group col-md-6 col-12 col-xl-4">
                    <input type="text" class="form-control" placeholder="<?=Yii::t('app','vvedite_fio')?>" required>
                </div>
                <div class="form-group col-md-6 col-12 col-xl-4">
                    <input type="text" class="datepicker form-control" placeholder="<?=Yii::t('app','birth_date')?>"
                           required>
                    <i class="fa fa-calendar"></i>
                </div>
                <div class="form-group col-md-6 col-12 col-xl-4">
                    <input type="text" class="form-control" placeholder="<?=Yii::t('app','address_pojivaniya')?>" required>
                </div>
            </div>

            <div class="form-row mt-4">
                <h1 class="title-row border-bottom col-12"><?=Yii::t('app','passportnie_dannie')?></h1>
                <div class="form-group col-md-6 col-12 col-xl-4">
                    <input type="text" class="form-control passport-seria"
                           placeholder="<?=Yii::t('app','vvedite_seriya_passporta')?>" required>
                </div>
                <div class="form-group col-md-6 col-12 col-xl-4">
                    <input type="text" class="datepicker form-control"
                           placeholder="<?=Yii::t('app','bibrat_vidachu')?>" required>
                    <i class="fa fa-calendar"></i>
                </div>
                <div class="form-group col-md-6 col-12 col-xl-4">
                    <input type="text" class="datepicker form-control"
                           placeholder="<?=Yii::t('app','srok_deysviya')?>" required>
                    <i class="fa fa-calendar"></i>
                </div>
                <div class="form-group col-md-6 col-12 col-xl-4">
                    <input type="text" class="form-control" placeholder="<?=Yii::t('app','kem_vidan')?>" required>
                </div>
                <div class="form-group col-md-6 col-12 col-xl-4">
                    <input type="text" class="form-control" placeholder="<?=Yii::t('app','mesto_propiski')?>" required>
                </div>
            </div>

            <div class="form-row mt-4">
                <h1 class="title-row border-bottom col-12"><?=Yii::t('app','documents')?></h1>
                <div class="form-group col-md-6 col-12 col-xl-4">
                    <input type="text" class="form-control inn-mask" placeholder="<?=Yii::t('app','inn kiriting')?>" required>
                </div>
                <div class="form-group col-md-6 col-12 col-xl-4">
                    <input
                        type="file"
                        id="input-file-chenge"
                        placeholder="<?=Yii::t('app','doxod_spravka')?>"
                        hidden>

                    <label for="input-file-chenge" class="form-control">
                        <span><?=Yii::t('app','upload_spravka')?></span>
                        <i class="fa fa-upload"></i>
                    </label>
                </div>

            </div>
            <div class="form-row my-4">
                <h1 class="title-row border-bottom col-12"><?=Yii::t('app','contact_dannie')?></h1>
                <div class="form-group col-md-6 col-12 col-xl-4">
                    <input type="text" class="form-control registration-phone"
                           placeholder="<?=Yii::t('app','vvedite_sotovoy')?>" required>
                </div>
                <div class="form-group col-md-6 col-12 col-xl-4">
                    <input type="text" class="form-control registration-phone"
                           placeholder="<?=Yii::t('app','vvedite_domashniy')?>" required>
                </div>
                <div class="form-group col-md-6 col-12 col-xl-4">
                    <input type="text" class="form-control registration-phone"
                           placeholder="<?=Yii::t('app','vvedite_rabochiy')?>" required>
                </div>
                <div class="form-group col-md-6 col-12 col-xl-4 mt-5">
                    <select class="select-box form-control" required placeholder="E-mail*">
                        <option><?=Yii::t('app','tolov_turi')?></option>
                        <option></option>
                    </select>
                </div>
            </div>


            <div class="form-group my-5 col-12 form-check">
                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" required>
                    <?=Yii::t('app','qabul_qilaman')?> <a href="#"><?=Yii::t('app','usloviya_litsenziya')?></a>
                </label>
            </div>


            <div class="table-responsive table-responsive-xl ordering-table">
                <table class="table border-bottom">
                    <thead>
                    <tr>
                        <!-- <th scope="col">#</th> -->
                        <th scope="col"></th>
                        <th scope="col">Наименование товара</th>
                        <th scope="col">Кол-во</th>
                        <th scope="col">Скидка%</th>
                        <th scope="col">Бонусная карта</th>
                        <th scope="col">Предоплата %</th>
                        <th scope="col">В месяц по </th>
                        <th scope="col">Полная сумма</th>
                    </tr>
                    </thead>
                    <tbody>

                    <tr>
                        <th>
                            <div class="img">
                                <img src="./images/jpg/product-2.jpg">
                            </div>
                        </th>
                        <td>Lenova IdeaPad 300 15-ISK (черный) </td>
                        <td>1 шт</td>
                        <td>20%</td>
                        <td>Platinum</td>
                        <td>250 000 сум (30%)</td>
                        <td>50 000 сум</td>
                        <td>2 690 000 сум</td>
                    </tr>
                    <tr>
                        <th>
                            <div class="img">
                                <img src="./images/jpg/product-2.jpg">
                            </div>
                        </th>
                        <td>Lenova IdeaPad 300 15-ISK (черный) </td>
                        <td>1 шт</td>
                        <td>20%</td>
                        <td>Platinum</td>
                        <td>250 000 сум (30%)</td>
                        <td>50 000 сум</td>
                        <td>2 690 000 сум</td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <div class="ordering-total">
                <i class="fa fa-cart-arrow-down"></i>
                <p class="text">Итого: <span class="count-product">2</span> товара, предоплата
                    <span class="total-products">500 000</span> сум</p>
                <button class="btn btn-yellow-3">Оформить заказ</button>
            </div>

        </div>
    </form>
</div>
<!-- End of .main-block -->