<?php

use webvimark\modules\feedback\models\Feedback;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use webvimark\extensions\ckeditor\CKEditor;

/**
 * @var yii\web\View $this
 * @var webvimark\modules\feedback\models\Feedback $model
 * @var yii\bootstrap\ActiveForm $form
 */
?>
<div class="feedback-form">

	<?php $form = ActiveForm::begin([
		'id'=>'feedback-form',
		'layout'=>'horizontal',
		]); ?>

	<?= $form->field($model, 'status')->dropDownList(Feedback::getStatusList(), ['prompt'=>'']) ?>

	<?= $form->field($model, 'name')->textInput(['maxlength' => 255, 'autofocus'=>$model->isNewRecord ? true:false]) ?>

	<?= $form->field($model, 'title')->textInput(['maxlength' => 255]) ?>

	<?= $form->field($model, 'body', ['enableClientValidation'=>false, 'enableAjaxValidation'=>false])->textarea(['rows' => 10]) ?>

	<div class="form-group">
		<div class="col-sm-offset-3 col-sm-9">
			<?php if ( $model->isNewRecord ): ?>
				<?= Html::submitButton(
					'<span class="glyphicon glyphicon-plus-sign"></span> Создать',
					['class' => 'btn btn-success']
				) ?>
			<?php else: ?>
				<?= Html::submitButton(
					'<span class="glyphicon glyphicon-ok"></span> Сохранить',
					['class' => 'btn btn-primary']
				) ?>
			<?php endif; ?>
		</div>
	</div>

	<?php ActiveForm::end(); ?>

</div>
