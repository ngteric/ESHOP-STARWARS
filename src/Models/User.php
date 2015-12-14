<?php
/**
 * Created by PhpStorm.
 * User: Eric
 * Date: 27/11/2015
 * Time: 12:26
 */

namespace Models;


class User extends Model{
    protected $table = 'users';

    public function getUser($username){

        $sql = sprintf("SELECT * FROM %s WHERE username = '%s'", $this->table, $username);
        $stmt = $this->pdo->query($sql);
        if(!$stmt) return false;
        return $stmt->fetch();
    }
}