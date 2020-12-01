<?php

namespace backend\modules\postmanager\models;

use soft\behaviors\CyrillicSlugBehavior;
use soft\service\InputType;
use Yii;

class Post extends \soft\db\SActiveRecord
{

    public $publishedField;
    public $tagsField;

    public static function tableName()
    {
        return '{{%post}}';
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

    public function rules()
    {
        return [
            [['created_at', 'updated_at', 'status', 'user_id', 'category_id', 'view', 'like', 'published_at'], 'integer'],
            [['slug'], 'string', 'max' => 127],
            [['image'], 'string', 'max' => 255],

            [['title',  'meta_title'], 'string', 'max' => '255'],
            [['content', 'meta_description', 'meta_keywords'], 'string'],
            [['title', 'category_id'] , 'required'],

            ['tags', 'safe'],
            ['tagsField', 'safe'],

            ['published_at', 'integer'],
            ['publishedField', 'safe'],

            [['slug_changeable', 'deletable'], 'integer'],
            [['slug_changeable', 'deletable'], 'default', 'value' => 1],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => PostCategory::className(), 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    public function setAttributeLabels()
    {
        return [
            'category_id' => Yii::t('app', 'Category'),
            'view' => Yii::t('app', 'View'),
            'like' => Yii::t('app', 'Like'),
            'published_at' => Yii::t('app', 'Published At'),
        ];
    }

    public function getCategory()
    {
        return $this->hasOne(PostCategory::className(), ['id' => 'category_id']);
    }

    public function getPostLangs()
    {
        return $this->hasMany(PostLang::className(), ['owner_id' => 'id']);
    }

    public function setAttributeNames()
    {
        return [
            'multilingualAttributes' => ['title', 'content', 'meta_title', 'meta_description', 'meta_keywords', 'tags'],
        ];
    }

    public function deleteConditions()
    {
        return $this->deletable;
    }

    public function isNewSlugNeeded()
    {
        return $this->slug_changeable;
    }

    public static function find()
    {
        $query = new \backend\modules\postmanager\models\query\PostQuery(get_called_class());
        return $query->multilingual();
    }

    public function getModelConfigs()
    {
        return [

            'category_id' => [
                'inputType' => InputType::SELECT2,
            ],
            'meta_description' => [
                'inputType' => InputType::TEXTAREA,
            ],

            'meta_keywords' => [
                'inputType' => InputType::TEXTAREA,
            ],

            'published_at' => [
                'inputType' => InputType::DATETIME,
                'format' => 'dateTimeUz',

            ],
            'publishedField' => [
                'inputType' => InputType::DATETIME,
                'options' => [
                    'pluginOptions' => [
                        'language' => 'ru',
                        'todayHighlight' => true,
                        'todayBtn' => true,
                        'autoclose' => true,
                    ]
                ]
            ]
        ];
    }
}
