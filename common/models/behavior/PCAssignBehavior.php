<?php

namespace common\models\behavior;

use common\models\ProductToCategory;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

class PCAssignBehavior extends \yii\base\Behavior
{
    public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_INSERT => 'afterInsert',
            ActiveRecord::EVENT_AFTER_UPDATE => 'afterUpdate',
        ];

    }

    /**
     * Create relations between Product and ProductCategory
     */
    public function afterInsert()
    {

       $ids = explode(',',$this->owner->categoryIds);
        foreach ($ids as $id){
            $assign = new ProductToCategory([
                'product_id' => $this->owner->id,
                'category_id' => $id,
            ]);
            $assign->save();
        }

    }

    public function afterUpdate()
    {
        /** @var array  existing ProductCategory ids related with current Product */
        $oldIds = ArrayHelper::getColumn( $this->owner->categories, 'id');

        /** @var array  new ProductCategory ids taken from post request */
        $newIds = explode(',',$this->owner->categoryIds);

        /** @var integer  Product id */
        $id = $this->owner->id;

        foreach ($oldIds as $oldId){
//            delete old relation if old id is not isset in new ids
            if (!in_array($oldId, $newIds)){
                $assign = ProductToCategory::findOne(['category_id' => $oldId, 'product_id' => $id]);
                if ($assign != null){
                    $assign->delete();
                }
            }
        }

        foreach ($newIds as $newId){
    // create new relation if new id is not isset in old ids
            if (!in_array($newId, $oldIds)){
                $assign = new ProductToCategory([
                    'product_id' => $id,
                    'category_id' => $newId,
                ]);
                $assign->save();
            }
        }
    }

}