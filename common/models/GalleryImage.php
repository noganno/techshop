<?php


namespace common\models;


use yii\db\ActiveRecord;

class GalleryImage extends ActiveRecord
{
    public static function tableName()
    {
        return 'gallery_image';
    }


}