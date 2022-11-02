<?php

namespace App\Model;

use PDO;
use App\Entity\session;

class SessionManager extends AbstractManager
{
    public const TABLE = 'session';
    public const ID = 'id';
    /**
     * Insert new item in database
     */


    public function update($id)
    {

        // set all session where status is true to false
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE .
            " SET `status` = 0
         WHERE status=1");
        $statement->execute();
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE .
            " SET `status` = 1,
         WHERE id=:id");
        $statement->bindValue('id', $id, PDO::PARAM_INT);
        setcookie(
            'session_id',
            $id,
            time() + 365 * 24 * 3600,
            '/',
        );


        return $statement->execute();
    }
}
