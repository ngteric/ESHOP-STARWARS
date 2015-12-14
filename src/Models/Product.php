<?php namespace Models;



class Product extends Model {
    protected $table ='products';
    protected $order ='published_at';


    public function productCategory($category_id){
        $sql = sprintf('SELECT * FROM %s WHERE category_id=%d', $this->table, (int) $category_id);
        $stmt = $this->pdo->query($sql);
        if(!$stmt) return false;
        return $stmt->fetchAll();
    }
}