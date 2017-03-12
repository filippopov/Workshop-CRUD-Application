<?php
/**
 * Created by PhpStorm.
 * User: Popov
 * Date: 12.3.2017 г.
 * Time: 18:54
 */

namespace Data\Message;


class UnreadMessagesViewData
{
    /** @var  Message[]\Generator */
    private $messages;

    /**
     * @return Message[]\Generator
     */
    public function getMessages()
    {
        return $this->messages;
    }

    /**
     * @param callable $messages
     */
    public function setMessages(callable $messages)
    {
        $this->messages = $messages;
    }


}