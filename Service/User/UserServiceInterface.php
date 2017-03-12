<?php
/**
 * Created by PhpStorm.
 * User: Popov
 * Date: 12.3.2017 г.
 * Time: 15:48
 */

namespace Service\User;


use Data\User\User;
use Data\User\UserRegisterViewData;

interface UserServiceInterface
{
    public function register(string $firstName,
                             string $lastName,
                             string $nickname,
                             string $email,
                             string $password,
                             string $confirmPassword,
                             string $phone,
                             \DateTime $birthday,
                             int $genderId,
                             int $sexualOrientation,
                             int $countryId,
                             int $cityId,
                             string $description = null,
                             string $pictureUrl = null);

    public function getRegisterViewData(): UserRegisterViewData;

    public function login($username, $password) : bool;

    public function findOne($id) : User;
}