<?php
/**
 * Created by PhpStorm.
 * User: Oleg
 * Date: 30.09.2022
 * Time: 00:13
 */

class Db
{
    private $pdo;

    protected function connectDb()
    {
        try {
            $this->pdo = new PDO('sqlite:./db/mrp_easy.db');
        } catch (PDOException $e) {
            echo "Connection failed";
        }
        return $this->pdo;
    }

}

