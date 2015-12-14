<?php

namespace Controllers;

use Models\Tag;
use Models\Product;
use Models\Image;
use Models\Cart;
use Models\Category;
use Models\History;
use Models\User;

class FrontController
{
    public function index()
    {
        $product = new Product;
        $products = $product->all();
        $tags = new Tag;
        $image = new Image;
        view('front.index', compact('products', 'image', 'tags'));

    }

    public function show($id)
    {
        $product = new Product;
        $products = $product->find($id);
        $tags = new Tag;
        $image = new Image;
        view('front.single', compact('products', 'image', 'tags'));
    }

    public function category($id)
    {
        $product = new Product;
        $products = $product->productCategory($id);
        $category = new Category;
        $categories = $category->getCategory($id);
        $tags = new Tag;
        $image = new Image;
        view('front.category', compact('products', 'image', 'tags', 'categories'));
    }

    public function showCart($cart)
    {
        $total = $cart->total();
        $carts = new Cart;
        foreach ($_SESSION['Star Wars'] as $name => $price) {
            $products [] = $carts->ShowCart($name);
        }
        $image = new Image;
        view('front.cart', compact('products', 'image', 'total'));

    }

    public function store($cart)
    {


        if (!empty($_POST)) {
            $rules = [
                'id' => FILTER_VALIDATE_INT,
                'quantity' => FILTER_VALIDATE_INT
            ];

            $sanitize = filter_input_array(INPUT_POST, $rules);
            $product = new Product;
            $products = $product->find($sanitize['id']);
            $p = new \Cart\Product;
            $p->setName($products->title);
            $p->setPrice($products->price);

            $cart->buy($p, $sanitize['quantity']);
            $_SESSION['message'] = 'Votre produit est bien dans le panier !';
            header('Location: /');
        }
    }

    public function modify($cart)
    {
        if (!empty($_POST)) {

            $rules = [
                'id' => FILTER_VALIDATE_INT,
                'quantity' => FILTER_VALIDATE_INT
            ];

            $sanitize = filter_input_array(INPUT_POST, $rules);
            $product = new Product;
            $products = $product->find($sanitize['id']);
            $p = new \Cart\Product;
            $p->setName($products->title);
            $p->setPrice($products->price);

            $cart->restore($p, $sanitize['quantity']);

            header('Location: /cart');
        }
    }

    public function finalize($cart)
    {

        if (!empty($_POST)) {
            $rules = [
                'email' => FILTER_VALIDATE_EMAIL,
                'address' => FILTER_SANITIZE_STRING
            ];
            //id customer
            //var_dump(\Connect::$pdo->lastInsertId());
            $sanitize = filter_input_array(INPUT_POST, $rules);
            $error = false;

            if (!$sanitize['email']) {
                $_SESSION['error']['email'] = 'Votre email n\'est pas valide';
                $error = true;
            }

            if (preg_match('/[0-9]{16}/', $_POST['number'], $m) !== 1 || strlen($_POST['number']) >= 17) {
                echo 'lol';
                $_SESSION['error']['number'] = 'Votre numéro de carte bancaire n\'est pas valide';
                $error = true;
            }
            if (!$sanitize['address']) {
                $_SESSION['error']['address'] = 'Votre adresse mail n\'est pas valide';
                $error = true;
            }

            if ($error) {
                header('Location: /cart');
                exit;
            }

            $history = new History;

            $carts = new Cart;
            foreach ($_SESSION['Star Wars'] as $name => $price) {
                $products [] = $carts->ShowCart($name);
            }

            foreach ($products as $product) {
                $data = [
                    'name' => $product->title,
                    'product_id' => $product->id,
                    'numbercard' => $_POST['number'],
                    'address' => $_POST['address'],
                    'email' => $_POST['email'],
                    'price' => $product->price,
                    'total' => $_SESSION['Star Wars'][$product->title],
                    'quantity' => $_SESSION['Star Wars'][$product->title] / $product->price,
                    'date' => date("Y-m-d H:i:s"),
                ];
                $history->create($data);
            }
            $_SESSION['message'] = 'Votre commande est terminé, veuillez checkez vos mails !';
            $cart->reset();
            header('Location: /');
        }
    }

    public function login()
    {
        view('front.login', []);


        if (!empty($_POST)) {
            var_dump($_POST);
            $token = $_POST['_token'];
            if (checked_token($token) == true) {
                $rules = [
                    'login' => FILTER_SANITIZE_STRING,
                    'password' => FILTER_SANITIZE_STRING
                ];

                $sanitize = filter_input_array(INPUT_POST, $rules);
                var_dump($_POST);
                $users = new User;
                $user = $users->getUser($sanitize['login']);
                if ($user == false) {
                    $_SESSION['error']['login'] = 'Votre login n\'est pas valide';
                    $_SESSION['error']['password'] = 'Votre mot de passe n\'est pas valide';
                    header('Location: /login');
                    exit;
                }

                $user = compact('user');

                $error = false;
                foreach ($user as $value) {
                    if ($sanitize['login'] != $value->username) {
                        $_SESSION['error']['login'] = 'Votre login n\'est pas valide';
                        $error = true;
                    }

                    if (!password_verify($sanitize['password'], $value->password)) {
                        $_SESSION['error']['password'] = 'Votre mot de passe n\'est pas valide';
                        $error = true;
                    }
                }

                if ($error) {
                    header('Location: /login');
                    exit;
                }

                $_SESSION['users']['username'] = $_POST['login'];
                $_SESSION['users']['password'] = $_POST['password'];
                header('Location: /dashboard');
                exit;
            }
        }
    }

    public function dashboard()
    {
        $history = new History;
        $histories = $history->getHistories();
        view('front.dashboard', compact('histories'));
    }

    public function logout()
    {
        unset($_SESSION['users']);
        $_SESSION['message'] = 'Vous êtes déconnecté !';
        header('Location: /');
        exit;
    }
}