<?php /** @var $data \Data\User\UserRegisterViewData */ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link  rel="stylesheet" type="text/css"  href="bootstrap.css"/>
    <title>Register in our brand new sex site</title>
</head>
<body>

<div class="container">
    <?php if (!empty($result)): ?>
        <h1> <?= $result; ?></h1>
    <?php endif; ?>
    <div class="bs-component">
        <form method="post" enctype="multipart/form-data" class="form-horizontal">
            <fieldset>
                <legend>Register</legend>
                <div class="form-group">
                    <label for="firstName" class="col-lg-2 control-label">First name</label>
                    <div class="col-lg-10">
                        <input class="form-control" name="firstName" id="firstName" placeholder="First name" type="text">
                    </div>
                </div>
                <div class="form-group">
                    <label for="lastName" class="col-lg-2 control-label">Last name</label>
                    <div class="col-lg-10">
                        <input class="form-control" name="lastName" id="lastName" placeholder="Last name" type="text">
                    </div>
                </div>
                <div class="form-group">
                    <label for="nickname" class="col-lg-2 control-label">Nickname</label>
                    <div class="col-lg-10">
                        <input class="form-control" name="nickname" id="nickname" placeholder="Nickname" type="text">
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="col-lg-2 control-label">Email</label>
                    <div class="col-lg-10">
                        <input class="form-control" name="email" id="email" placeholder="Email" type="email">
                    </div>
                </div>
                <div class="form-group">
                    <label for="phone" class="col-lg-2 control-label">Telephone</label>
                    <div class="col-lg-10">
                        <input class="form-control" name="phone" id="phone" placeholder="Phone" type="tel">
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="col-lg-2 control-label">Password</label>
                    <div class="col-lg-10">
                        <input class="form-control" name="password" id="password" placeholder="Password" type="password">
                    </div>
                </div>
                <div class="form-group">
                    <label for="confirm" class="col-lg-2 control-label">Confirm password</label>
                    <div class="col-lg-10">
                        <input class="form-control" name="confirm" id="confirm" placeholder="Confirm password" type="password">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label">Gender</label>
                    <div class="col-lg-10">
                        <?php foreach ($data->getGenders() as $gender): ?>
                        <div class="radio">
                            <label>
                                <input name="gender" id="gender" value="<?=$gender->getId();?>" type="radio">
                                <?= $gender->getName(); ?>
                            </label>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="birthday" class="col-lg-2 control-label">Birthday</label>
                    <div class="col-lg-10">
                        <input class="form-control" name="birthday" id="birthday" placeholder="birthday" type="date">
                    </div>
                </div>
                <div class="form-group">
                    <label for="orientation" class="col-lg-2 control-label">Sexual orientation</label>
                    <div class="col-lg-10">
                        <select name="orientation" class="form-control" id="orientation">
                            <?php foreach ($data->getOrientations() as $orientation): ?>
                                <option value="<?=$orientation->getId();?>">
                                    <?= $orientation->getName(); ?>
                                </option>
                            <?php endforeach;?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="country" class="col-lg-2 control-label">Country</label>
                    <div class="col-lg-10">
                        <select name="country" class="form-control" id="country">
                            <?php foreach ($data->getCountries() as $country): ?>
                                <option value="<?=$country->getId();?>">
                                    <?= $country->getName(); ?>
                                </option>
                            <?php endforeach;?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="city" class="col-lg-2 control-label">City</label>
                    <div class="col-lg-10">
                        <select name="city" class="form-control" id="city">
                            <?php foreach ($data->getCities() as $city): ?>
                                <option value="<?=$city->getId();?>">
                                    <?= $city->getName(); ?>
                                </option>
                            <?php endforeach;?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="avatar" class="col-lg-2 control-label">Avatar</label>
                    <div class="col-lg-10">
                        <input name="avatar" id="avatar" placeholder="Avatar" type="file">
                    </div>
                </div>
                <div class="form-group">
                    <label for="description" class="col-lg-2 control-label">Description</label>
                    <div class="col-lg-10">
                        <textarea class="form-control" rows="3" name="description" id="description"></textarea>
                        <span class="help-block">Describe yourself for better findings</span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-10 col-lg-offset-2">
                        <button type="reset" class="btn btn-default">Cancel</button>
                        <button type="submit" name="register" class="btn btn-primary">Register</button>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</div>
</body>
</html>
