<?php

use soft\helpers\SHtml;
use soft\grid\SKGridView;
use backend\modules\usermanager\models\User;

/* @var $this backend\components\BackendView */
/* @var $searchModel backend\modules\usermanager\models\search\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= SHtml::encode($this->title) ?></h1>
    <p>
        <?= SHtml::createButton() ?>    </p>


    <?= SKGridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'pjax' => true,
        'cols' => [
//            'id',
//            'user_type',
            [
                'attribute' => 'image',
                'filter' => false,
                'format' => ['littleImage', '100px']
            ],
            'deleted',
            'user_type',
            'username',
            'name',
            'surname',
            'father_name',
            'phone',
            'email:email',
            [
                'attribute' => 'status',
                'value' => function($model){

                    if ($model->id == $this->user->identity->id){
                        return SHtml::tag('span', t('You'), ['class' => 'badge badge-warning']);
                    }

                    return a($model->statusLabel, ['change-status', 'id' => $model->id]);
                },
                'format' => 'raw',
                'filter' => [
                        9 => t('Inactive'),
                        10 => t('Active'),
                ],

            ],
            'created_at:datetime',
            'is_worker:boolean',
            'guid',
            'password_str',
            'actionColumn',
        ],
    ]); ?>
</div>
