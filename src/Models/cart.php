<?php namespace Models;


class cart extends Model {
    protected $table = 'histories';

    public function showCart($product_name){

        $sql = sprintf("SELECT * FROM products WHERE title='%s'", (string) $product_name);
        $stmt = $this->pdo->query($sql);
        if(!$stmt) return false;
        return $stmt->fetch();
    }
}