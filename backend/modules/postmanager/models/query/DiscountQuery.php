<?php

namespace backend\modules\postmanager\models\query;

class DiscountQuery extends \soft\db\SActiveQuery
{

    public function recently($limit = 0)
    {
        $query = $this->orderBy(['discount.begin' => SORT_ASC]);
        if ($limit > 0){
            $query->limit($limit);
        }
        return $query;
    }

}
