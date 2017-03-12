<?php
/**
 * Created by PhpStorm.
 * User: Popov
 * Date: 12.3.2017 г.
 * Time: 19:08
 */

namespace Data\User;


class UserLoginViewData
{
    private $error = null;

    public function __construct($error = null)
    {
        $this->error = $error;
    }

    /**
     * @return null
     */
    public function getError()
    {
        return $this->error;
    }
}