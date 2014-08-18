<?php
/**
 * @var $this yii\web\View
 * @var $provider ActiveDataProvider
 */
use yii\data\ActiveDataProvider;
use yii\widgets\ListView;

?>

<div class="feedback-list">
	<?= ListView::widget([
		'dataProvider'=>$provider,
		'itemView'=>'_itemView',
	]) ?>
</div>
