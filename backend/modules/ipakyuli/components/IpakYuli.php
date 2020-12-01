<?php

namespace backend\modules\ipakyuli\components;

use backend\modules\ipakyuli\models\IpakyuliSettings;
use backend\modules\ipakyuli\models\IpakyuliTransactions;
use yii;
use yii\base\Component;

class IpakYuli extends Component
{
    public $secret_key = '';
    public $test = 0;
    public $room = "";
    public $url = "";
    public $terminal_num = 1;

    public $success_url;
    public $error_url;
    public $redirect_url;

    const MIN_AMOUNT = 11000;
    const MAX_AMOUNT = 90000000000;


    public function init()
    {
        $this->setValues();
        parent::init();

    }

    public function setTransactionSuccessCode($transactionID, $json)
    {
        $transaction = IpakyuliTransactions::findOne($transactionID);
        $transaction->status = "ok";
        $transaction->success_date = date('U');
        $transaction->return_success_json = $json;
        if ($transaction->save()) {
            return true;
        } else {
            \Yii::info($transaction->errors);
            dd($transaction->errors);
            return false;
        }
    }

    public function setTransactionErrorCode($transactionID, $code, $r)
    {
        $transaction = IpakyuliTransactions::findOne($transactionID);
        $transaction->status = "error";
        $transaction->error_code = $code;
        $transaction->error_date = date('U');
        $transaction->return_error_json = $r;
        if ($transaction->save()) {
            return true;
        } else {
            \Yii::info($transaction->errors);
            return false;
        }
    }


    public function setValues()
    {
        $settings = IpakYuliSettings::find()->one();

        if ($settings->status == "TESTING") {
            $this->test = 1;
            $this->secret_key = $settings->test_key;
        } else {
            $this->secret_key = $settings->main_key;
        }

        $this->room = $settings->room_enter_name;
        $this->success_url = $settings->success_url;
        $this->error_url = $settings->error_url;
        $this->redirect_url = $settings->redirect_url;
        $this->url = $settings->billing_url;
        $this->terminal_num = $settings->terminal_num;

    }


    public function createNewTransaction($order_id, $user_id, $amount, $room = false)
    {
        $newTransaction = new IpakyuliTransactions();

        $newTransaction->order_id = $order_id;
        $newTransaction->user_id = $user_id;
        $newTransaction->amount = $amount;
        $newTransaction->terminal_num = $this->terminal_num;
        if ($room) {
            $newTransaction->room = $this->room;
        }

        if ($newTransaction->save()) {


            $data = [
                'transactionID' => $newTransaction->id,
                'amount' => $newTransaction->amount * 100,
                'terminal_num' => 1,
                'room' => $newTransaction->room,
                'lang' => Yii::$app->language,
                'url' => [
                    "success" => $this->success_url,
                    "fail" => $this->error_url,
                    "redirect" => $this->redirect_url
                ]
            ];

            $formHtml = $this->getPayForm($data);
            $newTransaction->return_html = $formHtml;
            $newTransaction->save();

            return $formHtml;

        } else {
            return $newTransaction->errors;
        }

    }

    public function getPayForm($data)
    {

        $json = json_encode($data);
        $cr = curl_init($this->url);
        curl_setopt($cr, CURLOPT_POST, 1);
        curl_setopt($cr, CURLOPT_POSTFIELDS, $json);
        curl_setopt($cr, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($cr, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($cr, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($cr, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json; charset="utf-8"',
            'X-API-Key: ' . $this->secret_key
        ));
        $resp = curl_exec($cr);
        curl_close($cr);

        return $resp;
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