<?php

namespace xutl\mailgunmailer;

use Yii;
use yii\base\InvalidConfigException;
use yii\mail\BaseMailer;
use Mailgun\Mailgun;

/**
 * Mailer implements a mailer based on Mailgun.
 *
 * To use Mailer, you should configure it in the application configuration like the following,
 *
 * ~~~
 * 'components' => [
 *     ...
 *     'mailer' => [
 *         'class' => 'xutl\mailgunmailer\Mailer',
 *         'domain' => 'example.com',
 *         'key' => 'key-somekey',
 *         'tags' => ['yii'],
 *         'enableTracking' => false,
 *     ],
 *     ...
 * ],
 * ~~~
 */
class Mailer extends BaseMailer
{

    /**
     * [$messageClass description]
     * @var string message default class name.
     */
    public $messageClass = 'xutl\mailgunmailer\Message';

    public $domain;
    public $key;

    public $fromAddress;
    public $fromName;
    public $tags = [];
    public $campaignId;
    public $enableDkim;

    public $enableTestMode;

    public $enableTracking;
    /**
     * @var bool 是否开启点击跟踪
     */
    public $clicksTrackingMode; // true, false, "html"

    /**
     * @var bool 是否开启打开跟踪
     */
    public $enableOpensTracking;

    private $_mailgunMailer;

    /**
     * @return Mailgun Mailgun mailer instance.
     */
    public function getMailgunMailer()
    {
        if (!is_object($this->_mailgunMailer)) {
            $this->_mailgunMailer = new Mailgun($this->key);
        }

        return $this->_mailgunMailer;
    }

    /**
     * @param Message $message
     * @return bool
     */
    protected function sendMessage($message)
    {
        $message->setClickTracking($this->clicksTrackingMode)->addTags($this->tags);

        Yii::info('Sending email', __METHOD__);
        $response = $this->getMailgunMailer()->post(
            "{$this->domain}/messages",
            $message->getMessage(),
            $message->getFiles()
        );

        Yii::info('Response : ' . print_r($response, true), __METHOD__);
        return true;
    }
}
