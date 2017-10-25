<?php

namespace esp4ik\smssender;

/**
 * Interface MessageInterface
 * @package esp4ik\smssender
 */
interface MessageInterface
{
    /**
     * @return string
     */
    public function getText();

    /**
     * @param $text
     * @return $this
     */
    public function setText($text);

    /**
     * @return string
     */
    public function getTo();

    /**
     * @param $to
     * @return $this
     */
    public function setTo($to);

    /**
     * @return string
     */
    public function getFrom();

    /**
     * @param $from
     * @return $this
     */
    public function setFrom($from);

    /**
     * @return SenderInterface
     */
    public function getSender();

    /**
     * @param SenderInterface $sender
     * @return $this
     */
    public function setSender(SenderInterface $sender);

    /**
     * @param SenderInterface|null $sender
     * @return bool
     */
    public function send(SenderInterface $sender = null);
}