<?php

namespace backend\modules\ipakyuli\models;

use Yii;

/**
 * This is the model class for table "ipakyuli_settings".
 *
 * @property int $id
 * @property string|null $test_key
 * @property string|null $main_key
 * @property int|null $terminal_num
 * @property string|null $room_enter_name
 * @property string|null $status
 * @property int|null $created_at
 * @property int $updated_at
 * @property string|null $success_url
 * @property string|null $error_url
 * @property string|null $redirect_url
 */
class IpakyuliSettings extends \soft\db\SActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ipakyuli_settings';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['terminal_num', 'created_at', 'updated_at'], 'integer'],
            [['status', 'redirect_url', 'billing_url'], 'string'],
            [['billing_url'],'required'],
            [['test_key', 'main_key', 'success_url', 'error_url'], 'string', 'max' => 255],
            [['room_enter_name'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'test_key' => Yii::t('app', 'Test Key'),
            'main_key' => Yii::t('app', 'Main Key'),
            'terminal_num' => Yii::t('app', 'Terminal Num'),
            'room_enter_name' => Yii::t('app', 'Room Enter Name'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'success_url' => Yii::t('app', 'Success Url'),
            'error_url' => Yii::t('app', 'Error Url'),
            'redirect_url' => Yii::t('app', 'Redirect Url'),
        ];
    }
}
