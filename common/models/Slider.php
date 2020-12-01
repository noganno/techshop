<?php

namespace common\models;

use soft\db\SActiveRecord;
use Yii;
use zxbodya\yii2\galleryManager\GalleryBehavior;

/**
 * This is the model class for table "{{%slider}}".
 *
 * @property int $id
 * @property int|null $type
 * @property int|null $order
 * @property string|null $name
 * @property int|null $status
 */
class Slider extends SActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%slider}}';
    }
    public function behaviors()
    {
        return [
            'galleryBehavior' => [
                'class' => GalleryBehavior::class,
                'type' => 'slider',
                'extension' => 'jpg',
                'directory' => Yii::getAlias('@frontend/web') . '/images/slider/gallery',
                'url' =>  '/images/slider/gallery',
                'versions' => [
                    'small' => function ($img) {
                        /** @var \Imagine\Image\ImageInterface $img */
                        return $img
                            ->copy()
                            ->thumbnail(new \Imagine\Image\Box(200, 200));
                    },
                    'medium' => function ($img) {
                        /** @var \Imagine\Image\ImageInterface $img */
                        $dstSize = $img->getSize();
                        $maxWidth = 800;
                        if ($dstSize->getWidth() > $maxWidth) {
                            $dstSize = $dstSize->widen($maxWidth);
                        }
                        return $img
                            ->copy()
                            ->resize($dstSize);
                    },
                ]
            ]
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type', 'order', 'status'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'type' => Yii::t('app', 'Type'),
            'order' => Yii::t('app', 'Order'),
            'name' => Yii::t('app', 'Name'),
            'status' => Yii::t('app', 'Status'),
        ];
    }
    public function getImages()
    {
        $images = [];
        foreach ($this->getBehavior('galleryBehavior')->getImages() as $image) {
            $images[] = $image->getUrl('original');
            // echo "<pre>";
            // print_r($image->getUrl('medium'));
            // echo "</pre>";
            // ${exit();}
        }
        return $images;
    }
}
