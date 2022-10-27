<?php

namespace App\Model;

use PDO;

class SubjectManager extends AbstractManager
{
    public const TABLE = 'subject';
    public const ID = 'subid';
    /**
     * Insert new item in database
     */
    public function insert(array $subject): int
    {

        $temps = time();
        $today = date('Y-m-d', $temps);
        $cshortAndCfull = $subject['cshort'];
        $cshortAndCfull = explode(':', $cshortAndCfull);
        $cshort = $cshortAndCfull[0];
        $cfull = $cshortAndCfull[1];
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE .
            " (`cfull`, `cshort`, `sub1`,`sub2`, `sub3`,`dt_created`,`update_date`) VALUES
             (:cfull, :cshort,:sub1,:sub2,:sub3 ,:dt_created,:update_date)");
        $statement->bindValue('cfull', $cfull, PDO::PARAM_STR);
        $statement->bindValue('cshort', $cshort, PDO::PARAM_STR);
        $statement->bindValue('sub1', $subject['sub1'], PDO::PARAM_STR);
        $statement->bindValue('sub2', $subject['sub2'], PDO::PARAM_STR);
        $statement->bindValue('sub3', $today, PDO::PARAM_STR);
        $statement->bindValue('dt_created', $today, PDO::PARAM_STR);
        $statement->bindValue('update_date', $today, PDO::PARAM_STR);
        $statement->execute();
        return (int)$this->pdo->lastInsertId();
    }


    /**
     * Update item in database
     */
    public function update(array $subject)
    {
        $temps = time();
        $today = date('Y-m-d', $temps);
        $cshortAndCfull = $subject['cshort'];
        $cshortAndCfull = explode(':', $cshortAndCfull);
        $cshort = $cshortAndCfull[0];
        $cfull = $cshortAndCfull[1];
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE .
            " SET `cfull` = :cfull,
             `cshort` = :cshort,
             `sub1`=:sub1,
            `sub2`=:sub2,
            `sub3`=:sub3,
            `update_date`=:update_date
             WHERE subid=:subid");

        $statement->bindValue('subid', $subject['subid'], PDO::PARAM_INT);
        $statement->bindValue('cfull', $cfull, PDO::PARAM_STR);
        $statement->bindValue('cshort', $cshort, PDO::PARAM_STR);
        $statement->bindValue('sub1', $subject['sub1'], PDO::PARAM_STR);
        $statement->bindValue('sub2', $subject['sub2'], PDO::PARAM_STR);
        $statement->bindValue('sub3', $subject['sub3'], PDO::PARAM_STR);
        $statement->bindValue('update_date', $today, PDO::PARAM_STR);
        return $statement->execute();
    }
}
