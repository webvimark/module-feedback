<?php

namespace app\modules\feedback\controllers;

use app\modules\feedback\models\Feedback;
use webvimark\components\BaseController;
use yii\data\ActiveDataProvider;

class DefaultController extends BaseController
{
	public $freeAccess = true;

	/**
	 * Show list of approved feedbacks
	 *
	 * @return string
	 */
	public function actionIndex()
	{
		$provider = new ActiveDataProvider([
			'query' => Feedback::find()->andWhere(['status'=>Feedback::STATUS_APPROVED]),
			'pagination' => [
				'pageSize' => 20,
			],
			'sort' => [
				'defaultOrder' => [
					'id' => SORT_DESC,
				]
			],
		]);

		return $this->render('index', compact('provider'));
	}
}
