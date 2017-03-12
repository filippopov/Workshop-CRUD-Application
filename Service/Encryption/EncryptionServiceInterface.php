<?php
/**
 * Created by PhpStorm.
 * User: Popov
 * Date: 12.3.2017 г.
 * Time: 15:40
 */

namespace Service\Encryption;


interface EncryptionServiceInterface
{
    public function encrypt($password) : string;

    public function isValid($passwordHash, $passwordString) : bool;
}