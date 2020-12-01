<div class="products-cards__item sale" data-id="<?= $model->id ?>">
    <div class="content">
        <h1 class="title"><?= Yii::t('app', 'aksiya_nedeli') ?></h1>
        <span class="content-sele">-<?= floor(($model->price - $model->sale_price) * 100 / $model->price) ?>%</span>
        <span class="category"><?= $model->categoryName; ?></span>
        <a href="<?= url_to(['site/product', 'id' => $model->id]) ?>" class="name"><?= $model->name ?></a>
        <h3 class="price"><span><?= number_format($model->sale_price, 0, ',', ' '); ?></span> сум</h3>
        <h3 class="discount"><span><?= number_format($model->price, 0, ',', ' '); ?></span> сум</h3>
        <p class="description">В месяц по 120 000 сум Предоплата 10% </p>
        <div class="btns">
            <span href="#" class="btn btn-yellow add-to-cart"  data-product-id="<?= $model->id ?>">
                 <?= Yii::$app->help->getCardSvg() ?>
                <?= Yii::t('app', 'v_korzinu') ?>
            </span>
            <a href="<?=\yii\helpers\Url::to(['balance/add-to-balance','id'=>$model->id])?>" class="btn btn-balance add-to-balance" data-product-id="<?= $model->id ?>">

                <?= Yii::$app->help->getBalanceSvg() ?>
            </a>
        </div>
    </div>
    <a href="<?= url_to(['site/product', 'id' => $model->id]) ?>" class="img">
        <img src="<?= $model->images[0]; ?>">
        <div class="countDown">
            <!-- <p class="countDown-text-js">
                {month.date.year hour:minut:second}
                <p id="DateTime" hidden>8.08.2020 00:00:00</p>
                <span>Осталные дни:</span>
                <span id="days"></span>
                <br>
                <span>Осталные времены:</span>
                <span id="hours"></span>
                <span id="minutes"></span>
                <span id="seconds"></span>

            </p> -->
            <p class="countDown-text">
                <span>Осталось:</span>
                <span>дней</span>
                <span>2 часов</span>
                <span>18 минут</span>
                <span>45</span>
            </p>
            <div class="countDown-line">
                <span class="countDown-line-color" style="width:30%"></span>
            </div>
        </div>
    </a>
</div>