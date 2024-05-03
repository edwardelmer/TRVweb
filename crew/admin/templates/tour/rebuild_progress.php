<?php

//////////////////////////////////////////////////////////////////////
//simpilotgroup Tour 1.0 module for phpVMS virtual airline system   //
//@author David Clark (simpilot)                                    //
//@copyright Copyright (c) 2011, David Clark, All Rights Reserved   //
//////////////////////////////////////////////////////////////////////

?>

<table width="100%" border="1px">
    <tr>
        <td>Pilot</td>
        <td>Tour Participation</td>
    </tr>
    <?php
    if (!$pilots) {
        echo '<tr><td colspan="2">No Pilot Records Exist</td></tr>';
    }
    else {
        asort($pilots);
        foreach ($pilots as $pilot) {
            $data = PilotData::getPilotData($pilot->pilotid);
            if($data == ''){continue;}
            $tours = TourData::get_pilot_tours($pilot->pilotid);
            echo '<tr>';
            echo '<td>' . $data->firstname . ' ' . $data->lastname . ' - ' . PilotData::getPilotCode($data->code, $data->pilotid) . '</td>';
            echo '<td>';
            foreach ($tours as $tour) {
                $tourdata = TourData::get_tour($tour->tourid);
                if($tourdata == ''){continue;}
                echo $tourdata->title . ' <a href="' . adminurl('/TourAdmin/rebuild_pilotdata') . '/' . $pilot->pilotid . '/' . $tour->tourid . '">Rebuild Pilot\'s Progress</a><br />';
            }
            echo '</td>';
            echo '</tr>';
        }
    }
    ?>
</table>