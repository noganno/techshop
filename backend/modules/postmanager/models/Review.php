<?php

namespace backend\modules\postmanager\models;

use common\models\Product;
use soft\behaviors\CyrillicSlugBehavior;
use soft\service\InputType;
use Yii;

class Review extends \soft\db\SActiveRecord
{

    public $publishedField;
    public $tagsField;

    public static function tableName()
    {
        return '{{%review}}';
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
            [['created_at', 'updated_at', 'status', 'user_id', 'view', 'like', 'published_at', 'product_id'], 'integer'],
            [['slug'], 'string', 'max' => 255],

            [['image_index', 'image_grid', 'image_detail'], 'string', 'max' => 255],

            [['title',  'meta_title'], 'string', 'max' => 255],
            [['content', 'meta_description', 'meta_keywords'], 'string'],
            [['title'] , 'required'],

            ['tags', 'safe'],
            ['tagsField', 'safe'],

            ['published_at', 'integer'],
            ['publishedField', 'safe'],

            [['slug_changeable', 'deletable'], 'integer'],
            [['slug_changeable', 'deletable'], 'default', 'value' => 1],

            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    public function setAttributeLabels()
    {
        return [
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
            'product_id' => t("Product"),
            'productName' => t("Product"),
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
        $query = new \backend\modules\postmanager\models\query\ReviewQuery(get_called_class());
        return $query->multilingual();
    }

    public function getModelConfigs()
    {
        return [

           /* 'product_id' => [
                'inputType' => InputType::SELECT2,
            ],*/
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


    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }

    public function getProductName()
    {
        if ($this->product == null){
            return null;
        }
        else return $this->product->name;
    }

    public function prepareAttributesForForm()
    {
        if ($this->isNewRecord){
            $this->publishedField = date("Y-m-d H:i");
        }
        else{
            if ($this->published_at == ''){
                $this->publishedField = date("Y-m-d H:i");
            }
            else{
                $this->publishedField = date("Y-m-d H:i", $this->published_at);
            }

            foreach ($this->languages() as $key => $value)
            {
                $tagAttribute = "tags_".$key;
                $this->{$tagAttribute} = explode(';', trim($this->{$tagAttribute}, " \t\n\r \v;"));
            }

//            $this->tagsField =  explode(';', trim($this->tags, " \t\n\r \v;"));
        }
    }

    public function prepareAttributesToSave()
    {
        $this->published_at = strtotime($this->publishedField);

        foreach ($this->languages() as $key => $value)
        {
            $tagAttribute = "tags_".$key;
            $tags = $this->{$tagAttribute};
            if ($tags != ''){
                $this->{$tagAttribute} = ";".trim(implode(';', $tags), " \t\n\r \v;").";";
            }
        }

//        $this->tags = ";".trim(implode(';', $this->tagsField), " \t\n\r \v;").";";
    }



}
