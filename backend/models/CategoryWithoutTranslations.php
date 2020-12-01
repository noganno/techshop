<?php

namespace backend\models;


use kartik\tree\models\Tree;

class CategoryWithoutTranslations extends Tree
{

    public static function tableName()
    {
        return 'category';
    }

}
