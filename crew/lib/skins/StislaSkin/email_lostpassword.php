<?php if(!defined('IN_PHPVMS') && IN_PHPVMS !== true) { die(); } ?>
Dear <?php echo $firstname .' '. $lastname; ?>,<br><br>

We have received your password reset request.<br><br>

Your new password is : <strong><?php echo $newpw?></strong><br>

Please change this password as soon as practical.<br><br>


If you were not make this password reset request, please contact our staff immediately.<br>


Thanks!<br>

<strong><?php echo SITE_NAME?> Staff</strong>