<?php

use webvimark\modules\feedback\models\Feedback;
use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var webvimark\modules\feedback\models\Feedback $model
 */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Отзывы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="feedback-view">


	<div class="panel panel-default">
		<div class="panel-heading">
			<strong>
				<span class="glyphicon glyphicon-th"></span> <?= Html::encode($this->title) ?>
			</strong>
		</div>
		<div class="panel-body">

			<p>
				<?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-sm btn-primary']) ?>
				<?= Html::a('Создать', ['create'], ['class' => 'btn btn-sm btn-success']) ?>
				<?= Html::a('Удалить', ['delete', 'id' => $model->id], [
					'class' => 'btn btn-sm btn-danger pull-right',
					'data' => [
						'confirm' => 'Вы уверены, что хотите удалить этот элемент?',
						'method' => 'post',
					],
				]) ?>
			</p>

			<?= DetailView::widget([
				'model' => $model,
				'attributes' => [
					'id',
					[
						'attribute'=>'status',
						'value'=>Feedback::getStatusValue($model->status),
						'format'=>'raw',
					],
					[
						'attribute'=>'admin_comment',
						'value'=>Feedback::getAdminCommentValue($model->admin_comment),
						'format'=>'raw',
					],
					'title',
					'body:ntext',
					'created_at:datetime',
					'updated_at:datetime',
				],
			]) ?>

		</div>
	</div>
</div>
