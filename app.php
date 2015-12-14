<?php
require_once __DIR__ . '/vendor/autoload.php';
/* ========================== *\
	Constantes
\* ========================== */

define('SALT', '1fJxj0yZigmMNCAq');
define('VALID_TIME_TOKEN', 2);
define('DEBUG', false);

/* ========================== *\
	Helper
\* ========================== */

function view($path, array $data, $status = '200 Ok')
{
    $fileName = __DIR__ . '/resources/views/' . str_replace(".", '/', $path) . '.php';

    if (!file_exists($fileName)) die(sprintf('Le fichier %s n\'existe pas', $fileName));
    if (!empty($data)) extract($data);

    header('HTTP/1.1 ' . $status);
    header('Content-type: text/html; charset=UTF-8');

    include $fileName;
}

function url($path='',$params=''){
    if(!empty($params)) $params ="/$params";

    return 'http://localhost:8000/'.$path.$params;
}

function token()
{
    $token = md5(date('Y-m-d h:i:00') . SALT);
    return '<input type="hidden" name="_token" value="' . $token . '">';
}
function checked_token($token)
{
    if (!empty($token)) {
        foreach (range(0, VALID_TIME_TOKEN) as $v) {
            if (($token == md5(date('Y-m-d h:i:00', time() - $v * 60) . SALT))) {
                return true;
            }
        }
        return false;
    }
    throw new RuntimeException('no _token checked');
}


/* ========================== *\
	Bootstrap app
\* ========================== */

use Cart\Cart;
use Cart\Product;
use Cart\SessionStorage;

$cart = new Cart(new SessionStorage('Star Wars'));

/* ========================== *\
	Connect database
\* ========================== */

\Connect::set(['dsn' => 'mysql:host=localhost;dbname=db_starwars','username' => 'root', 'password' => '']);

/* ========================== *\
	Request
\* ========================== */

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = strtolower($_SERVER['REQUEST_METHOD']);


/* ========================== *\
	Controller
\* ========================== */

use Controllers\FrontController;


/* ========================== *\
	Router
\* ========================== */


if ($method == 'get') {
    switch ($uri) {
        case "/":
            $frontController = new FrontController;
            $frontController->index();
            break;

        case preg_match('/\/product\/[a-z_]+\/([1-9][0-9]*)/', $uri, $m) == 1:
            $frontController = new FrontController;
            $frontController->show($m[1]);
            break;

        case preg_match('/\/category\/([1-9][0-9]*)/', $uri, $m) == 1:
            $frontController = new FrontController;
            $frontController->category($m[1]);
            break;

        case "/cart":
            $frontController = new FrontController;
            $frontController->showCart($cart);
            break;

        case "/login":
            $frontController = new FrontController;
            $frontController->login();
            break;

        case "/contact":
            view('front.contact', []);
            break;

        case "/dashboard":
            $frontController = new FrontController;
            $frontController->dashboard();
            break;

        case "/logout":
            $frontController = new FrontController;
            $frontController->logout();
            break;

        default:
            $message = 'Page Not Found';
            view('404', compact('message'), '404 Not Found');
    }
}

if ($method == 'post') {
    switch ($uri) {
        case "/command":
            $frontController = new FrontController;
            $frontController->store($cart);
            break;

        case "/modify":
            $frontController = new FrontController;
            $frontController->modify($cart);
            break;

        case "/finalize":
            $frontController = new FrontController;
            $frontController->finalize($cart);
            break;
        case "/login":
            $frontController = new FrontController;
            $frontController->login();
            break;
    }
}

