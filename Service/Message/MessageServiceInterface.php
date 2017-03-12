<?php
/**
 * Created by PhpStorm.
 * User: Popov
 * Date: 12.3.2017 г.
 * Time: 22:50
 */

namespace Service\Message;


use Data\Message\Message;
use Data\Message\UnreadMessagesViewData;

interface MessageServiceInterface
{
    public function send($formId, $toId, $message);

    public function getNewMessage($recipientId) : UnreadMessagesViewData;

    public function findOne($id, $recipientId): Message;

    public function getSentMessage($senderId);
}