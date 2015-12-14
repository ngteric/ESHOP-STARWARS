<?php namespace Cart;

class Product
{

    private $name;
    private $price;

    public function getPrice()
    {
        return $this->price;
    }

    public function getName()
    {
        return $this->name;
    }

    public function __construct($name = '', $price = 0)
    {
        $this->setPrice($price);
        $this->setName($name);
    }

    public function setPrice($price)
    {
        if (!is_numeric($price)) die(sprintf('is not a numeric value %s', $price));
        $this->price = $price;
    }

    public function setName($name)
    {
        if (!is_string($name)) die(sprintf('is not a string value %s', $name));
        $this->name = $name;
    }

    public function __set($name, $value)
    {
        $method = 'set' . ucfirst($name);
        $this->$method($value);
    }

    public function __get($name)
    {
        $method = 'get' . ucfirst($name);
        if (method_exists($this, $method))
            return $this->$method();
    }
}