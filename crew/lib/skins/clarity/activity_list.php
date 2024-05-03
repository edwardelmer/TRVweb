<?php if(!defined('IN_PHPVMS') && IN_PHPVMS !== true) { die(); } ?>
<?php

foreach($allactivities as $activity) {
    
    /*  Use the activity->type to determine the type of activity (duh?)
        Constants are in app.config.php 
        
        Like here, I put a specific link to the PIREP at the end of the message
        You can use the if/else's to add specific images?
        
        $activity->refid is the ID of the thing it's referring to, so if it's a
        new PIREP, the refid will be the ID of the PIREP
        
        $activity-> also contains all the fields about the pilot who this notice
        is about        
     */
           
    $link_title = '';
    $link_href = '';
    if($activity->type == ACTIVITY_NEW_PIREP) {
        
        $link_href = url('/pireps/view/'.$activity->refid);
        $link_title = 'View Flight Report';
        
    } elseif($activity->type == ACTIVITY_TWITTER) {
        
        $link_href = 'https://twitter.com/#!/'.Config::get('TWITTER_AIRLINE_ACCOUNT').'/status/'.$activity->refid;
        $link_title = 'View Tweet';
		
	} elseif($activity->type == ACTIVITY_NEW_AWARD) {
        
        $link_href = url('/profile/view/'.$activity->pilotid);
        $link_title = 'View Profile';
		
	} elseif($activity->type == ACTIVITY_PROMOTION) {
        
        $link_href = url('/profile/view/'.$activity->pilotid);
        $link_title = 'View Profile';
        
    } elseif($activity->type == ACTIVITY_NEW_PILOT) {
        $link_href = url('/profile/view/'.$activity->pilotid);
        $link_title = 'View Profile';
    }

?>

        <?php
        /*  If there is a pilot associated with this feed update, show their name
            and a link to their profile page */ 
        if($activity->pilotid != 0) { 
            $pilotCode = PilotData::getPilotCode($activity->code, $activity->pilotid);
            ?>
			
			 <li class="dropdown-header">
                        <img src="<?php echo SITE_URL?>/lib/skins/clarity/assets/img/user/user.png" class="img-circle" alt="User Image" />
                        <div class="d-inline-block">
                         <?php echo $pilotCode.' '.$activity->firstname.' '.$activity->lastname?> <small class="pt-1" style="font-size:10px"><?php 
            /* Show the activity message itself */
            echo stripslashes($activity->message); 
        ?></small>
                        </div>
                      </li>
			

    
        <?php 
        } /* End if pilot ID != 0 */ 
        ?>

<?php
}
?>

