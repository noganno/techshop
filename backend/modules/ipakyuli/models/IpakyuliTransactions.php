<?php

namespace backend\modules\ipakyuli\models;

use Yii;

/**
 * This is the model class for table "ipakyuli_transactions".
 *
 * @property int $id
 * @property int|null $global_id
 * @property int|null $order_id
 * @property int|null $amount
 * @property int|null $terminal_num
 * @property int|null $room
 * @property int|null $user_id
 * @property int|null $success_date
 * @property int|null $error_date
 * @property int|null $error_code
 * @property string|null $status
 * @property string|null $return_html
 * @property string|null $return_success_json
 * @property string|null $return_error_json
 */
class IpakyuliTransactions extends \soft\db\SActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ipakyuli_transactions';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['global_id', 'order_id', 'amount', 'terminal_num',  'user_id', 'success_date', 'error_date', 'error_code'], 'integer'],
            [['return_html', 'return_success_json', 'room','return_error_json'], 'string'],
            [['status'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'global_id' => Yii::t('app', 'Global ID'),
            'order_id' => Yii::t('app', 'Order ID'),
            'amount' => Yii::t('app', 'Total price'),
            'terminal_num' => Yii::t('app', 'Terminal Num'),
            'room' => Yii::t('app', 'Room'),
            'user_id' => Yii::t('app', 'User ID'),
            'success_date' => Yii::t('app', 'Success Date'),
            'error_date' => Yii::t('app', 'Error Date'),
            'error_code' => Yii::t('app', 'Error Code'),
            'status' => Yii::t('app', 'Status'),
            'return_html' => Yii::t('app', 'Return Html'),
            'return_success_json' => Yii::t('app', 'Return Success Json'),
            'return_error_json' => Yii::t('app', 'Return Error Json'),
        ];
    }
}
