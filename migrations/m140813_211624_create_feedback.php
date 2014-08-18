<?php

use yii\db\Migration;

class m140813_211624_create_feedback extends Migration
{
	public function safeUp()
	{
		$tableOptions = null;
		if ( $this->db->driverName === 'mysql' )
		{
			$tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
		}

		$this->createTable('feedback', array(
			'id'         => 'pk',
			'status'     => 'int(1) not null default 0',
			'parent_id'  => 'int',
			'name'       => 'string not null',
			'title'      => 'string not null',
			'body'       => 'text not null',
			'created_at' => 'int not null',
			'updated_at' => 'int not null',
		), $tableOptions);

		$this->addForeignKey('fk_feedback_parent_id', 'feedback', 'parent_id', 'feedback', 'id', 'CASCADE', 'CASCADE');


	}

	public function safeDown()
	{
		$this->dropForeignKey('fk_feedback_parent_id', 'feedback');

		$this->dropTable('feedback');

	}
}
