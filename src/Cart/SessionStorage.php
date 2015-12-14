<?php namespace Cart;
class SessionStorage
{

    private $sessionName;

    public function __construct($sessionName)
    {

        session_start();
        if (empty($_SESSION[$sessionName])) {
            $_SESSION[$sessionName] = [];
        }
        $this->sessionName = $sessionName;
    }

    public function setValue($name, $value)
    {
        if (empty($_SESSION[$this->sessionName][$name])) $_SESSION[$this->sessionName][$name] = 0;
        $_SESSION[$this->sessionName][$name] += $value;
    }

    public function total()
    {
        return array_sum($_SESSION[$this->sessionName]);
    }

    public function restore($product, $quantity)
    {
        unset($_SESSION[$this->sessionName][$product->name]);
    }

    public function reset()
    {
        $_SESSION[$this->sessionName] = [];
    }
}