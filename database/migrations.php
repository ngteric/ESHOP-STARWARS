<?php

$pdo = new PDO('mysql:host=localhost;dbname=db_starwars', 'eric', 'eric');

$pdo->exec("
    CREATE TABLE IF NOT EXISTS users(
      id INT UNSIGNED NOT NULL AUTO_INCREMENT,
      username VARCHAR(20),
      password VARCHAR(100),
      PRIMARY KEY(id)
    )ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
");

$pdo->exec("
   CREATE TABLE IF NOT EXISTS categories (
  `id`      INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `title`    VARCHAR(100) NOT NULL,
  `description` TEXT,
  PRIMARY KEY (`id`)
    )ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
");

$pdo->exec("
    CREATE TABLE IF NOT EXISTS tags (
      `id`        INT UNSIGNED NOT NULL AUTO_INCREMENT,
      `name`      VARCHAR(100),
      PRIMARY KEY (`id`)
) ENGINE = InnoDB AUTO_INCREMENT =1; DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
");

$pdo->exec("
    CREATE TABLE IF NOT EXISTS products (
      id INT UNSIGNED NOT NULL AUTO_INCREMENT,
      category_id INT UNSIGNED,
      title VARCHAR(100),
      abstract TEXT,
      content TEXT,
      price DECIMAL(5,2),
      published_at DATETIME,
      status ENUM('published','unpublished'),
      CONSTRAINT `products_category_id_categories` FOREIGN KEY(`category_id`) REFERENCES `categories`(`id`),
      PRIMARY KEY(id)
    )ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
");

$pdo->exec("
    CREATE TABLE `product_tag` (
  `tag_id`   INT UNSIGNED,
  `product_id`   INT UNSIGNED,
  CONSTRAINT `products_tag_product_id_products` FOREIGN KEY(`product_id`) REFERENCES `products`(`id`) ON DELETE CASCADE,
  CONSTRAINT `products_tag_tag_id_tags` FOREIGN KEY(`tag_id`) REFERENCES `tags`(`id`) ON DELETE CASCADE,
  UNIQUE ( `product_id`, `tag_id`)
) ENGINE = InnoDB AUTO_INCREMENT =1; DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
");


$pdo->exec("
    CREATE TABLE IF NOT EXISTS images(
      id INT UNSIGNED NOT NULL AUTO_INCREMENT,
      product_id INT UNSIGNED NOT NULL,
      name VARCHAR(100),
      uri VARCHAR(100),
      date DATE,
      status ENUM('published','unpublished'),
      PRIMARY KEY(id),
      CONSTRAINT images_product_id_products FOREIGN KEY(product_id) REFERENCES products(id) ON DELETE CASCADE
    )ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
");


/*$pdo->exec("
    CREATE TABLE IF NOT EXISTS customers(
      id INT UNSIGNED NOT NULL AUTO_INCREMENT,
      email VARCHAR(100),
      address TEXT,
      numbercard VARCHAR(100),
      number_command INT UNSIGNED,
      PRIMARY KEY(id)
    )ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
");*/


$pdo->exec("
    CREATE TABLE IF NOT EXISTS histories(
      id INT UNSIGNED NOT NULL AUTO_INCREMENT,
      product_id INT UNSIGNED NOT NULL,
      name VARCHAR(100),
      address TEXT,
      numbercard BIGINT UNSIGNED NOT NULL,
      email VARCHAR(100),
      price DECIMAL(10,2),
      quantity DECIMAL(10,2),
      total INT UNSIGNED NOT NULL,
      date DATETIME,
      status ENUM('done','process') NOT NULL DEFAULT 'process',
      PRIMARY KEY(id),
      CONSTRAINT histories_product_id_products FOREIGN KEY(product_id) REFERENCES products(id) ON DELETE CASCADE
    )ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
");


