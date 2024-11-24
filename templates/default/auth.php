<div class="flex items-center min-h-full flex-col justify-center px-6 py-12 lg:px-8">
    <form method="post" id="switch">
        <button type="submit" class="<?= $formType == 'login' ? 'active' : '' ?>" name="form_type"
            value="login">Login</button>
        <button type="submit" class="<?= $formType == 'register' ? 'active' : '' ?>" name="form_type"
            value="register">Register</button>
    </form>
    <div id="auth">
        <?php if ($formType == 'login')
            // login page
            include("templates/default/components/login.php");
        elseif ($formType == 'register')
            // register page
            include("templates/default/components/register.php");
        ?>
    </div>
</div>