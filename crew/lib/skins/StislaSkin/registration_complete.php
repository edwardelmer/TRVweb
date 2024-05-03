<?php if(!defined('IN_PHPVMS') && IN_PHPVMS !== true) { die(); } ?>
<div class="container mt-5">
    <div class="row">
        <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="login-brand">
                <img src="<?php echo SITE_URL?>/lib/images/reds/the reds logo.png" alt="logo" width="300" >
            </div>

            <?php
                if(isset($message))
                    echo '<div class="alert alert-success">
                        <div class="alert-title">Thank You!</div>
                        Your registration is now complete! Please wait our staff to check your registration data.</div>';
            ?>

            <div class="mt-5 text-muted text-center">
                <div class="alert alert-success">
                        Your have completed the registration process, and your account have been made at The Reds Virtual.<br><br>

                        Please wait for our staff to validate your application.<br><br>

                        You will receive an email when your account has been activated.<br><br>
                        </div>
                
                <a href="theredsvirtual.com">Back to Main Page!</a>
            </div>

            <div class="simple-footer">Copyright &copy; <?php echo SITE_NAME; ?> <?php echo date("Y"); ?></div>
        </div>
    </div>
</div>