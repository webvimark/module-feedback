<?php

namespace webvimark\modules\feedback\controllers;

use webvimark\modules\feedback\FeedbackModule;
use webvimark\modules\feedback\models\Feedback;
use webvimark\components\BaseController;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use Yii;

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
			'query' => Feedback::find()
					->andWhere([
						'status'=>Feedback::STATUS_APPROVED,
						'parent_id'=>null,
					])
					->orderBy('id DESC'),
			'pagination' => [
				'pageSize' => 10,
			],
		]);

		return $this->render('index', compact('provider'));
	}

	/**
	 * Show form (usually via AJAX) for feedback
	 *
	 * @param null|int $id parent feedback ID (for comments)
	 *
	 * @throws \yii\web\NotFoundHttpException
	 * @throws \yii\web\BadRequestHttpException
	 * @return string
	 */
	public function actionSendFeedback($id = null)
	{
		if ( $id )
		{
			$parent = Feedback::findOne([
				'id'=>$id,
				'status'=>Feedback::STATUS_APPROVED,
			]);

			if ( !$parent )
			{
				throw new NotFoundHttpException(FeedbackModule::t('front', 'Отзыв не найден'));
			}
		}

		$model = new Feedback();

		if ( $model->load(Yii::$app->request->post()) )
		{
			$model->parent_id = isset($parent) ? $parent->id : null;
			$model->status = Feedback::STATUS_PENDING;
			$model->admin_comment = 0;

			if ( $model->save() )
			{
				Yii::$app->session->setFlash('success', FeedbackModule::t('front', 'Спасибо за Ваш отзыв !'));

				$this->redirect(['index']);
			}
		}

		if ( Yii::$app->request->isAjax )
			return $this->renderAjax('sendFeedback', compact('model', 'id'));
		else
			return $this->render('sendFeedback', compact('model', 'id'));
	}
}
