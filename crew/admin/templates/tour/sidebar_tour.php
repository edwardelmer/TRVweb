<?php

//////////////////////////////////////////////////////////////////////
//simpilotgroup Tour 1.0 module for phpVMS virtual airline system   //
//@author David Clark (simpilot)                                    //
//@copyright Copyright (c) 2011, David Clark, All Rights Reserved   //
//////////////////////////////////////////////////////////////////////

?>
<h3><center>Tour Management Console</center></h3>
<br />
<center>
    <?php 
        echo '<a href="'.adminurl('/TourAdmin').'">Tour Home</a><br />';
        echo '<a href="'.adminurl('/TourAdmin/build_tour').'">Build New Tour</a><br />';
        echo '<a href="'.adminurl('/TourAdmin/rebuild_progress').'">Rebuild A Pilots Progress<br /></a>';
        echo '<a href="'.adminurl('/TourAdmin/rebuild_all_pilotdata').'" onclick="return confirm(\'This Will Rebuild All The Pilot Data Fields For All The tours. If you have a lot of tours with a lot of participants it will take a few moments to complete.A backup of your tours database tables is suggested.\')">Rebuild All Tour Records</a>';
    ?>
</center>
<br />
<hr />