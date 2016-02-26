# yii2-nepali-datepicker
fullcalendar yii2 widget

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist tejrajs/yii2-nepali-datepicker "dev-master"
```

or add

```
"tejrajs/yii2-nepali-datepicker": "dev-master"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by  :

```php 
<?php
use tejrajs\datepicker\NepaliDatepicker;
?>
<?= NepaliDatepicker::widget([
	'name' => 'Test',
	'value' => '02-16-2012',
	'template' => '{addon}{input}',
        'clientOptions' => [
            'autoclose' => true,
            'onFocus' => false,
        ]
]);?>
OR
<?= $form->field($model, 'date')->widget(\tejrajs\datepicker\NepaliDatepicker::className(),[
           		'clientOptions' => [
					'autoclose' => true,
              				'onFocus' => false,
               				'ndpTriggerButton' => true,
               				'ndpTriggerButtonText' => 'Date',
              				'ndpTriggerButtonClass' => 'btn btn-primary btn-sm'
               		]
]) ?>
```
