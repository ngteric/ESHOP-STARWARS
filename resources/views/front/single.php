<?php ob_start();?>
    <h1>Produit</h1>
    <div id="product">
        <h2><?php echo $products->abstract; ?></h2>
    <?php if($image->find($products->id)): ?>
        <img src="<?php echo url('uploads', $image->productImage($products->id)->uri); ?>"/>
    <?php endif; ?>
    <div id="description">
        <h3>Description :</h3>
        <p><?php echo $products->content; ?></p>
        <ul class="tags">
            <?php foreach ($tags->productTags($products->id) as $tag): ?>
                <li><?php echo $tag->name; ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <div id="buy">
        <strong><?php echo $products->price; ?> Euros</strong>
        <form action="http://localhost:8000/command" method="post">
            <input class='hidden' type="text" name="id" value="<?php echo $products->id; ?>"/>
            <input type="number" id="quantity" min="1" name="quantity" value="1"/>
            <input type="submit" value="Acheter"/>
        </form>
    </div>
    </div>
<?php
$content = ob_get_clean();
include __DIR__.'/../layouts/master.php';

