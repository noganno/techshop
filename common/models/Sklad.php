<?php

namespace common\models;

use common\models\ProductToSklad;
use soft\behaviors\CyrillicSlugBehavior;
use soft\db\SActiveRecord;
use soft\service\InputType;
use yeesoft\multilingual\behaviors\MultilingualBehavior;
use yeesoft\multilingual\db\MultilingualQuery;
use Yii;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;


/**
 * This is the model class for table "sklad".
 *
 * @property int $id
 * @property string|null $slug
 * @property int|null $town_id
 * @property string|null $work_time
 * @property string|null $lat
 * @property string|null $long
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property SkladLang[] $skladLangs
 */
class Sklad extends \soft\db\SActiveRecord
{
    /**
     * {@inheritdoc}
     */

    public function fields()
    {
        return [
            'УникальныйИдентификатор' => "unique_id",
            'Склад' => "description"
        ];
    }

    public static function tableName()
    {
        return 'sklad';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['unique_id', 'unique'],
            [['region_id','in_map', 'created_at', 'updated_at', 'status'], 'integer'],
            [['slug', 'phone', 'unique_id'], 'string', 'max' => 127],
            [['address', 'description', 'name'], 'string'],
            [['work_time', 'lat', 'long'], 'string', 'max' => 255],
        ];
    }

    public function behaviors()
    {
        return array_merge(parent::behaviors(), [

            [
                'class' => \common\models\behavior\CyrillicSlugBehavior::className(),
                'attribute' => 'description',
            ],

        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function setAttributeLabels()
    {
        return [
            'address' => Yii::t('app', 'Adress'),
            'name' => Yii::t('app', 'Name'),
            'in_map' => Yii::t('app', 'In Map'),
            'description' => Yii::t('app', 'Description'),
            'phone' => Yii::t('app', 'Phone'),
            'region_id' => Yii::t('app', 'Town'),
            'work_time' => Yii::t('app', 'Work time'),
            'lat' => Yii::t('app', 'Latitude'),
            'long' => Yii::t('app', 'Longtitude'),
        ];
    }

    public static function find()
    {
        $query = new MultilingualQuery(get_called_class());
        return $query->multilingual();
    }

    public function setAttributeNames()
    {
        return [
            'multilingualAttributes' => ['address', 'description', 'name'],
        ];
    }

    public function getRegion()
    {
        return $this->hasOne(Towns::class, ['id' => 'region_id']);
    }


    public function getProductsCount()
    {
        $ptos = ProductToSklad::find()
            ->where(['sklad_id' => $this->id])
            ->sum('quantity');

        return $ptos;
    }

    public function getModelConfigs()
    {
        return [

            'region_id' => [
                'inputType' => InputType::SELECT2,
            ],
        ];
    }

    public function get1cProductsCount()
    {
        $store = $this->unique_id;

        $count = Yii::$app->c1->getSkladProductsCount($store);

        return $count;
    }


}
