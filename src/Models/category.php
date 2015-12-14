<?php
/**
 * Created by PhpStorm.
 * User: Eric
 * Date: 26/11/2015
 * Time: 17:08
 */

namespace Models;


class category extends Model{
    protected $table = 'categories';

    public function getCategory($category_id){
        $sql = sprintf('SELECT * FROM %s WHERE id=%d', $this->table, (int) $category_id);
        $stmt = $this->pdo->query($sql);
        if(!$stmt) return false;
        return $stmt->fetch();
    }

}