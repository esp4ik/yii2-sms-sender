<?php

namespace esp4ik\smssender\senders;

use esp4ik\smssender\MessageInterface;
use esp4ik\smssender\Sender;
use yii\base\InvalidConfigException;
use yii\httpclient\Client;
use yii\httpclient\Response;

/**
 * RocketSMS.by
 *
 * Class RocketSms
 * @package esp4ik\smssender\senders
 */
class RocketSms extends Sender
{
    /**
     * @var string username
     */
    public $username = null;

    /**
     * @var string password
     */
    public $password = null;

    /**
     * @var bool
     */
    public $priority = true;

    /**
     * RocketSms constructor.
     * @param array $config
     * @throws InvalidConfigException
     */
    public function __construct(array $config = [])
    {
        parent::__construct($config);

        if ($this->username === null) {
            $class = self::className();
            throw new InvalidConfigException("Property {$class}::username must be specified");
        }

        if ($this->password === null) {
            $class = self::className();
            throw new InvalidConfigException("Property {$class}::password must be specified");
        }
    }

    /**
     * Returns RocketSMS API url
     *
     * @return string
     */
    protected function getSendMessageApiUrl()
    {
        return 'http://api.rocketsms.by/json/send';
    }

    /**
     * @param MessageInterface $message
     * @return boolean
     */
    public function send(MessageInterface $message)
    {
        $data = [
            'username' => $this->username,
            'password' => md5($this->password),
            'phone' => $message->getTo(),
            'text' => $message->getText(),
            'priority' => (bool) $this->priority,
        ];

        $from = $message->getFrom();

        if (!empty($from)) {
            $data['sender'] = $from;
        }

        $client = new Client();

        /** @var Response $response */
        $response = $client->createRequest()
            ->setMethod('post')
            ->setUrl($this->getSendMessageApiUrl())
            ->setData($data)
            ->send();

        if (!$response->getIsOk()) {
            return false;
        }

        return isset($response->getData()['id']);
    }
}