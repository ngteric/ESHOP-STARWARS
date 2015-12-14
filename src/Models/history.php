<?php
/**
 * Created by PhpStorm.
 * User: Eric
 * Date: 26/11/2015
 * Time: 19:05
 */

namespace Models;


class history extends Model{
    protected $table='histories';

    public function getHistories(){
        $sql = sprintf("SELECT * FROM %s",$this->table);
        $stmt = $this->pdo->query($sql);
        if(!$stmt) return false;
        return $stmt->fetchAll();
    }
}