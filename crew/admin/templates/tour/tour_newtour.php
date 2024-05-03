<?php

//////////////////////////////////////////////////////////////////////
//simpilotgroup Tour 1.0 module for phpVMS virtual airline system   //
//@author David Clark (simpilot)                                    //
//@copyright Copyright (c) 2011, David Clark, All Rights Reserved   //
//////////////////////////////////////////////////////////////////////

if(isset($errors))
{
    foreach($errors as $error)
    {
        echo '<font color="#FF0000">'.$error.'</font><br />';
    }
    echo '<hr />';
}



?>

<form action="<?php echo adminurl('/TourAdmin/build_tour');?>" method="post" enctype="multipart/form-data">
    
    Select the starting aerodrome for the tour:<br /><br />

    <select name="start">
        <option value="">Select starting aerodrome</option>
        <?php
        foreach ($airports as $airport)
        {
            echo '<option value="'.$airport->icao.'"';
            if(isset($start) && $start == $airport->icao){echo ' selected="selected" ';}
            echo '>'.$airport->icao.' - '.$airport->name.' - '.$airport->country.'</option>';
        }
?>
    </select>

    <br /><br />

    <hr />
    <br />Select the number of legs for the tour:<br /><br />
    <select name="legs">
        <option value="">Select number of legs</option>
        <?php
        $i = 2;
        while ($i <= 50):
            {
                echo '<option value="'.$i.'"';
                if(isset($legs) && $legs == $i){echo ' selected="selected" ';}
                echo '>'.$i.'</option>';
                $i++;
        }
        endwhile;
?>
    </select>
    <br /><br />
    <hr /><br />
    <input type="hidden" name="function" value="initial" />
    <input type="hidden" name="action" value="new_tour_2" />
    <input type="submit" value="Build New Tour" />
</form>