<?php if(!defined('IN_PHPVMS') && IN_PHPVMS !== true) { die(); } ?>
Hi <?php echo $pilot->firstname.' '.$pilot->lastname?>,<br><br><br>

Right now you have been marked as retired because you have been inactive for more than <?php echo Config::Get('PILOT_INACTIVE_TIME')?> days.<br><br>
To reactivate your pilot account please fly and file a valid pirep using RedTrax.<br><br>
Please be advised that you have to file minimum 1(one) valid pirep in <?php echo Config::Get('PILOT_INACTIVE_TIME')?> days to remain active as Pilot in <?php echo SITE_NAME; ?><br><br><br>


Thanks,<br>

<strong>The <?php echo SITE_NAME; ?> Management</strong>