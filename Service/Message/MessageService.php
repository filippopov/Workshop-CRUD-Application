<?php
/**
 * Created by PhpStorm.
 * User: Popov
 * Date: 12.3.2017 г.
 * Time: 22:52
 */

namespace Service\Message;


use Adapter\DatabaseInterface;
use Data\Message\Message;
use Data\Message\UnreadMessagesViewData;

class MessageService implements MessageServiceInterface
{
    private $db;

    public function __construct(DatabaseInterface $db)
    {
        $this->db = $db;
    }

    public function send($formId, $toId, $message)
    {
        $query = "
            INSERT INTO messages
            SET 
              sender_id = ?,
              recipient_id = ?,
              message = ?
        ";

        $stmt = $this->db->prepare($query);
        $stmt->execute([
            $formId,
            $toId,
            $message
        ]);
    }

    public function getNewMessage($recipientId) : UnreadMessagesViewData
    {
        $query = "
            SELECT
                messages.id,
                senders.id AS senderId,
                senders.nickname,
                messages.message
            FROM
                messages
            INNER JOIN 
                people AS senders ON (senders.id = messages.sender_id)
            WHERE 
                messages.recipient_id = ?
                AND is_read = 0
        ";

        $stmt = $this->db->prepare($query);
        $stmt->execute([$recipientId]);

        $messagesViewData = new UnreadMessagesViewData();
        $messagesViewData->setMessages(
            function () use ($stmt) {
                while ($message = $stmt->fetchObject(Message::class)) {
                    yield $message;
                }
            }
        );

        return $messagesViewData;
    }

    public function findOne($id, $recipientId): Message
    {
        $query = "SELECT
               messages.id,
               senders.id AS senderId,
               senders.nickname,
               messages.message
            FROM
               messages
            INNER JOIN
               people AS senders
            ON
               senders.id = messages.sender_id
            WHERE
               messages.id = ? AND 
               messages.recipient_id = ? AND 
               messages.is_read = 0 AND 
               messages.deleted_on IS NULL
              ";

        $stmt = $this->db->prepare($query);
        $stmt->execute([$id, $recipientId]);

        $message = $stmt->fetchObject(Message::class);

        $stmt = $this->db->prepare("UPDATE messages SET is_read = 1 WHERE id = ?");
        $stmt->execute([$id]);

        return $message;
    }

    public function getSentMessage($senderId)
    {
        $query = "
            SELECT
               messages.id,
               senders.id AS senderId,
               senders.nickname,
               messages.message
            FROM
               messages
            INNER JOIN
               people AS senders
            ON
               senders.id = messages.sender_id
            WHERE
               messages.sender_id = ? AND
               is_read = 0
        ";

        $stmt = $this->db->prepare($query);
        $stmt->execute([$senderId]);

        $messagesViewData = new UnreadMessagesViewData();

        $messagesViewData->setMessages(
            function () use ($stmt) {
                while ($message = $stmt->fetchObject(Message::class)) {
                    yield $message;
                }
            }
        );

        return $messagesViewData;
    }
}