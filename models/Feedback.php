<?php

namespace webvimark\modules\feedback\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "feedback".
 *
 * @property integer $id
 * @property integer $status
 * @property integer $parent_id
 * @property integer $admin_comment
 * @property string $name
 * @property string $title
 * @property string $body
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Feedback $parent
 * @property Feedback[] $feedbacks
 */
class Feedback extends \webvimark\components\BaseActiveRecord
{
	const STATUS_DENIED = -1;
	const STATUS_PENDING = 0;
	const STATUS_APPROVED = 1;

	/**
	 * getStatusList
	 *
	 * @param bool $withSpan
	 *
	 * @return array
	 */
	public static function getStatusList($withSpan = false)
	{
		if ( $withSpan )
		{
			return [
				static::STATUS_DENIED => '<span class="label label-danger">Отклонено</span>',
				static::STATUS_PENDING => '<span class="label label-default">Ожидает</span>',
				static::STATUS_APPROVED=> '<span class="label label-success">Одобрено</span>',
			];
		}
		else
		{
			return [
				static::STATUS_DENIED => 'Отклонено',
				static::STATUS_PENDING => 'Ожидает',
				static::STATUS_APPROVED=> 'Одобрено',
			];
		}

	}

	/**
	 * getStatusValue
	 *
	 * @param string $val
	 *
	 * @return string
	 */
	public static function getStatusValue($val)
	{
		$ar = self::getStatusList(true);

		return isset( $ar[$val] ) ? $ar[$val] : $val;
	}

	/**
	 * getAdminCommentList
	 *
	 * @param $withSpan
	 *
	 * @return array
	 */
	public static function getAdminCommentList($withSpan = false)
	{
		if ( $withSpan )
		{
			return [
				0 => '<span class="label label-warning">Нет</span>',
				1=> '<span class="label label-success">Да</span>',
			];
		}
		else
		{
			return [
				0 => 'Нет',
				1 => 'Да',
			];
		}
	}

	/**
	 * getAdminCommentValue
	 *
	 * @param string $val
	 *
	 * @return string
	 */
	public static function getAdminCommentValue($val)
	{
		$ar = self::getAdminCommentList(true);

		return isset( $ar[$val] ) ? $ar[$val] : $val;
	}


	/**
	* @inheritdoc
	*/
	public static function tableName()
	{
		return 'feedback';
	}

	/**
	* @inheritdoc
	*/
	public function behaviors()
	{
		return [
			TimestampBehavior::className(),
		];
	}

	/**
	* @inheritdoc
	*/
	public function rules()
	{
		return [
			[['status', 'parent_id', 'admin_comment', 'created_at', 'updated_at'], 'integer'],
			[['name', 'title', 'body'], 'required'],
			[['body'], 'string'],
			[['name', 'title'], 'string', 'max' => 50]
		];
	}

	/**
	* @inheritdoc
	*/
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'status' => 'Статус',
			'parent_id' => 'Parent ID',
			'name' => 'Автор',
			'title' => 'Название',
			'admin_comment' => 'От админа',
			'body' => 'Текст',
			'created_at' => 'Создано',
			'updated_at' => 'Обновлено',
		];
	}

	/**
	* @return \yii\db\ActiveQuery
	*/
	public function getParent()
	{
		return $this->hasOne(Feedback::className(), ['id' => 'parent_id']);
	}

	/**
	* @return \yii\db\ActiveQuery
	*/
	public function getFeedbacks()
	{
		return $this->hasMany(Feedback::className(), ['parent_id' => 'id']);
	}
}
