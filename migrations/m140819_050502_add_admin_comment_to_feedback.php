<?php

use yii\db\Migration;

class m140819_050502_add_admin_comment_to_feedback extends Migration
{
	public function safeUp()
	{
		$this->addColumn('feedback', 'admin_comment', 'tinyint(1) not null default 0');
		Yii::$app->cache->flush();

	}

	public function safeDown()
	{
		$this->dropColumn('feedback', 'admin_comment');
		Yii::$app->cache->flush();
	}
}
