<?php /** @var $data \Data\User\UserLoginViewData */ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link  rel="stylesheet" type="text/css"  href="bootstrap.css"/>
    <title>Login to the sex</title>
</head>
<body>
<div class="container">
    <?php if($data->getError()) :?>
        <h1><?=$data->getError(); ?></h1>
    <?php endif; ?>
    <div class="bs-component">
        <form method="post" class="form-horizontal">
            <fieldset>
                <legend>Login</legend>
                <div class="form-group">
                    <label for="nickname" class="col-lg-2 control-label">Nickname</label>
                    <div class="col-lg-10">
                        <input class="form-control" name="nickname" id="nickname" placeholder="Nickname" type="text">
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="col-lg-2 control-label">Password</label>
                    <div class="col-lg-10">
                        <input class="form-control" name="password" id="password" placeholder="Password" type="password">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-10 col-lg-offset-2">
                        <button type="reset" class="btn btn-default">Cancel</button>
                        <button type="submit" name="login" class="btn btn-primary">Login</button>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</div>
</body>