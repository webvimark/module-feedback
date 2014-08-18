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
			[['status', 'parent_id', 'created_at', 'updated_at'], 'integer'],
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
