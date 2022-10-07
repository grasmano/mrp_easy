<?php
/**
 * Created by PhpStorm.
 * User: Oleg
 * Date: 30.09.2022
 * Time: 22:14
 */

include 'DB.php';

class Users extends Db
{

    public $id;
    public $username;
    public $hash;
    public $counter;

    /**
     * @return array|bool
     */

    public static function getUserByUsername($username)
    {
        $sql = "SELECT * FROM users WHERE username=:username";
        $db = (new Db())->connectDb();
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':username', $username, SQLITE3_TEXT);

        if ($stmt->execute()) {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($result) {
                return self::loadUser($result);
            } else {
                return null;
            }
        } else {
            return null;
        }
    }

    private static function loadUser($data)
    {
        $user = new Users();
        $user->id = $data['id'];
        $user->username = $data['username'];
        $user->hash = $data['hash'];
        $user->counter = $data['counter'];
        return $user;
    }

    public static function createUser($username, $password)
    {
        $username = htmlspecialchars(strip_tags($username));
        $password = htmlspecialchars(strip_tags($password));
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users(username, hash, counter) VALUES (:username, :hash, '0')";
        $pdo = (new db())->connectDb();
        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':username', $username, SQLITE3_TEXT);
        $stmt->bindValue(':hash', $hash, SQLITE3_TEXT);
        if ($stmt->execute()) {
            return self::getUserByUsername($username);
        }
        return null;
    }

    public function saveUser($user)
    {
        $sql = "UPDATE users SET username=:username, hash=:hash, counter=:counter WHERE id=:id";
        $pdo = (new db())->connectDb();
        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':username', $user->username, SQLITE3_TEXT);
        $stmt->bindValue(':hash', $user->hash, SQLITE3_TEXT);
        $stmt->bindValue(':counter', $user->counter, SQLITE3_INTEGER);
        $stmt->bindValue(':id', $user->id, SQLITE3_INTEGER);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}