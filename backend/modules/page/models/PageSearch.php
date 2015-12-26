<?php

namespace backend\modules\page\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\helpers\VarDumper;

/**
 * PageSearch represents the model behind the search form about `backend\modules\page\models\Page`.
 */
class PageSearch extends Page
{
    public $title;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['show'],'integer'],
            [['show_in_menu'],'integer'],
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
        $query = Page::find();

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
            $query->andWhere([''.Page::tableName().'.'.'show' => $this->show]);
        }

        if($this->show_in_menu != ''){
            $query->andWhere([''.Page::tableName().'.'.'show_in_menu' => $this->show_in_menu]);
        }

        if($this->title){
            $query->andFilterWhere(['like', PageTranslate::tableName().'.'.'title', $this->title]);
        }

        return $dataProvider;
    }
}