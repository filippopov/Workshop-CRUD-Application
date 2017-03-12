<?php
require_once 'app.php';

if (isset($_POST['login'])) {
    $userService = new \Service\User\UserService($db, $encryptionService);
    $username = $_POST['nickname'];
    $password = $_POST['password'];

    if (!$userService->login($username, $password)) {
        throw new \Exception\LoginException("Password mismatch!");
    }

    header("Location: profile.php");
    exit;
}

$viewData = new \Data\User\UserLoginViewData();
if (isset($_SESSION['error'])) {
    $error = $_SESSION['error'];
    unset($_SESSION['error']);
    $viewData = new \Data\User\UserLoginViewData($error);
}
$app->loadTemplate('login_frontend', $viewData);