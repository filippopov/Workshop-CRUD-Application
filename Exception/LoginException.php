<?php
/**
 * Created by PhpStorm.
 * User: Popov
 * Date: 12.3.2017 г.
 * Time: 16:22
 */

namespace Exception;


use Exception;

class LoginException extends Exception
{
    public function __construct($message, $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}