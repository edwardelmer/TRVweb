<?php if(!defined('IN_PHPVMS') && IN_PHPVMS !== true) { die(); } ?>
<?php
    //Destinations Map exclusively made for TRV
?>
<?php 
 $dests = SchedulesData::getArrivalAiports($hub->icao);
 
?>