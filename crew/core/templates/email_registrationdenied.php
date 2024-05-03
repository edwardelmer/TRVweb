<?php if(!defined('IN_PHPVMS') && IN_PHPVMS !== true) { die(); } ?>
Dear <?php echo $pilot->firstname.' '.$pilot->lastname?>, <br><br>
We are sorry to say that your registration for <?php echo SITE_NAME; ?> was denied.<br><br>

If you think this was an error, please contact our staff at <a href="<?php echo url('/');?>"><?php echo url('/');?></a>. 
<br>
<br>
Thanks!
<br>
<strong><?php echo SITE_NAME; ?> Staff</strong>