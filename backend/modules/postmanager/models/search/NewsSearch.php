<?phpnamespace backend\modules\postmanager\models\search;use Yii;use yii\base\Model;use yii\data\ActiveDataProvider;use backend\modules\postmanager\models\News;class NewsSearch extends News{    public function rules()    {        return [            [['id', 'created_at', 'updated_at', 'user_id'], 'integer'],            [['slug'], 'safe'],            [['status'], 'boolean'],        ];    }    public function scenarios()    {        return Model::scenarios();    }    public function search($params)    {        $query = News::find();        $dataProvider = new ActiveDataProvider([            'query' => $query,        ]);        $this->load($params);        if (!$this->validate()) {            return $dataProvider;        }        $query->andFilterWhere([            'id' => $this->id,            'created_at' => $this->created_at,            'updated_at' => $this->updated_at,            'status' => $this->status,            'user_id' => $this->user_id,        ]);        $query->andFilterWhere(['like', 'slug', $this->slug]);        return $dataProvider;    }}