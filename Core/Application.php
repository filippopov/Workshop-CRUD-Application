<?php
/**
 * Created by PhpStorm.
 * User: Popov
 * Date: 12.3.2017 г.
 * Time: 14:08
 */

namespace Core;


class Application
{
    CONST FRONTEND_FOLDER = 'frontend';

    public function loadTemplate($templateName, $data = null) {
        include self::FRONTEND_FOLDER . '/' . $templateName . '.php';
    }

    public function checkLogin() {
        if (! isset($_SESSION['user_id'])) {
            header('Location: login.php');
            exit;
        }
    }
}