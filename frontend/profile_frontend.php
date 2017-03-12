<?php /** @var $data \Data\User\User */ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link  rel="stylesheet" type="text/css"  href="bootstrap.css"/>
    <title>Welcome to your profile</title>
</head>
<body>
<header>
    <a href="users.php">Find your best match</a> | <a href="logout.php">Logout!</a>
</header>
<div class="container">
    <h1>Welcome <?= $data->getFirstName(); ?>  <?= $data->getLastName(); ?></h1>
    <img src="<?=$data->getPicture();?>"/>
</div>
Unread Messages:
<table border="1" cellpadding="0" cellspacing="0">
    <thead>
    <tr>
        <th>Sender</th>
        <th>Message</th>
    </tr>
    </thead>
    <tbody>
    <?php if (! empty($data->getUnreadMessages)): ?>
        <?php foreach ($data->getUnreadMessages()->getMessages() as $message):?>
            <tr>
                <td><a href="user.php?id=<?=$message->getSenderId();?>">
                        <?= $message->getNickname(); ?>
                    </a></td>
                <td>
                    <a href="message.php?id=<?=$message->getId();?>">
                        <?=
                        strlen($message->getMessage()) > 20
                            ? substr($message->getMessage(), 0, 20) . '...'
                            : $message->getMessage(); ?>
                    </a>
                </td>
            </tr>
        <?php endforeach;?>
    <?php endif; ?>
    </tbody>
</table>
</body>