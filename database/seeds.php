<?php
$pdo = new PDO('mysql:host=localhost;dbname=db_starwars', 'eric', 'eric');

//CATEGORIES

$sql ="INSERT INTO categories (title, description) VALUES ('Lasers', 'Copie des sabres lasers du film')";
$pdo->query($sql);

$sql ="INSERT INTO categories (title, description) VALUES ('Casques', 'Copie des casques du film')";
$pdo->query($sql);

// PRODUCTS

$published_at = date("Y-m-d H:i:s");
$sql =sprintf("INSERT INTO products (category_id, title, abstract, content, price, status, published_at) VALUES (1, 'Sabre laser rouge', 'Sabre laser de Dark Vador Edition collector','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',99.9, 'published','%s')", $published_at);
$pdo->query($sql);

$published_at = date("Y-m-d H:i:s");
$sql =sprintf("INSERT INTO products (category_id, title, abstract, content, price, status, published_at)
VALUES (2, 'Casque de Dark Vador', 'Casque de Dark Vador Edition collector','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum',49.9, 'published','%s')", $published_at);
$pdo->query($sql);

// IMAGES

$sql ="INSERT INTO images (uri, product_id) VALUES ('sabre_laser.jpg', 1)";
$pdo->query($sql);

$sql ="INSERT INTO images (uri, product_id) VALUES ('casque_darkvador.jpg', 2)";
$pdo->query($sql);

// TAGS

$sql ="INSERT INTO tags (name) VALUES ('casque')";
$pdo->query($sql);
$sql ="INSERT INTO tags (name) VALUES ('darkvador')";
$pdo->query($sql);
$sql ="INSERT INTO tags (name) VALUES ('sabre')";
$pdo->query($sql);
$sql ="INSERT INTO tags (name) VALUES ('rouge')";
$pdo->query($sql);
$sql ="INSERT INTO tags (name) VALUES ('jedi')";
$pdo->query($sql);

// POST TAGS

$sql ="INSERT INTO product_tag (product_id, tag_id) VALUES (1,2)";
$pdo->query($sql);
$sql ="INSERT INTO product_tag (product_id, tag_id) VALUES (1,3)";
$pdo->query($sql);
$sql ="INSERT INTO product_tag (product_id, tag_id) VALUES (1,4)";
$pdo->query($sql);
$sql ="INSERT INTO product_tag (product_id, tag_id) VALUES (1,5)";
$pdo->query($sql);
$sql ="INSERT INTO product_tag (product_id, tag_id) VALUES (2,1)";
$pdo->query($sql);
$sql ="INSERT INTO product_tag (product_id, tag_id) VALUES (2,2)";
$pdo->query($sql);
$sql ="INSERT INTO product_tag (product_id, tag_id) VALUES (2,5)";
$pdo->query($sql);

// USERS

$sql =sprintf("INSERT INTO users (username,password) VALUES ('nongeric','%s')",password_hash('root', PASSWORD_DEFAULT));
$pdo->query($sql);