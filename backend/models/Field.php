<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%field}}".
 *
 * @property int $id
 * @property string $name
 * @property string $value
 * @property string $izoh
 * @property string $type
 * @property string $status
 */
class Field extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%field}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'url'], 'required'],
            [['url', 'type', 'status'], 'string'],
            ['url', 'unique'],
            [['name', 'value'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' =>  "Name",
            'value' =>  "Value",
            'url' =>  'Identifikator',
            'type' => 'Maydon turi',
            'status' =>  "Status",
        ];
    }
}
