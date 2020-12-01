<?php

namespace backend\modules\sms\models;

use Yii;

/**
 * This is the model class for table "sms".
 *
 * @property int $id
 * @property string|null $login
 * @property string|null $password
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property string|null $nickname
 * @property string|null $gateway
 */
class Sms extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sms';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at'], 'integer'],
            [['login', 'password', 'nickname', 'gateway'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'login' => Yii::t('app', 'Login'),
            'password' => Yii::t('app', 'Password'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'nickname' => Yii::t('app', 'Nickname'),
            'gateway' => Yii::t('app', 'Gateway'),
        ];
    }
}
