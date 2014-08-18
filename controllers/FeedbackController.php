<?php

namespace app\modules\feedback\controllers;

use Yii;
use app\modules\feedback\models\Feedback;
use app\modules\feedback\models\search\FeedbackSearch;
use webvimark\components\AdminDefaultController;
use yii\filters\VerbFilter;

/**
 * FeedbackController implements the CRUD actions for Feedback model.
 */
class FeedbackController extends AdminDefaultController
{
	/**
	 * @var Feedback
	 */
	public $modelClass = 'app\modules\feedback\models\Feedback';

	/**
	 * @var FeedbackSearch
	 */
	public $modelSearchClass = 'app\modules\feedback\models\search\FeedbackSearch';

	public function behaviors()
	{
		return [
			'verbs' => [
				'class' => VerbFilter::className(),
				'actions' => [
					'delete' => ['post'],
				],
			],
		];
	}


	/**
	 * Approve all selected grid items
	 */
	public function actionBulkApprove()
	{
		if ( Yii::$app->request->post('selection') )
		{
			$modelClass = $this->modelClass;

			$modelClass::updateAll(
				['status'=>Feedback::STATUS_APPROVED],
				['id'=>Yii::$app->request->post('selection', [])]
			);
		}
	}

	/**
	 * Set as pending all selected grid items
	 */
	public function actionBulkSetAsPending()
	{
		if ( Yii::$app->request->post('selection') )
		{
			$modelClass = $this->modelClass;

			$modelClass::updateAll(
				['status'=>Feedback::STATUS_PENDING],
				['id'=>Yii::$app->request->post('selection', [])]
			);
		}
	}

	/**
	 * Deny all selected grid items
	 */
	public function actionBulkDeny()
	{
		if ( Yii::$app->request->post('selection') )
		{
			$modelClass = $this->modelClass;

			$modelClass::updateAll(
				['status'=>Feedback::STATUS_DENIED],
				['id'=>Yii::$app->request->post('selection', [])]
			);
		}
	}
}
