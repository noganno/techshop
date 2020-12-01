<?php

namespace backend\modules\postmanager\models;

use common\models\Product;
use soft\behaviors\CyrillicSlugBehavior;
use soft\service\InputType;
use Yii;

class Discount extends \soft\db\SActiveRecord
{

    public $beginField;
    public $endField;
    public $tagsField;

    public static function tableName()
    {
        return '{{%discount}}';
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
            [['created_at', 'updated_at', 'status', 'user_id', 'view', 'like', 'begin', 'end'], 'integer'],
            [['slug'], 'string', 'max' => 255],

            [['image_index', 'image_grid', 'image_detail'], 'string', 'max' => 255],

            [['title',  'meta_title'], 'string', 'max' => 255],
            [['content', 'meta_description', 'meta_keywords'], 'string'],
            [['title'] , 'required'],

            ['tags', 'safe'],
            ['tagsField', 'safe'],

            [['begin', 'end'], 'integer'],
            [['beginField', 'endField'], 'safe'],

            [['slug_changeable', 'deletable'], 'integer'],
            [['slug_changeable', 'deletable'], 'default', 'value' => 1],
        ];
    }

    public function setAttributeLabels()
    {
        return [
            'begin' => Yii::t('app', 'Begin'),
            'end' => Yii::t('app', 'End'),
            'view' => Yii::t('app', 'View'),
            'like' => Yii::t('app', 'Like'),
            'published_at' => Yii::t('app', 'Publishing time'),
            'publishedField' => Yii::t('app', 'Publishing time'),
            'image_index' => t("Image on main page"),
            'image_grid' => t('Image in card'),
            'image_detail' => t('Image in detail page'),
            'meta_title' => t('Meta Title'),
            'meta_description' => t('Meta Description'),
            'meta_keywords' => t('Meta Keyword'),
        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['uploadImages'] = ['image_index', 'image_grid', 'image_detail'];
        return $scenarios;
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
        $query = new \backend\modules\postmanager\models\query\DiscountQuery(get_called_class());
        return $query->multilingual();
    }

    public function getModelConfigs()
    {
        return [

            'meta_description' => [
                'inputType' => InputType::TEXTAREA,
            ],

            'meta_keywords' => [
                'inputType' => InputType::TEXTAREA,
            ],

            'begin' => [
                'format' => 'dateUz',
            ],
            'end' => [
                'format' => 'dateUz',
            ],
            'beginField' => [
                'inputType' => InputType::DATE,
                'options' => [
                    'pluginOptions' => [
                        'language' => 'ru',
                        'todayHighlight' => true,
                        'todayBtn' => true,
                        'autoclose' => true,
                    ]
                ]
            ],
            'endField' => [
                'inputType' => InputType::DATE,
                'options' => [
                    'pluginOptions' => [
                        'language' => 'ru',
                        'todayHighlight' => true,
                        'todayBtn' => true,
                        'autoclose' => true,
                    ]
                ]
            ],
        ];
    }

    public function prepareAttributesForForm()
    {

            if ($this->begin == ''){
                $this->begin = strtotime('now');
            }
            $this->beginField = date("d.m.Y", $this->begin);


            if ($this->end == ''){
                $this->end = strtotime('tomorrow');
            }
            $this->endField = date("d.m.Y", $this->end);

            foreach ($this->languages() as $key => $value)
            {
                $tagAttribute = "tags_".$key;
                $this->{$tagAttribute} = explode(';', trim($this->{$tagAttribute}, " \t\n\r \v;"));
            }
    }

    public function prepareAttributesToSave()
    {
        $this->begin = strtotime($this->beginField);
        $this->end = strtotime($this->endField);

        foreach ($this->languages() as $key => $value)
        {
            $tagAttribute = "tags_".$key;
            $tags = $this->{$tagAttribute};
            if ($tags != ''){
                $this->{$tagAttribute} = ";".trim(implode(';', $tags), " \t\n\r \v;").";";
            }
        }
    }


    public function getIsGoingOn()
    {
        $time = time();
        return $time > $this->begin && $time < $this->end;
    }

    public function getTimeStatus()
    {
        $time = time();
        if ($time > $this->end ){
            return Yii::t('app', "Promotion ended: {endDate}", [
                'endDate' => Yii::$app->formatter->asDateUz($this->end),
            ]);
        }
        else{
            if ( $time  > $this->begin){
                return Yii::t('app', "Promotion is going on from {beginDate} to {endDate}", [
                    'beginDate' => Yii::$app->formatter->asDateUz($this->begin),
                    'endDate' => Yii::$app->formatter->asDateUz($this->end),
                ]);
            }
            else{
                return Yii::t('app', "Promotion will start from {beginDate}", [
                    'beginDate' => Yii::$app->formatter->asDateUz($this->begin),
                    'endDate' => Yii::$app->formatter->asDateUz($this->end),
                ]);
            }
        }
    }

}
