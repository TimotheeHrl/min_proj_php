<?php

namespace App\Model;

use PDO;

class RegistrationManager extends AbstractManager
{
    public const TABLE = 'registration';
    public const ID = 'id';

    public function insert(array $registration): int
    {
        // random number
        $random = rand(100000, 999999);
        $random = (string)$random;

        //   $cityName = explode(':', $registration['city'])[0];
        //   $cityState = explode(':', $registration['city'])[1];


        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE .
            " ('course', 'subject', 'fname', 'mname', 'gender',  'nationality', 'country', 'state','padd', 'session', 'regno')
        VALUES (:course, :subject, :fname, :mname, :gender, :nationality, :country, :state,:padd, :session, :regno)");
        $statement->bindValue('course', $registration['course'], PDO::PARAM_STR);
        $statement->bindValue('subject', $registration['subject'], PDO::PARAM_STR);
        $statement->bindValue('fname', $registration['fname'], PDO::PARAM_STR);
        $statement->bindValue('mname', $registration['mname'], PDO::PARAM_STR);
        $statement->bindValue('gender', $registration['gender'], PDO::PARAM_STR);
        $statement->bindValue('nationality', $registration['nationality'], PDO::PARAM_STR);
        $statement->bindValue('country', $registration['country'], PDO::PARAM_STR);
        $statement->bindValue('state', $registration['city'], PDO::PARAM_STR);
        $statement->bindValue('padd', $registration['city'], PDO::PARAM_STR);
        $statement->bindValue('session', $registration['session'], PDO::PARAM_STR);
        $statement->bindValue('regno', $random, PDO::PARAM_STR);

        var_dump($statement);
        die();
        return $statement->execute();
    }
    public function update(array $subject)
    {

        $statement = $this->pdo->prepare("UPDATE " . self::TABLE .
            " SET `course` = :course,
            `subject` = :subject,
            `fname` = :fname,
            `mname` = :mname,
             WHERE id=:id");
        $statement->bindValue('id', $subject['id'], PDO::PARAM_INT);
        $statement->bindValue('course', $subject['course'], PDO::PARAM_STR);
        $statement->bindValue('subject', $subject['subject'], PDO::PARAM_STR);
        $statement->bindValue('fname', $subject['fname'], PDO::PARAM_STR);
        $statement->bindValue('mname', $subject['mname'], PDO::PARAM_STR);
    }

    public function getAllCities(): array
    {
        $statement = $this->pdo->query("SELECT * FROM cities");
        return $statement->fetchAll();
    }
    public function getAllCountries(): array
    {
        $statement = $this->pdo->query("SELECT * FROM countries");
        return $statement->fetchAll();
    }
}
