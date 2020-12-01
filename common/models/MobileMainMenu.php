<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "mobile_main_menu".
 *
 * @property int $id
 * @property int|null $category_id
 * @property string|null $image
 * @property int|null $order
 */
class MobileMainMenu extends \yii\db\ActiveRecord
{
    public function fields()
    {
        return [

            'id',
            'category_id',
            'category_name' => 'categoryName',
            'image',
        ];
    }


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mobile_main_menu';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id', 'order'], 'integer'],
            [['image'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'category_id' => Yii::t('app', 'Category ID'),
            'image' => Yii::t('app', 'Image'),
            'order' => Yii::t('app', 'Order'),
        ];
    }

    public function getCategoryName(){
        $category = Category::findOne(['id'=>$this->category_id]);
        if (Yii::$app->language == 'ru'){
            return $category->name;
        }else{
            return $category['name_'.Yii::$app->language];
        }
    }
}
