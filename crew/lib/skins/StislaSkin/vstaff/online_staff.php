<?php
/*
Module Created By Vansers-Add-Ons (Vansers)
This module is only use for phpVMS (www.phpvms.net) - (A Virtual Airline Admin Software)
@Created By Vansers
@Copyrighted @ 2013


*/
?>
<?php
if(!$online_staff)
{
        echo 'No Staff Members Are Online!';
        return;
   
}
foreach($online_staff as $staff)
{
?>
<p><a href="<?php echo url('/profile/view/'.$staff->pilotid);?>"><?php echo PilotData::GetPilotCode($staff->code, $staff->pilotid). ' ' .$staff->firstname . ' ' . $staff->lastname?></a></p>
<?php
}
?>