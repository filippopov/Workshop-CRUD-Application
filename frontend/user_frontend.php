<?php /** @var $data \Data\Users\User */ ?>

    <center><img src="<?=$data->getPicture();?>" width="100" height="100"/></center>

    Message <?=$data->getNickname(); ?> now!!!!!!
    <br>
    <form method="post">
        <textarea name="message" rows="3" cols="30"></textarea>
        <input type="submit" name="send" value="Send!"/>
    </form>
    <hr>

    <div>
        First name: <?=$data->getFirstName(); ?>
    </div>
    <div>
        Last name: <?=$data->getLastName(); ?>
    </div>
    <div>
        Nickname: <?=$data->getNickname(); ?>
    </div>
<?php if($data->getPhone()): ?>
    <div>
        Phone: <?=$data->getPhone(); ?>
    </div>
<?php endif; ?>
<?php if($data->getDescription()): ?>
    <div>
        Description: <?=$data->getDescription(); ?>
    </div>
<?php endif; ?>