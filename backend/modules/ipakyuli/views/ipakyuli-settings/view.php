<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\ipakyuli\models\IpakyuliSettings */

$this->title = t('Settings');
\yii\web\YiiAsset::register($this);
?>
<div class="ipakyuli-settings-view">

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>

    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'test_key',
            'main_key',
            'terminal_num',
            'room_enter_name',
            'status',
            'created_at:datetime',
            'updated_at:datetime',
            'success_url:url',
            'error_url:url',
            'redirect_url:url',
        ],
    ]) ?>

</div>
