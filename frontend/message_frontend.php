<?php /** @var $data \Data\Message\Message */ ?>

<hr>
<h3><?= $data->getMessage(); ?></h3>
<hr>
<h5>From: <a href="user.php?id=<?=$data->getSenderId();?>">
        <?=$data->getNickname(); ?>
    </a></h5>

<hr>
<form method="post" action="user.php?id=<?=$data->getSenderId();?>">
    <textarea name="message" rows="3" cols="30"></textarea>
    <input type="submit" name="send" value="Send!"/>
</form>