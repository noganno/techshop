<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "loans".
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $fio
 * @property string|null $birth_date
 * @property string|null $address
 * @property string|null $passport_number
 * @property string|null $passport_give_date
 * @property string|null $passport_expiry
 * @property string|null $paasport_authority
 * @property string|null $passport_propiska
 * @property string|null $inn
 * @property string|null $annual_income
 * @property string|null $mobile_phone
 * @property string|null $home_phone
 * @property string|null $work_phone
 * @property float|null $total_amount
 */
class Loans extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'loans';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id'], 'integer'],
            [['birth_date'], 'safe'],
            [['total_amount'], 'number'],
            [['fio', 'address', 'passport_number', 'passport_give_date', 'passport_expiry', 'paasport_authority', 'passport_propiska', 'inn', 'annual_income', 'mobile_phone', 'home_phone', 'work_phone'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'fio' => Yii::t('app', 'Fio'),
            'birth_date' => Yii::t('app', 'Birth Date'),
            'address' => Yii::t('app', 'Address'),
            'passport_number' => Yii::t('app', 'Passport Number'),
            'passport_give_date' => Yii::t('app', 'Passport Give Date'),
            'passport_expiry' => Yii::t('app', 'Passport Expiry'),
            'paasport_authority' => Yii::t('app', 'Paasport Authority'),
            'passport_propiska' => Yii::t('app', 'Passport Propiska'),
            'inn' => Yii::t('app', 'Inn'),
            'annual_income' => Yii::t('app', 'Annual Income'),
            'mobile_phone' => Yii::t('app', 'Mobile Phone'),
            'home_phone' => Yii::t('app', 'Home Phone'),
            'work_phone' => Yii::t('app', 'Work Phone'),
            'total_amount' => Yii::t('app', 'Total Amount'),
        ];
    }
}
