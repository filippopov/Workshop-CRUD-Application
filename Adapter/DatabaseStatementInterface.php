<?php
/**
 * Created by PhpStorm.
 * User: Popov
 * Date: 12.3.2017 г.
 * Time: 13:40
 */

namespace Adapter;


interface DatabaseStatementInterface
{
    public function execute(array $params = []);

    public function fetchRow();

    public function fetchAll();

    public function fetchObject($className);
}