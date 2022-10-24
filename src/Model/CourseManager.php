<?php

namespace App\Model;

use PDO;

class CourseManager extends AbstractManager
{
    public const TABLE = 'tbl_course';

    /**
     * Insert new item in database
     */
    public function insert(array $course): int
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (`title`) VALUES (:title)");
        $statement->bindValue('title', $course['title'], PDO::PARAM_STR);

        $statement->execute();
        return (int)$this->pdo->lastInsertId();
    }

    /**
     * Update item in database
     */
    public function update(array $course): bool
    {
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE . " SET `title` = :title WHERE cid=:id");
        $statement->bindValue('id', $course['id'], PDO::PARAM_INT);
        $statement->bindValue('title', $course['title'], PDO::PARAM_STR);

        return $statement->execute();
    }
}
