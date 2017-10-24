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
     * @return void
     */
    public function setText($text);

    /**
     * @return string
     */
    public function getTo();

    /**
     * @param $to
     * @return void
     */
    public function setTo($to);

    /**
     * @return string
     */
    public function getFrom();

    /**
     * @param $from
     * @return void
     */
    public function setFrom($from);

    /**
     * @return SenderInterface
     */
    public function getSender();

    /**
     * @param SenderInterface $sender
     * @return void
     */
    public function setSender(SenderInterface $sender);

    /**
     * @param SenderInterface|null $sender
     * @return mixed
     */
    public function send(SenderInterface $sender = null);
}