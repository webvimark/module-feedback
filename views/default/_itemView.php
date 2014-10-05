<?php
/**
 * @var $this yii\web\View
 * @var $model Feedback
 */
use webvimark\modules\feedback\FeedbackModule;
use webvimark\modules\feedback\models\Feedback;
use yii\helpers\Html;

?>

<div class="feedback-item-wrapper">

	<?= $this->render('_feedbackBody', ['model'=>$model]) ?>

	<?php if ( $this->context->module->hasComments ): ?>

		<div class="feedback-footer text-right">
			<?= Html::a(
				FeedbackModule::t('front', 'Комментировать'),
				['send-feedback', 'id'=>$model->id],
				['class'=>'btn btn-default btn-sm fancybox fancybox.ajax']
			) ?>
		</div>

		<?php if ( $model->comments ): ?>

			<div class="feedback-comments">
				<?php foreach ($model->comments as $comment): ?>
					<div class="row">
						<div class="col-xs-50 col-xs-offset-10">
							<?= $this->render('_feedbackBody', ['model'=>$comment]) ?>
						</div>
					</div>
				<?php endforeach ?>
			</div>

		<?php endif; ?>

	<?php endif; ?>

</div>
