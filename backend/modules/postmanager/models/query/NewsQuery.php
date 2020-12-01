<?php

namespace backend\modules\postmanager\models\query;

class NewsQuery extends \soft\db\SActiveQuery
{

    public function published()
    {
        return $this->andWhere(['<=', 'news.published_at', time()]);
    }

    public function recently($limit = 0)
    {
        $query = $this->orderBy(['news.published_at' => SORT_DESC]);
        if ($limit > 0){
            $query->limit($limit);
        }
        return $query;
    }

}
