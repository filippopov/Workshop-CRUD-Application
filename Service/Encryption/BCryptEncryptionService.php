<?php
/**
 * Created by PhpStorm.
 * User: Popov
 * Date: 12.3.2017 г.
 * Time: 15:42
 */

namespace Service\Encryption;


class BCryptEncryptionService implements EncryptionServiceInterface
{
    public function encrypt($password): string
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    public function isValid($passwordString, $passwordHash): bool
    {
        return password_verify($passwordString, $passwordHash);
    }
}