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
        $randomString = (string)$random;
        $city_Arr = explode(":", $registration['city']);
        $city_name = $city_Arr[0];
        $city_code = (string)$city_Arr[1];
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE .
            " (course, subject, fname, mname, gender, nationality, country, state,padd,session,regno)
        VALUES (:course, :subject, :fname, :mname, :gender, :nationality, :country, :state,:padd, :session, :regno)");
        $statement->bindValue('course', $registration['course'], PDO::PARAM_STR);
        $statement->bindValue('subject', $registration['subject'], PDO::PARAM_STR);
        $statement->bindValue('fname', $registration['fname'], PDO::PARAM_STR);
        $statement->bindValue('mname', $registration['mname'], PDO::PARAM_STR);
        $statement->bindValue('gender', $registration['gender'], PDO::PARAM_STR);
        $statement->bindValue('nationality', $registration['nationality'], PDO::PARAM_STR);
        $statement->bindValue('country', $registration['country'], PDO::PARAM_STR);
        $statement->bindValue('state', $city_code, PDO::PARAM_STR);
        $statement->bindValue('padd', $city_name, PDO::PARAM_STR);
        $statement->bindValue('session', $registration['session'], PDO::PARAM_STR);
        $statement->bindValue('regno', $randomString, PDO::PARAM_STR);
        $statement->execute();
        return  (int)$this->pdo->lastInsertId();
    }
    public function update(array $registration)
    {
        $city_Arr = explode(":", $registration['city']);
        $city_name = $city_Arr[0];
        $city_code = (string)$city_Arr[1];
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE .
            " SET course = :course,
            subject = :subject,
            fname = :fname,
            mname = :mname,
            gender= :gender,
            nationality =:nationality,
            country =:country,
            state =:state,
            padd =:padd,
            session =:session,
            regno =:regno
             WHERE id=:id");
        $statement->bindValue('id', $registration['id'], PDO::PARAM_INT);
        $statement->bindValue('course', $registration['course'], PDO::PARAM_STR);
        $statement->bindValue('subject', $registration['subject'], PDO::PARAM_STR);
        $statement->bindValue('fname', $registration['fname'], PDO::PARAM_STR);
        $statement->bindValue('mname', $registration['mname'], PDO::PARAM_STR);
        $statement->bindValue('gender', $registration['gender'], PDO::PARAM_STR);
        $statement->bindValue('nationality', $registration['nationality'], PDO::PARAM_STR);
        $statement->bindValue('country', $registration['country'], PDO::PARAM_STR);
        $statement->bindValue('state', $city_code, PDO::PARAM_STR);
        $statement->bindValue('padd', $city_name, PDO::PARAM_STR);
        $statement->bindValue('session', $registration['session'], PDO::PARAM_STR);
        $statement->bindValue('regno', $registration['regno'], PDO::PARAM_STR);
        $statement->execute();
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

    public function delete(int $id): void
    {
        $statement = $this->pdo->prepare("DELETE FROM " . self::TABLE . " WHERE id=:id");
        $statement->bindValue('id', $id, PDO::PARAM_INT);
        $statement->execute();
    }
}
