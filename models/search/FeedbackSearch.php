<?php

namespace webvimark\modules\feedback\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use webvimark\modules\feedback\models\Feedback;

/**
 * FeedbackSearch represents the model behind the search form about `webvimark\modules\feedback\models\Feedback`.
 */
class FeedbackSearch extends Feedback
{
	public function rules()
	{
		return [
			[['id', 'status', 'parent_id', 'created_at', 'updated_at', 'admin_comment'], 'integer'],
			[['name', 'title', 'body'], 'safe'],
		];
	}

	public function scenarios()
	{
		// bypass scenarios() implementation in the parent class
		return Model::scenarios();
	}

	public function search($params)
	{
		$query = Feedback::find();

//		$query->joinWith(['parent']);

		$dataProvider = new ActiveDataProvider([
			'query' => $query,
			'pagination' => [
				'pageSize' => Yii::$app->request->cookies->getValue('_grid_page_size', 20),
			],
			'sort'=>[
				'defaultOrder'=>['id'=> SORT_DESC],
			],
		]);

		if (!($this->load($params) && $this->validate())) {
			return $dataProvider;
		}

		$query->andFilterWhere([
			'feedback.id' => $this->id,
			'feedback.status' => $this->status,
			'feedback.parent_id' => $this->parent_id,
			'feedback.admin_comment' => $this->admin_comment,
			'feedback.created_at' => $this->created_at,
			'feedback.updated_at' => $this->updated_at,
		]);

        	$query->andFilterWhere(['like', 'feedback.name', $this->name])
			->andFilterWhere(['like', 'feedback.title', $this->title]);

		return $dataProvider;
	}
}
