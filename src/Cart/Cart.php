<?php namespace Cart;
class Cart
{
    private $storage = [];

    public function __construct($storage)
    {
        $this->storage = $storage;
    }

    public function buy($product, $quantity)
    {
        $quantity = (int)$quantity;
        $this->storage->setValue($product->name, $product->price * $quantity);
        return $this;
    }

    public function restore($product, $quantity)
    {
        $this->storage->restore($product, $quantity);
        if(!$quantity == 0){
            $this->buy($product, $quantity);
        }
        return $this;
    }

    public function total()
    {
        return $this->storage->total();
    }

    public function reset()
    {
        $this->storage->reset();
    }
}