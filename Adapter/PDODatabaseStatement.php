<?php
/**
 * Created by PhpStorm.
 * User: Popov
 * Date: 12.3.2017 г.
 * Time: 13:58
 */

namespace Adapter;


use PDO;
use PDOStatement;

class PDODatabaseStatement implements DatabaseStatementInterface
{
    /** @var  PDOStatement */
    private $statement;

    public function __construct(PDOStatement $statement)
    {
        $this->statement = $statement;
    }

    public function execute(array $params = [])
    {
        return $this->statement->execute($params);
    }

    public function fetchRow()
    {
        return $this->statement->fetch(PDO::FETCH_ASSOC);
    }

    public function fetchAll()
    {
        return $this->statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function fetchObject($className)
    {
        return $this->statement->fetchObject($className);
    }
}