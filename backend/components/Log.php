<?php

namespace backend\components;

use backend\models\ObmenLogs;
use yii;
use yii\base\Component;

class Log extends Component
{

    const ACTION_PRICE_CHANGE = "action_price_change";
    const ACTION_COUNT_CHANGE = "action_count_change";
    const ACTION_NAME_CHANGE = "action_name_change";

    public function createLog($params)
    {
        $newLog = new ObmenLogs();

        $newLog->name = $params['name'] ? $params['name'] : null;
        $newLog->action = $params['action'] ? $params['action'] : null;
        $newLog->is_from_1c = $params['is_from_1c'] ? $params['is_from_1c'] : 0;
        $newLog->wrote_to_site = $params['wrote_to_site'] ? $params['wrote_to_site'] : 0;
        $newLog->datetime = $params['datetime'] ? $params['datetime'] : date('U');
        $newLog->sale_price = $params['sale_price'] ? $params['sale_price'] : null;
        $newLog->loan_price = $params['loan_price'] ? $params['loan_price'] : null;
        $newLog->guid = $params['guid'] ? $params['guid'] : null;
        $newLog->sklad_id = $params['sklad_id'] ? $params['sklad_id'] : null;
        $newLog->count = $params['count'] ? $params['count'] : 0;

        if ($newLog->save()){
            return true;
        }else{
            return $newLog->errors;
        }
    }

}


?>