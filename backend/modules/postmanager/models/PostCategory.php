<?php

namespace backend\modules\postmanager\models;

use soft\behaviors\CyrillicSlugBehavior;
use Yii;

class PostCategory extends \soft\db\SActiveRecord
{
    public static function tableName()
    {
        return '{{%post_category}}';
    }

    public function rules()
    {
        return [
            [['status', 'slug_changeable', 'deletable'], 'integer'],
            [['slug_changeable', 'deletable'], 'default', 'value' => 1],
            [['slug'], 'string', 'max' => 127],
            ['title', 'string', 'max' => 255],
            ['title', 'required'],
        ];
    }


    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors[] = [
            'class' => CyrillicSlugBehavior::className(),
            'attribute' => 'title',
        ];
        return $behaviors;
    }

    public function setAttributeLabels()
    {
        return [
        ];
    }

    public function setAttributeNames()
    {
        return [

            'multilingualAttributes' => ['title'],

        ];
    }

    public function deleteConditions()
    {
        return !$this->hasPosts && $this->deletable;
    }

    public function getPosts()
    {
        return $this->hasMany(Post::className(), ['category_id' => 'id']);
    }

    public function getHasPosts()
    {
        return $this->getPosts()->count() > 0;
    }

    public static function find()
    {
        $query = new \backend\modules\postmanager\models\query\PostCategoryQuery(get_called_class());
        return $query->multilingual();
    }

    public function isNewSlugNeeded()
    {
        return $this->slug_changeable;
    }
}
