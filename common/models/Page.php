<?php

namespace common\models;

use soft\db\SActiveQuery;
use soft\db\SActiveRecord;
use soft\helpers\SUrl;
use soft\web\SUrlManager;
use yeesoft\multilingual\behaviors\MultilingualBehavior;
use yeesoft\multilingual\db\MultilingualQuery;
use Yii;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\helpers\Html;

class Page extends SActiveRecord
{


    public static function tableName()
    {
        return 'page';
    }

    public function rules()
    {
        return [
            [['created_at', 'updated_at', 'middle', 'status'], 'integer'],
            [['slug', 'icon_class', 'idn'], 'string', 'max' => 127],
            [['title', 'description', 'sub_title', 'image'], 'string'],
            ['title', 'required'],

            ['idn', 'trim'],
            ['idn', 'required'],
            ['idn', 'unique'],
        ];
    }

    public function scenarios()
    {
        $s = parent::scenarios();
        $s['update'] = ['middle', 'status', 'slug', 'icon_class', 'title', 'description', 'sub_title', 'image'];
        return $s;
    }


    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'slug' => Yii::t('app', 'Slug'),
            'icon_class' => Yii::t('app', 'Icon'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'title' => Yii::t('app', 'Title'),
            'sub_title' => Yii::t('app', 'Subtitle'),
            'description' => Yii::t('app', 'Content'),
            'idn' => Yii::t('app', 'Identifikator'),
            'image' => Yii::t('app', 'Image'),
            'pageIconGrid' => Yii::t('app', 'Image'),
            'middle' => t('Show on index page'),
        ];
    }

    public static function find()
    {
        $query = new SActiveQuery(get_called_class());
        return $query->multilingual();
    }

    public function setAttributeNames()
    {
        return [
            'multilingualAttributes' => ['title', 'sub_title', 'description', 'image'],
        ];
    }

    public function deleteConditions()
    {
        return $this->deletable;
    }


    public function getUrl()
    {
        $urlManager = new SUrlManager([
            'showScriptName' => false,
            'enablePrettyUrl' => true,
            'rules' => [
                '<language:\w+>/page/<id>' => 'site/page',
            ],
        ]);
        $urlManager->baseUrl = '/';
        return $urlManager->createAbsoluteUrl(['/site/page', 'id' => $this->idn], true);
    }

    public function getPageIcon()
    {
        if ($this->icon_class == '') {
            return fa('file-text-o');
        } else {
            return Html::img($this->icon_class, [
                'class' => 'page-icon-image'
            ]);
        }
    }


    public function getPageIconGrid()
    {
        if ($this->icon_class == '') {
            return fa('file-text-o');
        } else {
            return Html::img($this->icon_class, [
                'style' => 'width:100px',
                'class' => 'thumbnail',
            ]);
        }
    }

    /*   public static function menuForTop($idn='')
       {
           $model = static::findOne(['idn' => $idn, 'status' => 1]);
           if ($model == null)
               return '';
           return a()

       }*/

}
