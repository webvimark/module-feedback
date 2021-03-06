<?php

use webvimark\extensions\BootstrapSwitch\BootstrapSwitch;
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

	<?php if ( !$model->isNewRecord AND $model->parent_id !== null ): ?>
		<div class="form-group">
			<div class="col-sm-6 col-sm-offset-3">
				<b>Комментарий к: </b>
				<?= Html::a(
					$model->parent->title . ' [ ' . $model->parent->name . ' ]',
					['view', 'id'=>$model->parent_id],
					['target'=>'_blank']
				) ?>
			</div>

		</div>
		<br/>
	<?php endif; ?>

	<?= $form->field($model, 'status')->dropDownList(Feedback::getStatusList(), ['prompt'=>'']) ?>

	<?= $form->field($model->loadDefaultValues(), 'admin_comment')->checkbox(['class'=>'b-switch'], false) ?>

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

<?php BootstrapSwitch::widget() ?>