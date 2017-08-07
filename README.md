# Yii2 Mailgun Mailer

Mailgun mailer for Yii 2 framework.

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist xutl/yii2-mailgun-mailer
```

or add

```
"xutl/yii2-mailgun-mailer": "~1.0.0"
```

to the require section of your `composer.json` file.



## Usage

Once the extension is installed, simply use it in your code by  :

```php
<?php
  'components' => [
      'mailer' => [
          'class' => 'xutl\mailgunmailer\Mailer',
          'domain' => 'example.com',
          'key' => 'key-somekey',
          'tags' => ['yii'],
          'enableTracking' => false,
      ],
  ],
?>
<?php
Yii::$app->mailer->compose('<view_name>', <option>)
->setFrom("<from email>")
->setTo("<to email>")
->setSubject("<subject>")
// ->setHtmlBody("<b> Hello User </b>")
// ->setTextBody("Hello User")
->send();
?>```


## Thx

https://github.com/mailgun/mailgun-php
https://github.com/katanyoo/yii2-mailgun-mailer
