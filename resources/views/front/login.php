<?php ob_start();?>
    <h1>Login</h1>

    <div id="loginform">
        <form action="<?php echo url('login'); ?>" method="post">
            <label for="login">Login</label>
            <input type="text" name="login" id="login"
                   value="nongeric"/>
            <error><?php if(!empty($_SESSION['error']['login'])) echo $_SESSION['error']['login']; $_SESSION['error']['login']=''; ?></error>
            <label for="password">Mot de passe</label>
            <input type="password" name="password" id="password" value=""/>
            <error><?php if(!empty($_SESSION['error']['password'])) echo $_SESSION['error']['password']; $_SESSION['error']['password']=''; ?></error>
            <?php echo token(); ?>
            <input class="button-primary" type="submit" value="Login">
        </form>
    </div>

<?php
$content = ob_get_clean();
include __DIR__.'/../layouts/master.php';




