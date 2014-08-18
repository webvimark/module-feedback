Feedback module for Yii 2
=====


Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist webvimark/module-feedback "*"
```

or add

```
"webvimark/module-feedback": "*"
```

to the require section of your `composer.json` file.

Configuration
-------------

In your config/web.php

```php
	'modules'=>[
		...

		'feedback' => [
			'class' => 'webvimark\modules\feedback\FeedbackModule',
		],

		...
	],
```


Usage
-----

1 Go to http://site.com/feedback/feedback/index

2 Go to http://site.com/feedback/default/index
