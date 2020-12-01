<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%mytable}}".
 *
 * @property string $id
 * @property string $name
 * @property string $id_sklad
 * @property string $sklad
 * @property string|null $vid_sen_prodaja
 * @property string|null $vid_sen_rassrochka
 * @property int|null $price
 * @property int|null $loan_price
 * @property int $qty
 */
class Mytable extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%mytable}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'name', 'id_sklad', 'sklad', 'qty'], 'required'],
            [['price', 'loan_price', 'qty'], 'integer'],
            [['id', 'id_sklad'], 'string', 'max' => 36],
            [['name'], 'string', 'max' => 98],
            [['sklad'], 'string', 'max' => 29],
            [['vid_sen_prodaja'], 'string', 'max' => 13],
            [['vid_sen_rassrochka'], 'string', 'max' => 11],
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
            'id_sklad' => Yii::t('app', 'Id Sklad'),
            'sklad' => Yii::t('app', 'Sklad'),
            'vid_sen_prodaja' => Yii::t('app', 'Vid Sen Prodaja'),
            'vid_sen_rassrochka' => Yii::t('app', 'Vid Sen Rassrochka'),
            'price' => Yii::t('app', 'Price'),
            'loan_price' => Yii::t('app', 'Loan Price'),
            'qty' => Yii::t('app', 'Qty'),
        ];
    }
}
