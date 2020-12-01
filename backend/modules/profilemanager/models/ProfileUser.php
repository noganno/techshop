<?php

namespace backend\modules\profilemanager\models;

use soft\db\SActiveRecord;

class ProfileUser extends SActiveRecord
{
    public static function tableName()
    {
        return 'user';
    }

    public function rules()
    {
        return [

            ['username', 'required'],
            ['username', 'unique'],
            [['username', 'email', 'name', 'surname', 'father_name', 'image'], 'string',  'max' => 255],
            ['email', 'unique'],
            ['email', 'email'],
            ['password_hash', 'safe'],

        ];
    }

    public function setAttributeLabels()
    {
        return [
            'username' => "Login",
            'name' => t("Your name"),
            'surname' => t("Lastname"),
            'father_name' => t("Your father name"),
        ];
    }


    public function scenarios()
    {
        $s = parent::scenarios();
        $s['update'] = ['username', 'email', 'firstname', 'lastname', 'image'];
        $s['change-password'] = ['password_hash'];
        return $s;
    }

}