<?php
/**
 * @var $this yii\web\View
 * @var $provider ActiveDataProvider
 */
use webvimark\extensions\fancybox\Fancybox;
use webvimark\modules\feedback\FeedbackModule;
use yii\bootstrap\Alert;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\widgets\ListView;

$this->title = FeedbackModule::t('front', 'Отзывы');
$this->params['breadcrumbs'][] = $this->title;
?>

<div id="feedback-list">

	<?php if ( Yii::$app->session->hasFlash('success') ): ?>
		<?= Alert::widget([
			'options'=>[
				'class'=>'alert-success text-center',
			],
			'body'=>Yii::$app->session->getFlash('success'),
		]) ?>
	<?php endif; ?>

	<h2 class="feedback-title text-center"><?= $this->title ?></h2>

	<?php if ($this->beginCache('__feedbackList', [
		'duration' => 3600*24,
		'variations'=>[
			Yii::$app->request->get('page'),
			Yii::$app->language,
		],
		'dependency'=>[
			'class' => 'yii\caching\DbDependency',
			'sql' => 'SELECT MAX(updated_at) FROM feedback',
		],
	])) { ?>
		<?= ListView::widget([
			'dataProvider'=>$provider,
			'itemView'=>'_itemView',
			'layout'=>"{items}\n{pager}",
			'pager'=>[
				'options'=>['class'=>'pagination pagination-sm'],
				'lastPageLabel'=>'>>',
				'firstPageLabel'=>'<<',
			],
		]) ?>

	<?php $this->endCache(); } ?>
</div>

<div class="send-feedback-btn">
	<?= Html::a(
		FeedbackModule::t('front', 'Оставить отзыв'),
		['/feedback/default/send-feedback'],
		['class'=>'btn btn-default fancybox fancybox.ajax']
	) ?>
</div>

<?php Fancybox::widget(); ?>