<?php

    namespace common\models\behavior;

    use common\models\AttributeToCategory;
    use soft\components\Helper;
    use yii\db\ActiveRecord;
    use yii\helpers\ArrayHelper;

    class AttributeCategoriesBehavior extends \yii\base\Behavior
    {
        public function events()
        {
            return [ActiveRecord::EVENT_AFTER_INSERT => 'afterInsert', ActiveRecord::EVENT_AFTER_UPDATE => 'afterUpdate',];

        }

        /**
         * Create relations between Attribute and AttributeToCategory
         */
        public function afterInsert()
        {
            $ids = explode(',', $this->owner->categoryIds);
            foreach ($ids as $id) {
                $assign = new AttributeToCategory(['attribute_id' => $this->owner->id, 'category_id' => $id,]);
                $assign->save();
            }
        }

        public function afterUpdate()
        {
            /** @var array  existing AttributeToCategory ids related with current Attribute */
            $oldIds = ArrayHelper::getColumn($this->owner->categories, 'id');

            /** @var array  new AttributeToCategory ids taken from post request */
            $newIds = explode(',', $this->owner->categoryIds);

            /** @var integer  Attribute id */
            $id = $this->owner->id;

            foreach ($oldIds as $oldId) {
                //            delete old relation if old id is not isset in new ids
                if (!in_array($oldId, $newIds)) {
                    $assign = AttributeToCategory::findOne(['category_id' => $oldId, 'attribute_id' => $id]);


                    if ($assign != null) {
                        $assign->delete();
                    }
                }
            }

            foreach ($newIds as $newId) {
                // create new relation if new id is not isset in old ids
                if (!in_array($newId, $oldIds)) {
                    $assign = new AttributeToCategory(['attribute_id' => $id, 'category_id' => $newId,]);
                    $assign->save();
                }
            }
        }

    }