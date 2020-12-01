<?php

namespace backend\modules\sms\components;

//use backend\modules\ipakyuli\models\IpakyuliSettings;
use backend\modules\sms\models\Sms as SmsModel;
use yii;
use yii\base\Component;

class Sms extends Component
{

    public $login = "";
    public $password = "";
    public $gateway = "";
    public $nickname = "";

    public function init()
    {

        parent::init();
        $sms = SmsModel::find()->one();
//        dd($sms);
        $this->login = $sms->login;
        $this->password = $sms->password;
        $this->gateway = $sms->gateway;
        $this->nickname = $sms->nickname;
    }

    public function sendMessage($phone, $text)
    {
        $phone = Yii::$app->help->clearPhoneNumber($phone);

        $numbers[] = [
            'phone' => $phone,
            'text' => $text
        ];

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $this->gateway);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($curl, CURLOPT_TIMEOUT, 5);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);

        if ($this->nickname != "") {
            curl_setopt($curl, CURLOPT_POSTFIELDS, 'login=' . urlencode($this->login) . '&password=' . urlencode($this->password) . '&nickname=' . urlencode($this->nickname) . '&data=' . urlencode(json_encode($numbers)));
        } else {

            curl_setopt($curl, CURLOPT_POSTFIELDS, 'login=' . urlencode($this->login) . '&password=' . urlencode($this->password) . '&data=' . urlencode(json_encode($numbers)));
        }

        $res = curl_exec($curl);
        curl_close($curl);

//        dd($res);

        if (json_decode($res)->error) {
            return false;
        } else {
            return true;
        }

//        curl_setopt($curl, CURLOPT_POSTFIELDS, 'login=' . urlencode($this->login). '&password=' . urlencode($this->password). //'&nickname='.urlencode('test'). '&data='.urlencode('[ {"phone":"998901234567", "text":"Ваш текст смс"} ]')); curl_setopt($curl, CURLOPT_USERAGENT, 'Opera 10.00'); $res = curl_exec($curl); echo $res; curl_close($curl);

    }


    static public function getMessage($value)
    {
        $messages = array(
            0 => array("error" => "0", "error_note" => "Success"),
            1 => array("error" => "-1", "error_note" => "Empty or incorrect header Content-Type"),
            2 => array("error" => "-2", "error_note" => "Incorrect header Content-Type"),
            3 => array("error" => "-3", "error_note" => "Empty header Key"),
            4 => array("error" => "-4", "error_note" => "Incorrect header Key"),
            5 => array("error" => "-5", "error_note" => "Empty or incorrect header Content-Length"),
            6 => array("error" => "-6", "error_note" => "Empty request body"),
            7 => array("error" => "-7", "error_note" => "Incorrect request parameters"),
            8 => array("error" => "-8", "error_note" => "Inactive EPOS"),
            9 => array("error" => "-9", "error_note" => "Empty content"),
            10 => array("error" => "-9", "error_note" => "Client close window"),
            11 => array("error" => "-9", "error_note" => "Транзакция (списание) не прошла"),
            13 => array("error" => "-9", "error_note" => "Транзакция игнорирована по причине не корректного ввода три раза кода подтверждения"),
            14 => array("error" => "-9", "error_note" => "ID транзакции повторяется"),
            15 => array("error" => "-9", "error_note" => "Не авторизованный запрос"),
            16 => array("error" => "-9", "error_note" => "Сумма операции меньше минимальной суммы"),
            'n' => array("error" => "-n", "error_note" => "Unknown Error"),
        );
        return $messages[$value];
    }
}


?>