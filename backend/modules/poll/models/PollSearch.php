<?php

namespace backend\modules\poll\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\helpers\VarDumper;

/**
 * PollSearch represents the model behind the search form about `backend\modules\poll\models\Poll`.
 */
class PollSearch extends Poll
{
    public $title;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['show'],'integer'],
            [['type'],'integer'],
            [['title'],'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Poll::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->getSort()->attributes['title'] = [
            'asc' => ['title' => SORT_ASC],
            'desc' => ['title' => SORT_DESC],
            'default' => SORT_ASC
        ];

        $this->load($params);

        $query->joinWith(['translate']);

        if($this->show != ''){
            $query->andWhere([''.Poll::tableName().'.'.'show' => $this->show]);
        }

        if($this->type != ''){
            $query->andWhere([''.Poll::tableName().'.'.'type' => $this->type]);
        }

        if($this->title){
            $query->andFilterWhere(['like', PollTranslate::tableName().'.'.'title', $this->title]);
        }

        return $dataProvider;
    }
}