<?php

namespace esp4ik\smssender;

use Yii;
use yii\base\Object;

class Message extends Object implements MessageInterface
{
    /**
     * @var string text message
     */
    private $text;

    /**
     * @var string phone number
     */
    private $to;

    /**
     * @var string phone or alphanumeric number
     */
    private $from;

    /**
     * @var SenderInterface
     */
    private $sender;

    /**
     * @param $text
     * @return $this
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param $to
     * @return $this
     */
    public function setTo($to)
    {
        $this->to = $to;

        return $this;
    }

    /**
     * @return string
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * @param $from
     * @return $this
     */
    public function setFrom($from)
    {
        $this->from = $from;

        return $this;
    }

    /**
     * @return string
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * @param SenderInterface $sender
     * @return $this
     */
    public function setSender(SenderInterface $sender)
    {
        $this->sender = $sender;

        return $this;
    }

    /**
     * @return SenderInterface
     */
    public function getSender()
    {
        return $this->sender;
    }

    /**
     * Sends this message
     *
     * @param SenderInterface|null $sender
     * @return bool
     */
    public function send(SenderInterface $sender = null)
    {
        if (!$sender instanceof SenderInterface && !$this->sender instanceof SenderInterface) {
            $sender = Yii::$app->get('smssender');
        } elseif (!$sender instanceof SenderInterface) {
            $sender = $this->sender;
        }

        return $sender->send($this);
    }

    /**
     * Magic method
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getText();
    }
}