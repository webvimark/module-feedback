<?php

namespace webvimark\modules\feedback;

use Yii;

class FeedbackModule extends \yii\base\Module
{
	/**
	 * If feedback can be commented
	 *
	 * @var bool
	 */
	public $hasComments = true;

	public $controllerNamespace = 'webvimark\modules\feedback\controllers';

	public function init()
	{
		parent::init();
		$this->registerTranslations();
	}

	public function registerTranslations()
	{
		Yii::$app->i18n->translations['webvimark/modules/feedback/*'] = [
			'class'          => 'yii\i18n\PhpMessageSource',
			'sourceLanguage' => 'ru',
			'basePath'       => '@vendor/webvimark/module-feedback/messages',
			'fileMap'        => [
				'webvimark/modules/feedback/front' => 'front.php',
			],
		];
	}

	public static function t($category, $message, $params = [], $language = null)
	{
		return Yii::t('webvimark/modules/feedback/' . $category, $message, $params, $language);
	}
}
