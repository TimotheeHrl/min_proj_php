<?php

namespace App\Model;

use PDO;

class AdminManager extends AbstractManager
{

    public const TABLE = 'tbl_login';

    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    public function selectOneByLogin(string $loginid): array
    {
        $statement = $this->pdo->prepare("SELECT * FROM " . self::TABLE . " WHERE loginid=:loginid");
        $statement->bindValue('loginid', $loginid, PDO::PARAM_STR);
        $statement->execute();
        return $statement->fetch();
    }
    public function selectOneByLoginAndPassword(string $loginid, string $password): array
    {
        $statement = $this->pdo->prepare("SELECT * FROM " . self::TABLE . " WHERE loginid=:loginid AND password=:password");
        $statement->bindValue('loginid', $loginid, PDO::PARAM_STR);
        $statement->bindValue('password', $password, PDO::PARAM_STR);
        $statement->execute();
        return $statement->fetch();
    }
    public function selectOneById(int $id): array
    {
        $statement = $this->pdo->prepare("SELECT * FROM " . self::TABLE . " WHERE id=:id");
        $statement->bindValue('id', $id, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetch();
    }
}
