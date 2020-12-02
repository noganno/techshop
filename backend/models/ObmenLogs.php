<?php

namespace backend\models;

use common\models\Sklad;
use Yii;

/**
 * This is the model class for table "obmen_logs".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $action
 * @property int|null $is_from_1c
 * @property int|null $wrote_to_site
 * @property int|null $datetime
 * @property float|null $sale_price
 * @property float|null $loan_price
 * @property int|null $guid
 * @property int|null $sklad_id
 * @property int|null $count
 */
class ObmenLogs extends \soft\db\SActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'obmen_logs';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['is_from_1c', 'wrote_to_site', 'datetime', 'sklad_id', 'count'], 'integer'],
            [['sale_price', 'loan_price'], 'number'],
            [['name', 'action', 'guid'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'action' => Yii::t('app', 'Action'),
            'is_from_1c' => Yii::t('app', 'Is From 1c'),
            'wrote_to_site' => Yii::t('app', 'Wrote To Site'),
            'datetime' => Yii::t('app', 'Datetime'),
            'sale_price' => Yii::t('app', 'Sale Price'),
            'loan_price' => Yii::t('app', 'Loan Price'),
            'guid' => Yii::t('app', 'Guid'),
            'sklad_id' => Yii::t('app', 'Sklad ID'),
            'count' => Yii::t('app', 'Count'),
        ];
    }

    public function getSklad()
    {
        return $this->hasOne(Sklad::class, ['id' => 'sklad_id']);
    }
}
