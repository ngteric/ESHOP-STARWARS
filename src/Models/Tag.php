<?php 
	namespace Models;

	class Tag extends Model{
        protected $table = 'tags';

        public function productTags($product_id){
            $sql = sprintf('SELECT * FROM %s as $t INNER JOIN product_tag as pt ON pt.tag_id=$t.id WHERE pt.product_id=%d', $this->table, (int) $product_id);
            $stmt = $this->pdo->query($sql);
            if(!$stmt) return false;
            return $stmt->fetchAll();
        }

	}