<?php

use webvimark\modules\feedback\models\Feedback;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;
use webvimark\extensions\GridBulkActions\GridBulkActions;
use webvimark\extensions\GridPageSize\GridPageSize;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var webvimark\modules\feedback\models\search\FeedbackSearch $searchModel
 */

$this->title = 'Отзывы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="feedback-index">

	<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

	<div class="panel panel-default">
		<div class="panel-heading">
			<strong>
				<span class="glyphicon glyphicon-th"></span>  <?= Html::encode($this->title) ?>
			</strong>

			<?= GridPageSize::widget(['pjaxId'=>'feedback-grid-pjax']) ?>
		</div>

		<div class="panel-body">

			<div class="row">
				<div class="col-sm-6">
					<p>
						<?= Html::a('<span class="glyphicon glyphicon-plus-sign"></span> ' . 'Создать', ['create'], ['class' => 'btn btn-sm btn-success']) ?>
					</p>
				</div>

				<div class="col-sm-6 text-right">
					<?= GridBulkActions::widget([
						'gridId'=>'feedback-grid',
						'actions'=>[
							Url::to(['bulk-approve'])=>'Одобрить',
							Url::to(['bulk-set-as-pending'])=>'Перевести в ожидающие',
							Url::to(['bulk-deny'])=>'Отклонить',
							'----'=>[
								Url::to(['bulk-delete'])=>'Удалить',
							],
						],
					]) ?>
				</div>
			</div>


			<?php Pjax::begin([
				'id'=>'feedback-grid-pjax',
			]) ?>

			<?= GridView::widget([
				'id'=>'feedback-grid',
				'dataProvider' => $dataProvider,
				'pager'=>[
					'options'=>['class'=>'pagination pagination-sm'],
					'hideOnSinglePage'=>true,
					'lastPageLabel'=>'>>',
					'firstPageLabel'=>'<<',
				],
				'layout'=>'{items}<div class="row"><div class="col-sm-8">{pager}</div><div class="col-sm-4 text-right">{summary}</div></div>',
				'filterModel' => $searchModel,
				'columns' => [
					['class' => 'yii\grid\SerialColumn', 'options'=>['style'=>'width:10px'] ],

					[
						'attribute'=>'name',
						'value'=>function($model){
								return Html::a($model->name, ['update', 'id'=>$model->id], ['data-pjax'=>0]);
							},
						'format'=>'raw',
					],
					'title',

					[
						'attribute'=>'parent_id',
						'label'=>'Комментарий',
						'filter'=>false,
						'value'=>function($model){
								if ( $model->parent_id === null )
								{
									return 'Отзыв';
								}
								else
								{
									return 'Комментарий к ' . Html::a(
										$model->parent_id,
										['view', 'id'=>$model->parent_id],
										[
											'target'=>'_blank',
											'data-pjax'=>0,
										]
									);
								}
							},
						'format'=>'raw',
					],
					'created_at:datetime',

					[
						'class'=>'webvimark\components\StatusColumn',
						'attribute'=>'admin_comment',
					],
					[
						'attribute'=>'status',
						'filter'=>Feedback::getStatusList(),
						'value'=>function($model){
								return Feedback::getStatusValue($model->status);
							},
						'format'=>'raw',
						'contentOptions'=>[
							'style'=>'width:120px; text-align:center;'
						],
					],

					['class' => 'yii\grid\CheckboxColumn', 'options'=>['style'=>'width:10px'] ],
					[
						'class' => 'yii\grid\ActionColumn',
						'contentOptions'=>['style'=>'width:70px; text-align:center;'],
					],
				],
			]); ?>
		
			<?php Pjax::end() ?>
		</div>
	</div>
</div>
