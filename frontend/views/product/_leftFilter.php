<?php

/**
 * @var $this \frontend\components\FrontendView
 * @var $category \frontend\models\Category
 * @var $attributeValues array $_POST['AttributeValue']
 */

$attributesNames = $category->getAttributesNames()
    ->andWhere(['filter' => 1, 'status' => 1])
//    ->limit(6)
    ->all();

$allBrands = $category->manufacturers;
$allCountries = $category->getCountries()->all();
$allWarranties = $category->warranties;

?>

<div class="sidebar">
    <form class="inner-sidebar" id="product-filter-form"
          action="<?= \yii\helpers\Url::current() ?>" method="post">
        <?= $this->getCsrfInput() ?>
        <div class="sidebar-accardion">
            <?php if (count($allCountries) > 1): ?>
                <div class="sidebar-accardion__item">
                    <h3 class="title"><i class="fa fa-angle-down"></i>
                        <?= t('Countries') ?>
                    </h3>
                    <div class="content">
                        <ul class="">
                            <?php foreach ($allCountries as $country): ?>

                                <li>
                                    <label class="checkbox-2">
                                          <span class="checkbox-2__input">
                                                  <?= \yii\helpers\Html::checkbox("Countries[]", in_array($country->id, $countries), [
                                                          'value' => $country->id
                                                      ]
                                                  ) ?>
                                                    <span class="checkbox-2__control">
                                                        <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'
                                                             aria-hidden="true" focusable="false">
                                                            <path fill='none' stroke='currentColor' stroke-width='6'
                                                                  d='M1.73 12.91l6.37 6.37L22.79 4.59'/></svg>
                                                    </span>
                                                </span>
                                        <span class="checkbox-2__label"> <?= ($country->name) ?></span>
                                    </label>
                                </li>

                            <?php endforeach ?>
                        </ul>
                    </div>
                </div>
            <?php endif ?>
            <?php if (count($allWarranties) > 1): ?>
                <div class="sidebar-accardion__item">
                    <h3 class="title"><i class="fa fa-angle-down"></i>
                        <?= t('Warranty') ?>
                    </h3>
                    <div class="content">
                        <ul class="">
                            <?php foreach ($allWarranties as $warranty): ?>

                                <li>
                                    <label class="checkbox-2">
                                          <span class="checkbox-2__input">
                                                    <?= \yii\helpers\Html::checkbox("Warranties[]", in_array($warranty->id, $warranties), [
                                                            'value' => $warranty->id
                                                        ]
                                                    ) ?>
                                                    <span class="checkbox-2__control">
                                                        <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'
                                                             aria-hidden="true" focusable="false">
                                                            <path fill='none' stroke='currentColor' stroke-width='6'
                                                                  d='M1.73 12.91l6.37 6.37L22.79 4.59'/></svg>
                                                    </span>
                                                </span>
                                        <span class="checkbox-2__label">   <?= ($warranty->name) ?>  </span>
                                    </label>
                                </li>

                            <?php endforeach ?>
                        </ul>
                    </div>
                </div>
            <?php endif ?>
            <?php if (false): ?>
                <div class="sidebar-accardion__item">
                    <h3 class="title"><i class="fa fa-angle-down"></i>
                        <?= t('Manufacturers') ?>
                    </h3>
                    <div class="content">
                        <ul class="">
                            <?php foreach ($allBrands as $brand): ?>


                                <li>
                                    <label class="checkbox-2">
                                          <span class="checkbox-2__input">
                                                   <?= \yii\helpers\Html::checkbox("Brands[]", in_array($brand->id, $brands), [
                                                           'value' => $brand->id
                                                       ]
                                                   ) ?>
                                                    <span class="checkbox-2__control">
                                                        <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'
                                                             aria-hidden="true" focusable="false">
                                                            <path fill='none' stroke='currentColor' stroke-width='6'
                                                                  d='M1.73 12.91l6.37 6.37L22.79 4.59'/></svg>
                                                    </span>
                                                </span>
                                        <span class="checkbox-2__label">   <?= ($brand->name) ?></span>
                                    </label>
                                </li>

                            <?php endforeach ?>
                        </ul>
                    </div>
                </div>
            <?php endif ?>


            <?php $first = true; ?>
            <?php foreach ($attributesNames as $attribute): ?>

                <?php
                $values = $category->getAttributeValues()
                    ->andWhere(['attribute_id' => $attribute->id, 'language' => Yii::$app->language])
                    ->indexBy('text')
                    ->distinct()
                    ->all();

                ?>

                <?php if (true): ?>
                    <div class="sidebar-accardion__item">
                        <h3 class="title"><i class="fa fa-angle-down"></i>
                            <?= e($attribute->title) ?>
                        </h3>
                        <div class="content" style="<?= !$first ? 'display: none' : '' ?>">
                            <ul>
                                <?php
                                $vCount = 1;
                                ?>
                                <?php foreach ($values as $value): ?>
                                    <?php
                                    if ($vCount > 8) break;
                                    $vCount++;
                                    ?>

                                    <li>
                                        <label class="checkbox-2">
                                          <span class="checkbox-2__input">
                                                  <?= \yii\helpers\Html::checkbox("AttributeValue[]", in_array($value->text, $attributeValues), [
                                                          'value' => $value->text
                                                      ]
                                                  ) ?>
                                                    <span class="checkbox-2__control">
                                                        <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'
                                                             aria-hidden="true" focusable="false">
                                                            <path fill='none' stroke='currentColor' stroke-width='6'
                                                                  d='M1.73 12.91l6.37 6.37L22.79 4.59'/></svg>
                                                    </span>
                                                </span>
                                            <span class="checkbox-2__label">  <?= ($value->text) ?></span>
                                        </label>
                                    </li>
                                <?php endforeach ?>
                            </ul>
                        </div>
                    </div>
                <?php $first = false; ?>
                <?php endif ?>

            <?php endforeach ?>

            <div class="sidebar-accardion__item">
                <h3 class="title"><i class="fa fa-angle-down"></i> <?= t('Cost') ?> (<?= t('sum') ?>) </h3>
                <div class="content">
                    <div class="handle-slider" id="handle-slider">
                        <div id="slider-range">
                            <span id="inner-value-min" hidden>0</span>
                            <span id="inner-value-max" hidden><?= $filterMaxPrice ?></span>
                        </div>
                        <p class="handle-slider-values">
                            <input type="text" id="handle-slider-val-1" readonly>
                            <input type="text" id="handle-slider-val-2" readonly>

                            <input type="hidden" id="input-min-price" name="min-price" value="<?= $minPrice ?>">
                            <input type="hidden" id="input-max-price" name="max-price" value="<?= $maxPrice ?>">

                        </p>
                    </div>
                </div>
            </div>

        </div>
        <div class="filtering">
            <!--            <span class="resualt-filtering">Подобрано <span>222</span> товаров</span>-->
            <button class="btn btn-yellow-3" type="submit"><?= t('Show') ?></button>
            <a href="<?= \yii\helpers\Url::current() ?>" class="btn btn-reset" type="reset"><i
                        class="fa fa-remove"></i> <?= t('Reset filter') ?></a>
        </div>
    </form>
</div>