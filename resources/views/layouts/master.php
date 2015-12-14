<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>E-Shop Star Wars</title>
    <link href='https://fonts.googleapis.com/css?family=Orbitron|ABeeZee|Alegreya+Sans|Raleway' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="<?php echo url('assets/css/normalize.css'); ?>"/>
    <link rel="stylesheet" href="<?php echo url('assets/css/skeleton.css'); ?>"/>
    <link rel="stylesheet" href="<?php echo url('assets/css/main.css'); ?>"/>
</head>
<body>
    <header class="clearfix">
        <div class="wrapper">
        <h1><a href="<?php echo url(); ?>"><img src="/../assets/css/img/logo.png"/>E-Shop</a></h1>
        <nav id="main-nav">
            <ul>
                <li><a href="<?php echo url(); ?>">Accueil</a></li>
                <li><a href="<?php echo url('category',1); ?>">Lasers</a></li>
                <li><a href="<?php echo url('category',2); ?>">Casques</a></li>
                <li><a href="<?php echo url('contact'); ?>">Contact</a></li>
                <?php if(!empty($_SESSION['users'])): ?>
                    <li><a href="<?php  echo url('dashboard'); ?>">Dashboard</a></li>
                <li><a href="<?php  echo url('logout'); ?>">Logout</a></li>
                <?php endif; ?>
                <?php if(empty($_SESSION['users'])): ?>
                    <li><a href="<?php  echo url('login'); ?>">Login</a></li>
                <?php endif; ?>
                <?php if(!empty($_SESSION['Star Wars'])): ?>
                    <li class="cartIcon"><a href="<?php  echo url('cart'); ?>"><img src="/../assets/css/img/cart.png" alt="Icon panier"/></a><p><?php echo count($_SESSION['Star Wars']); ?></p></li>
                <?php endif; ?>
            </ul>
        </nav>
        </div>
    </header>
    <div class="wrapper">
        <?php if(!empty($_SESSION['message'])): ?>
            <p class="message"><?php echo $_SESSION['message']; $_SESSION['message'] ='' ?></p>
        <?php endif; ?>
        <main id="main">
    <?php echo $content; ?>
        </main>
    </div>
</body>
</html>