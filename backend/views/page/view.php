<?php

use yii\helpers\Html;

use yii\widgets\DetailView;

/* @var $this soft\web\SView */
/* @var $model common\models\Page */

$this->title = substr($model->title, 0, 80);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Pages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="post-view">

    <h3><?= Html::encode($model->title) ?></h3>
    <p>
        <?= \soft\helpers\SHtml::updateButton($model->id) ?>
    </p>

    <?= \soft\kartik\SDetailView::widget([
        'model' => $model,
        'panel' => [
            'heading' => $model->title,
        ],
        'attributes' => [
//            'id',
            ['group' => true, 'label' => Yii::t('app', 'Title')],
            'title',
            ['group' => true, 'label' => Yii::t('app', 'Subtitle')],
            'sub_title',
            ['group' => true, 'label' => Yii::t('app', 'Details')],
            [
                'label' => "Url",
                'value' => $model->url,
                'format' => ['url', ['target' => '_blank', 'data-pjax' => 0]],
            ],
            'status',
            'middle' => [
                'format' => 'bool',
            ],
            'created_at',
            'updated_at',

            ['group' => true, 'label' => Yii::t('app', 'Image')],
            'icon_class' => [
                'value' => $model->getPageIcon(),
                'format' => 'raw',
            ],
            'image' => [
                'format' => 'littleImage',
            ],
            ['group' => true, 'label' => Yii::t('app', 'Content')],
            'description' => [
                'format' => 'raw',
            ],
        ],
    ]) ?>


</div>

