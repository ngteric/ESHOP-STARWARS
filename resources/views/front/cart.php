<?php ob_start(); ?>
    <h1>Votre panier</h1>
    <div id="cart">
        <div class="row black">
            <div class="five columns">Produit</div>
            <div class="two columns">Quantité</div>
            <div class="five columns">Prix (Euros)</div>
        </div>
        <?php if(isset($products)): ?>
        <?php foreach ($products as $product): ?>
            <?php if(!empty($_SESSION['Star Wars'])): ?>
            <div class="row">
                <div class="five columns">
                <p><?php echo $product->title; ?></p>
                <img src="<?php echo url('uploads', $image->productImage($product->id)->uri); ?>"/>
                </div>
                <div class="two columns">
                    <form action="http://localhost:8000/modify" method="post">
                        <input class='hidden' type="text" name="id" value="<?php echo $product->id; ?>"/>
                        <input type="number" id="quantity" min="0" name="quantity" value="<?php echo $_SESSION['Star Wars'][$product->title] / $product->price; ?>"/>
                        <input type="submit" value="Modifier"/>
                    </form>
                </div>
                <div class="five columns"><?php echo $_SESSION['Star Wars'][$product->title]; ?> Euros</div>
            </div>
        <?php endif; ?>
        <?php endforeach; ?>
        <?php endif; ?>
        <div class="row black">
            <div class="five columns">Total</div>
            <div class="five columns"><?php  echo $total; ?> Euros</div>
        </div>
    </div>
<div id="commandInfo">
    <form action="<?php echo url('finalize'); ?>" method="post">
        <label for="email">Email</label>
        <input type="text" name="email" id="email"
               value="nongeric@gmail.com"/>
        <error><?php if(!empty($_SESSION['error']['email'])) echo $_SESSION['error']['email']; ?></error>
        <label for="number">Numéro de carte</label>
        <input type="text" name="number" id="number" value=""/>
        <error><?php if(!empty($_SESSION['error']['number'])) echo $_SESSION['error']['number']; ?></error>
        <label for="address">Adresse</label>
        <textarea name="address" class="u-full-width" placeholder="Votre adresse ..."
                  id="address"></textarea>
        <error><?php if(!empty($_SESSION['error']['adress'])) echo $_SESSION['error']['adress']; ?></error>
        <input class="button-primary" type="submit" value="command">
    </form>
</div>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/master.php';

