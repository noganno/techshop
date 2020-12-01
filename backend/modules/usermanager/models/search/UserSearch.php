<?php

namespace backend\modules\usermanager\models\search;

use backend\modules\usermanager\models\User;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class UserSearch extends User
{

    public function rules()
    {
        return [
            [['id', 'is_worker', 'user_type', 'status', 'payment_type_id', 'created_at', 'updated_at', 'town_id', 'region_id', 'gender', 'deleted'], 'integer'],
            [['username', 'auth_key', 'password_hash', 'password_reset_token', 'email', 'full_name', 'name', 'surname', 'father_name', 'phone', 'phone_verification', 'birth_date', 'passport', 'passport_date_of_issue', 'passport_date_of_expiry', 'passport_authority', 'inn', 'address', 'work', 'kpp', 'company_name', 'ogrn', 'bik', 'account_number', 'verification_token', 'image', 'guid'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = User::find()->andWhere(['!=', 'deleted', 1]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere(['!=', 'deleted', 1]);

        $query->andFilterWhere([
            'id' => $this->id,
            'is_worker' => $this->is_worker,
            'user_type' => $this->user_type,
            'status' => $this->status,
            'payment_type_id' => $this->payment_type_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'birth_date' => $this->birth_date,
            'passport_date_of_issue' => $this->passport_date_of_issue,
            'passport_date_of_expiry' => $this->passport_date_of_expiry,
            'town_id' => $this->town_id,
            'region_id' => $this->region_id,
            'gender' => $this->gender,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'password_hash', $this->password_hash])
            ->andFilterWhere(['like', 'password_reset_token', $this->password_reset_token])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'full_name', $this->full_name])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'surname', $this->surname])
            ->andFilterWhere(['like', 'father_name', $this->father_name])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'phone_verification', $this->phone_verification])
            ->andFilterWhere(['like', 'passport', $this->passport])
            ->andFilterWhere(['like', 'passport_authority', $this->passport_authority])
            ->andFilterWhere(['like', 'inn', $this->inn])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'work', $this->work])
            ->andFilterWhere(['like', 'kpp', $this->kpp])
            ->andFilterWhere(['like', 'company_name', $this->company_name])
            ->andFilterWhere(['like', 'ogrn', $this->ogrn])
            ->andFilterWhere(['like', 'bik', $this->bik])
            ->andFilterWhere(['like', 'account_number', $this->account_number])
            ->andFilterWhere(['like', 'verification_token', $this->verification_token])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'guid', $this->guid]);
        return $dataProvider;
    }
}
