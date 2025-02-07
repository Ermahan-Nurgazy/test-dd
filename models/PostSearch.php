<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;

class PostSearch extends Model
{
    public $title;
    public $status;
    public $tags;

    public function rules()
    {
        return [
            ['title', 'string'],
            ['status', 'integer'],
            ['tags', 'each', 'rule' => ['string']],
            [['title', 'status', 'tags'], 'safe'],
        ];
    }

    public function search()
    {
        $query = Post::find()->joinWith('tags');

        if ($this->title) {
            $query->andWhere(['like', 'title', $this->title]);
        }

        if (isset($this->status)) {
            $query->andWhere(['status' => $this->status]);
        }

        if ($this->tags) {
            $query->andWhere(['tag.name' => $this->tags]);
        }

        return new ActiveDataProvider([
            'query' => $query->asArray(),
            'sort' => ['defaultOrder' => ['updated_at' => SORT_DESC]],
            'pagination' => new Pagination()
        ]);
    }

}