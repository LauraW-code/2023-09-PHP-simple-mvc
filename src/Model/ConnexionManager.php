<?php

namespace App\Model;

use PDO;
use App\Model\AbstractManager;

class ConnexionManager extends AbstractManager
{
    public const TABLE = 'user';

    public function userLogin(array $users)
    {
        $statement = $this->pdo->prepare("SELECT * FROM " . static::TABLE . " WHERE username=:username 
        AND password=:password");
        $statement->bindValue(':username', $users['username'], \PDO::PARAM_STR);
        $statement->bindValue(':password', $users['password'], \PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetch();
    }
}
