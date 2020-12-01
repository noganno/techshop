<?php

namespace common\models\behavior;

use common\models\Product;
use common\models\ProductToCategory;
use common\models\ProductToSklad;
use yii\base\Model;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

class ProductToSkladBehavior extends \yii\base\Behavior
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

        $assigns = $this->owner->sklad_values;

        if (is_array($assigns) && !empty($assigns)) {

            foreach ($assigns as $assign) {
                $ps = new ProductToSklad([
                    'product_id' => $this->owner->id,
                    'sklad_id' => $assign['sklad_id'],
                    'quantity' => $assign['quantity'],

                ]);
                $ps->save();
            }

        }

    }

    public function afterUpdate()
    {

        /** @var array  existing Sklad ids related with current Product */
        $oldIds = ArrayHelper::getColumn($this->owner->productToSklads, 'sklad_id');

        /** @var array $newAssigns taken from POST */
        $newAssigns = $this->owner->sklad_values;

        $newIds = ArrayHelper::getColumn($newAssigns, 'sklad_id', []);

        /** @var array $diffIds  different sklad ids */
        $diffIds = array_diff($oldIds, $newIds);

        /** Delete different ids */
        foreach ($diffIds as $id){
            $ps = ProductToSklad::findOne([
                'product_id' => $this->owner->id,
                'sklad_id' => $id,
            ]);
            if ($ps != null){
                $ps->delete();
            }
        }

        if (is_array($newAssigns) && !empty($newAssigns)) {
            foreach ($newAssigns as $assign) {
                $ps = ProductToSklad::findOne([
                    'product_id' => $this->owner->id,
                    'sklad_id' => $assign['sklad_id'],
                ]);
                if ($ps == null) {
                    $ps = new ProductToSklad([
                        'product_id' => $this->owner->id,
                        'sklad_id' => $assign['sklad_id'],
                    ]);
                }
                $ps->quantity = $assign['quantity'];
                $ps->save();
            }
        }
    }
}