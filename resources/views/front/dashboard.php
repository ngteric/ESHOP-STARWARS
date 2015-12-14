<?php ob_start();?>
    <h1>Dashboard</h1>
    <div id="dashboard">
        <div class="row black">
            <div class="one columns">id</div>
            <div class="one columns">product_id</div>
            <div class="one columns">name</div>
            <div class="one columns">address</div>
            <div class="one columns">numbercard</div>
            <div class="one columns">email</div>
            <div class="one columns">price</div>
            <div class="one columns">quantity</div>
            <div class="one columns">total</div>
            <div class="one columns">date</div>
            <div class="one columns">status</div>
        </div>
            <?php foreach ($histories as $history): ?>
                <div class="row">
                    <div class="one columns"><?php echo $history->id; ?></div>
                    <div class="one columns"><?php echo $history->product_id; ?></div>
                    <div class="one columns"><?php echo $history->name; ?></div>
                    <div class="one columns"><?php echo $history->address; ?></div>
                    <div class="one columns"><?php echo $history->numbercard; ?></div>
                    <div class="one columns"><?php echo $history->email; ?></div>
                    <div class="one columns"><?php echo $history->price; ?></div>
                    <div class="one columns"><?php echo $history->quantity; ?></div>
                    <div class="one columns"><?php echo $history->total; ?></div>
                    <div class="one columns"><?php echo $history->date; ?></div>
                    <div class="one columns"><?php echo $history->status; ?></div>
                </div>
            <?php endforeach; ?>
    </div>

<?php
$content = ob_get_clean();
include __DIR__.'/../layouts/master.php';