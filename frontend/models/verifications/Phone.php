<?php


namespace frontend\models\verifications;


use yii\base\Model;

class Phone extends Model
{
    public $phone;
    public $code;


    public function rules()
    {
        return [
            ['phone', 'safe'],
            ['phone', 'string'],
            ['code', 'integer'],
        ];
    }


    public function sendSms()
    {
        if ($this->isExpired()) {
            $code = mt_rand(10000, 99999);

            $message = \Yii::t('app', 'Verify your order on {hostInfo}: Verify code: {code}', [
                'hostInfo' => \Yii::$app->request->hostInfo,
                'code' => $code,
            ]);

            if (\Yii::$app->sms->sendMessage($this->phone, $message)) {
                \Yii::$app->session->set('orderVerifyCode', $code);
                \Yii::$app->session->set('orderVerifyCodeTime', date('U'));
                return true;
            } else {
                return false;
            }
        } else {
            $this->addError('code', t("Code already sent"));
            return false;
        }
    }

    public function compareCode()
    {
        if (\Yii::$app->session->get('orderVerifyCode') == $this->code) {
            if (!$this->isExpired()) {
                $this->addError('code', t('Code expired'));
                return false;
            } else {
                return true;
            }
        } else {
            $this->addError('code', t('Code error'));
        }
    }

    public function isExpired()
    {
        if ((date('U') - \Yii::$app->session->get('orderVerifyCode')) < \Yii::$app->params['verifyTime']) {
            return false;
        } else {
            return true;
        }
    }


}