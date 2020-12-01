<?php

namespace frontend\models\query;

class CategoryQuery extends \soft\db\SActiveQuery

{

    public function root($root = '')
    {
        return $this->andWhere(['root' => $root]);
    }

    public function level($lvl = '')
    {
        return $this->andWhere(['lvl' => $lvl]);
    }

    public function active()
    {
        return $this->andWhere(['status' => 1, 'active' => 1]);
    }

}

