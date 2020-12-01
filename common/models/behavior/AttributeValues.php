<?php

namespace common\models\behavior;

use common\models\ProductAttribute;
use common\models\ProductToCategory;
use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

class AttributeValues extends \yii\base\Behavior
{
    public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_INSERT => 'afterInsert',
            ActiveRecord::EVENT_AFTER_UPDATE => 'afterUpdate',
            ActiveRecord::EVENT_AFTER_DELETE => 'afterDelete'
        ];
    }

    /**
     * Create relations between Product and ProductCategory
     */
    public function afterInsert()
    {

        if ($this->owner->attribute_values) {

            foreach ($this->owner->attribute_values as $attribute) {
                $attr_id =  $attribute['attribute_id'];
                array_shift($attribute);
                foreach (Yii::$app->params['languages'] as $key => $value) {
                    $productAttribute = new ProductAttribute();
                    $productAttribute->product_id = $this->owner->id;
                    $productAttribute->attribute_id = $attr_id;
                    $productAttribute->language = $key;
                    $productAttribute->text = $attribute['attribute_value_' . $productAttribute->language];
                    $productAttribute->save();
                }
            }
        }
    }

    public function afterUpdate()
    {
        ProductAttribute::deleteAll(['product_id' => $this->owner->id]);
        if ($this->owner->attribute_values) {

            foreach ($this->owner->attribute_values as $attribute) {
                $attr_id =  $attribute['attribute_id'];
                array_shift($attribute);
                foreach (Yii::$app->params['languages'] as $key => $value) {
                    $productAttribute = new ProductAttribute();
                    $productAttribute->product_id = $this->owner->id;
                    $productAttribute->attribute_id = $attr_id;
                    $productAttribute->language = $key;
                    $productAttribute->text = $attribute['attribute_value_' . $productAttribute->language];
                    $productAttribute->save();

                }
            }
        }
    }

    public function afterDelete()
    {
        ProductAttribute::deleteAll(['product_id'=>$this->owner->id]);
    }

}
