<?php

namespace backend\modules\usermanager\models;

use common\models\Towns;
use soft\helpers\SHtml;
use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property int|null $is_worker
 * @property int|null $user_type
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string|null $password_reset_token
 * @property string|null $email
 * @property int $status
 * @property int|null $payment_type_id
 * @property int $created_at
 * @property int $updated_at
 * @property string|null $full_name
 * @property string|null $name
 * @property string|null $surname
 * @property string|null $father_name
 * @property string|null $phone
 * @property string|null $phone_verification
 * @property string|null $birth_date
 * @property string|null $passport
 * @property string|null $passport_date_of_issue
 * @property string|null $passport_date_of_expiry
 * @property string|null $passport_authority
 * @property string|null $inn
 * @property int|null $town_id
 * @property int|null $region_id
 * @property string|null $address
 * @property string|null $work
 * @property string|null $kpp
 * @property string|null $company_name
 * @property string|null $ogrn
 * @property string|null $bik
 * @property string|null $account_number
 * @property string|null $verification_token
 * @property string|null $image
 * @property string|null $guid
 * @property int|null $gender
 *
 * @property PostTag[] $postTags
 */
class User extends \soft\db\SActiveRecord
{

    const STATUS_DELETED = 0;
    const STATUS_INACTIVE = 9;
    const STATUS_ACTIVE = 10;
    const STATUS_WAITING = 5;

    public $softDelete = false;

    public $password;
    public $repassword;

    public static function tableName()
    {
        return 'user';
    }

    public function rules()
    {
        return [

            [['is_worker', 'user_type', 'status', 'payment_type_id', 'created_at', 'updated_at', 'town_id', 'region_id', 'gender'], 'integer'],
            [['username', 'auth_key', 'password_hash', 'created_at', 'updated_at'], 'required'],
            [['birth_date', 'passport_date_of_issue', 'passport_date_of_expiry'], 'safe'],
            [['username', 'password_hash', 'password_reset_token', 'email', 'full_name', 'name', 'surname', 'father_name', 'phone', 'passport_authority', 'address', 'work', 'kpp', 'company_name', 'ogrn', 'bik', 'account_number', 'verification_token', 'image', 'guid'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['phone_verification'], 'string', 'max' => 500],
            [['inn'], 'string', 'max' => 12],
            [['username'], 'unique'],

            [[ 'name', 'surname',], 'required'],

            ['password', 'required', 'on' => 'create'],

            [['password'], 'string', 'min' => 5, 'max' => 20,
                'message' => t('Password should contain at least 5 characters'),
                'tooShort' => t('Password should contain at least 5 characters'),
            ],

            [['repassword'], 'string'],
            [['repassword'], 'required', 'message' => t('This field is required.'), 'when' => function ($model) {
                return $model->password != '';
            }, 'whenClient' => "function (attribute, value) {
                     return $('#user-password').val() != '';
                 }"],
            ['repassword', 'compare', 'compareAttribute' => 'password', 'message' => t('The re-entered password does not match')],


        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['change-status'] = ['status'];
        $scenarios['update'] = [
            'username',
            'surname',
            'town_id',
            'name',
            'guid',
            'phone',
            'image',
            'payment_type_id',
            'father_name',
            'email',
            'image',
            'address',
            'password',
            'repassword',
        ];

        $scenarios['create'] = [
            'username',
            'surname',
            'town_id',
            'name',
            'phone',
            'image',
            'payment_type_id',
            'father_name',
            'email',
            'image',
            'address',
            'password',
            'repassword',
        ];
        return $scenarios;
    }

    public function setAttributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'username' => "Login",
            'name' => t("Ism"),
            'surname' => t("Lastname"),
            'father_name' => t("Your father name"),
            'is_worker' => Yii::t('app', 'Is Worker'),
            'user_type' => Yii::t('app', 'User Type'),
            'auth_key' => Yii::t('app', 'Auth Key'),
            'password_hash' => Yii::t('app', 'Password Hash'),
            'password_reset_token' => Yii::t('app', 'Password Reset Token'),
            'email' => Yii::t('app', 'Email'),
            'status' => Yii::t('app', 'Status'),
            'payment_type_id' => Yii::t('app', 'Preferred type of payment'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'full_name' => Yii::t('app', 'Full Name'),
            'phone' => Yii::t('app', 'Phone'),
            'phone_verification' => Yii::t('app', 'Phone Verification'),
            'birth_date' => Yii::t('app', 'Birth Date'),
            'passport' => Yii::t('app', 'Passport'),
            'passport_date_of_issue' => Yii::t('app', 'Passport Date Of Issue'),
            'passport_date_of_expiry' => Yii::t('app', 'Passport Date Of Expiry'),
            'passport_authority' => Yii::t('app', 'Passport Authority'),
            'inn' => Yii::t('app', 'Inn'),
            'town_id' => Yii::t('app', 'Towns'),
            'region_id' => Yii::t('app', 'Region ID'),
            'address' => Yii::t('app', 'Address'),
            'work' => Yii::t('app', 'Work'),
            'kpp' => Yii::t('app', 'Kpp'),
            'company_name' => Yii::t('app', 'Company Name'),
            'ogrn' => Yii::t('app', 'Ogrn'),
            'bik' => Yii::t('app', 'Bik'),
            'account_number' => Yii::t('app', 'Account Number'),
            'verification_token' => Yii::t('app', 'Verification Token'),
            'image' => Yii::t('app', 'Image'),
            'guid' => Yii::t('app', 'Guid'),
            'gender' => Yii::t('app', 'Gender'),
        ];
    }

    public function setAttributeNames()
    {
        return [
            'createdAtAttribute' => 'created_at',
            'updatedAtAttribute' => 'updated_at',
        ];
    }


    public static function find()
    {
        $query = new \soft\db\SActiveQuery(get_called_class());
        return $query;
    }

    public function getStatusLabel()
    {
        if ($this->status == User::STATUS_ACTIVE) {
            return SHtml::tag('span', t('Active'), ['class' => 'badge badge-primary']);
        } else {
            if ($this->status == User::STATUS_WAITING) {
                return SHtml::tag('span', t('Waiting'), ['class' => 'badge badge-warning']);

            }
            return SHtml::tag('span', t('Inactive'), ['class' => 'badge badge-danger']);
        }
    }

    public function getTown()
    {
        return $this->hasOne(Towns::class, ['id' => 'town_id']);
    }

    public function setNewPassword()
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($this->password);
    }

}
