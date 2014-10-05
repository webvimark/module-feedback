<?php
/**
 * @var $this yii\web\View
 * @var $model webvimark\modules\feedback\models\Feedback
 */
?>

<div class="feedback-item <?= ($model->admin_comment == 1) ? 'feedback-admin-comment' : '' ?>">
	<div class="feedback-header">
		<div class="row">
			<div class="col-xs-40">
				<span class="author"><?= $model->name ?></span>
			</div>

			<div class="col-xs-20 text-right">
				<span class="time"><?= Yii::$app->formatter->asDate($model->created_at) ?></span>
			</div>
		</div>

	</div>

	<div class="feedback-title"><?= $model->title ?></div>

	<div class="feedback-body"><?= nl2br($model->body) ?></div>
</div>
