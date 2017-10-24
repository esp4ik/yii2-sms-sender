<?php

namespace esp4ik\smssender;

use Yii;
use yii\base\Component;

abstract class Sender extends Component implements SenderInterface
{
    /**
     * @var string message class
     */
    public $messageClass = 'esp4ik\smssender\Message';

    /**
     * @var array message config
     */
    public $messageConfig = [];

    /**
     * @return MessageInterface|object
     */
    public function createMessage()
    {
        $config = $this->messageConfig;

        if (!array_key_exists('class', $config)) {
            $config['class'] = $this->messageClass;
        }

        $config['sender'] = $this;

        return Yii::createObject($config);
    }

    /**
     * @param array $messages
     * @return int
     */
    public function sendMultiple(array $messages)
    {
        $sentCount = 0;

        foreach ($messages as $message) {
            if ($this->send($message)) {
                $sentCount++;
            }
        }

        return $sentCount;
    }
}