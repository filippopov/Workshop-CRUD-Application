<?php
/**
 * Created by PhpStorm.
 * User: Popov
 * Date: 12.3.2017 г.
 * Time: 13:39
 */

namespace Adapter;


interface DatabaseInterface
{
    public function prepare($sql): DatabaseStatementInterface;

    public function lastId();

    public function errorInfo();
}