<?php

namespace App\Model;

use PDO;
use App\Entity\Course;

class CourseManager extends AbstractManager
{
    public const TABLE = 'tbl_course';
    public const ID = 'cid';
    /**
     * Insert new item in database
     */
    public function insert(array $course): int
    {
        $temps = time();
        $today = date('Y-m-d', $temps);

        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE .
            " (`cfull`, `cshort`,`cdate`, `update_date`) VALUES (:cfull, :cshort,:cdate,:update_date)");
        $statement->bindValue('cfull', $course['cfull'], PDO::PARAM_STR);
        $statement->bindValue('cshort', $course['cshort'], PDO::PARAM_STR);
        $statement->bindValue('cdate', $course['cdate'], PDO::PARAM_STR);
        $statement->bindValue('update_date', $today, PDO::PARAM_STR);
        $statement->execute();
        return (int)$this->pdo->lastInsertId();
    }


    /**
     * Update item in database
     */
    public function update(array $course)
    {
        $temps = time();
        $today = date('Y-m-d', $temps);
        var_dump($course);
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE .
            " SET `cfull` = :cfull,
         `cshort` = :cshort,
         `cdate` = :cdate,
         `update_date` = :update_date
         WHERE cid=:cid");
        $statement->bindValue('cid', $course['cid'], PDO::PARAM_INT);
        $statement->bindValue('cfull', $course['cfull'], PDO::PARAM_STR);
        $statement->bindValue('cshort', $course['cshort'], PDO::PARAM_STR);
        $statement->bindValue('cdate', $course['cdate'], PDO::PARAM_STR);
        $statement->bindValue('update_date', $today, PDO::PARAM_STR);
        return $statement->execute();
    }
}
