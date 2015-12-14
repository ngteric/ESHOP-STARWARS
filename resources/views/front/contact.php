<?php ob_start();?>
    <h1>Contact</h1>

    <div id="contact">
        <p>Eric Nong | Developer</p>
        <p>9 rue de xxxxx</p>
        <p>75003, PARIS</p>
    </div>

<?php
$content = ob_get_clean();
include __DIR__.'/../layouts/master.php';




