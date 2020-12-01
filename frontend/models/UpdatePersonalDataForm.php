<?php


namespace frontend\models;

use Yii;
use common\models\Towns;
use common\models\User;
use common\models\PaymentTypes;
use yii\base\Model;

class UpdatePersonalDataForm extends Model
{

    public $name;
    public $surname;
    public $father_name;
    public $town_id;
    public $address;
    public $phone;
    public $email;
    public $password;
    public $repassword;
    public $payment_type_id;

    public function rules()
    {
        return [

            [['name', 'surname', 'father_name', 'address', 'phone',], 'string', 'max' => 255],
            ['name', 'required', 'message' => t('This field is required.')],

            ['town_id', 'integer'],
            [['town_id'], 'exist', 'targetClass' => Towns::className(), 'targetAttribute' => ['town_id' => 'id']],
            ['password', 'required'],
            [['password'], 'string', 'min' => 5,
                'message' => t('Password should contain at least 5 characters'),
                'tooShort' => t('Password should contain at least 5 characters'),
            ],

            [['repassword'], 'string'],
            [['repassword'], 'required'],
//
//            [['repassword'], 'required', 'message' => t('This field is required.'), 'when' => function ($model) {
//                return $model->password != '';
//            }, 'whenClient' => "function (attribute, value) {
//                     return $('#user-password').val() != '';
//                 }"],
//
            ['repassword', 'compare', 'compareAttribute' => 'password', 'message' => t('The re-entered password does not match')],

            ['payment_type_id', 'integer'],
            [['payment_type_id'], 'exist', 'targetClass' => PaymentTypes::className(), 'targetAttribute' => ['payment_type_id' => 'id']],

            ['phone', 'required'],
            ['phone', 'checkPhoneNumber'],
            ['phone', 'match', 'pattern' => '/\+998 \(\d{2}\) \d{3}\-\d{2}\-\d{2}/', 'message' => Yii::t('app', 'Incorrect phone number')],

        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['updatePassword'] = ['password', "repassword" ];
        return $scenarios;
    }

    public function checkPhoneNumber()
    {
        $user = User::findOne(['phone' => $this->getClearPhoneNumber()]);
        if ($user != null && $user->id != Yii::$app->user->id) {
            $this->addError('phone', t('This phone number has already been taken'));
            return false;
        }
        return true;
    }

    public function attributeLabels()

    {

        return [

            'name' => t('Your name'),
            'surname' => t('Your lastname'),
            'father_name' => t('Middle name'),
            'password' => t('New password'),
            'repassword' => t('Repeat new password'),
            'town_id' => t('Your town'),
            'email' => t('Your email'),
            'address' => t('Adress'),
            'phone' => t('Phone number'),
            'payment_type_id' => t('Preferred type of payment'),
        ];
    }

    public static function createUserModel()
    {

        $user = Yii::$app->user->identity;
        $model = new UpdatePersonalDataForm([
            'name' => $user->name,
            'surname' => $user->surname,
            'father_name' => $user->father_name,
            'town_id' => $user->town_id,
            'phone' => $user->phone,
            'payment_type_id' => $user->payment_type_id,
            'address' => $user->address,
        ]);
        return $model;
    }

    public function update()
    {
        if (!$this->validate()) {
            return false;
        }
        $user = Yii::$app->user->identity;
        $user->name = $this->name;
        $user->surname = $this->surname;
        $user->father_name = $this->father_name;
        $user->town_id = $this->town_id;
        $user->phone = $this->getClearPhoneNumber();
        $user->payment_type_id = $this->payment_type_id;
        $user->address = $this->address;

        if ($this->password != '') {
            $user->password_hash = Yii::$app->security->generatePasswordHash($this->password);
        }
        return $user->save();
    }

    public function getClearPhoneNumber()
    {
        return Yii::$app->help->clearPhoneNumber($this->phone);
    }
}