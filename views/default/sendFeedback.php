<?php
/**
 * @var $this yii\web\View
 * @var $id int|null
 */
use webvimark\modules\feedback\FeedbackModule;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<div class="feedback-form-container">
	<div class="col-xs-60" style="width: 500px">
		<?php $form = ActiveForm::begin([
			'id'      => 'feedback-form',
			'options' => ['class' => 'form-horizontal'],
		]) ?>

		<?= $form->field($model, 'name') ?>
		<?= $form->field($model, 'title') ?>
		<?= $form->field($model, 'body')->textarea(['rows'=>10]) ?>

		<div class="form-group">
			<?= Html::submitButton(
				$id ? FeedbackModule::t('front', 'Оставить комментарий') : FeedbackModule::t('front', 'Оставить отзыв'),
				['class' => 'btn btn-primary']
			) ?>
		</div>
		<?php ActiveForm::end() ?>

	</div>
</div>
