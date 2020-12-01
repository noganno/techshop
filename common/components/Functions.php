<?php

namespace common\components;

use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;

class Functions extends Component
{
    public function dd($data){
        echo "<pre>";
        print_r($data);
        echo "</pre>";
        exit();
    }
    public function error($error)
    {
        return $error;
    }
}
