<?php

use yii\helpers\Html;

/**
 * @var $this \frontend\components\FrontendView
 * @var $category \frontend\models\Category
 * @var $attributeValues array $_POST['AttributeValue']
 */

$allCategories = $brand->activeCategories;

?>

<div class="sidebar">
    <form class="inner-sidebar" action="<?= url_to(['product/brand', 'id' => $brand->id]) ?>" method="post">
        <?= $this->getCsrfInput() ?>
        <div class="sidebar-accardion">
            <!--
            <div class="sidebar-accardion__item">
                <h3 class="title"><i class="fa fa-angle-down"></i>
                    <?/*= t('Наши
                    предложения.') */?>
                </h3>
                <div class="content">
                    <ul class="">
                        <li>
                            <label>
                                <?/*= Html::checkbox('new', $this->post('new', false), [
                                        'value' => true,
                                ] ) */?>
                                <?/*= t('New') */?>
                            </label>
                        </li>
                        <li>
                            <label>
                                <?/*= Html::checkbox('recommend', $this->post('recommend', false), [
                                    'value' => true,
                                ] ) */?>
                                <?/*= t('We recommend') */?>
                            </label>
                        </li>
                        <li>
                            <label>
                                <?/*= Html::checkbox('hit', $this->post('hit', false), [
                                    'value' => true,
                                ] ) */?>
                                <?/*= t('Hit sale') */?>
                            </label>
                        </li>
                    </ul>
                </div>
            </div>
-->
            <?php if (count($allCategories) > 1): ?>
                <div class="sidebar-accardion__item">
                    <h3 class="title"><i class="fa fa-angle-down"></i>
                        <?= t('Categories') ?>
                    </h3>
                    <div class="content">
                        <ul class="">
                            <?php foreach ($allCategories as $category): ?>
                              
                                <li>
                                    <label class="checkbox-2" style="width: 100%">
                                          <span class="checkbox-2__input">
                                               <?= \yii\helpers\Html::checkbox("Categories[]", in_array($category->id, $categories) , [
                                                       'value' => $category->id
                                                   ]
                                               ) ?>
                                                    <span class="checkbox-2__control">
                                                        <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'
                                                             aria-hidden="true" focusable="false">
                                                            <path fill='none' stroke='currentColor' stroke-width='6'
                                                                  d='M1.73 12.91l6.37 6.37L22.79 4.59'/></svg>
                                                    </span>
                                                </span>
                                        <span class="checkbox-2__label">
                                              <?= e($category->title) ?>
                                        </span>
                                    </label>
                                </li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                </div>
            <?php endif ?>

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
                            <input type="text" id="handle-slider-val-2"  readonly>

                            <input type="hidden" id="input-min-price" name="min-price" value="<?= $minPrice ?>" >
                            <input type="hidden" id="input-max-price" name="max-price" value="<?= $maxPrice ?>" >

                        </p>
                    </div>
                </div>
            </div>

        </div>
        <div class="filtering">
            <button class="btn btn-yellow-3" type="submit"><?= t('Filter') ?></button>
            <button class="btn btn-reset" type="reset">
                <i class="fa fa-remove"></i> <?= t('Remove filter') ?>
            </button>
        </div>
    </form>
</div>