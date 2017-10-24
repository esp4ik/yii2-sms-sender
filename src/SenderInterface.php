<?php

namespace esp4ik\smssender;

/**
 * Interface SenderInterface
 * @package esp4ik\smssender
 */
interface SenderInterface
{
    /**
     * Creates message
     *
     * @return MessageInterface
     */
    public function createMessage();

    /**
     * Sends one message
     *
     * @param MessageInterface $message
     * @return bool whether the message has been sent successfully
     */
    public function send(MessageInterface $message);

    /**
     * Sends multiple messages
     *
     * @param array $messages
     * @return bool number of messages that are successfully sent.
     */
    public function sendMultiple(array $messages);
}