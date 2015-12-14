<?php
use Cocur\Slugify\Slugify;
$slugify = new Slugify();
?>

<?php ob_start();?>
<h1>Nos derniers produits</h1>

<div id="lastProduct">
<?php foreach ($products as $product): ?>
    <div id="product">
        <?php $p = $slugify->slugify($product->title ,'_'); ?>
        <h2><a href="<?php echo url('product/'.$p, $product->id); ?>"><?php echo $product->title;?></a></h2>
        <?php if($image->find($product->id)): ?>
        <img src="<?php echo url('uploads', $image->productImage($product->id)->uri); ?>"/>
        <?php endif; ?>
        <p><?php echo $product->abstract;?><strong> <?php echo $product->price;?> Euros</strong></p>
        <ul class="tags">
            <?php foreach ($tags->productTags($product->id) as $tag): ?>
            <li><?php echo $tag->name; ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endforeach; ?>
</div>

<?php
$content = ob_get_clean();
include __DIR__.'/../layouts/master.php';




