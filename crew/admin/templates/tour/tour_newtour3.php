<?php

//////////////////////////////////////////////////////////////////////
//simpilotgroup Tour 1.0 module for phpVMS virtual airline system   //
//@author David Clark (simpilot)                                    //
//@copyright Copyright (c) 2011, David Clark, All Rights Reserved   //
//////////////////////////////////////////////////////////////////////

$route = $_SESSION['route'];

echo '<form action="'.adminurl('/TourAdmin/build_tour').'" method="post" enctype="multipart/form-data">';
echo 'Choose a scheduled flight for each leg of the tour:<hr />';
?>
<table border="1" width="100%" cellpadding="5px">
    <tr>
        <td width="10%" align="center"><b>Leg:</b></td>
        <td width="25%"><b>Departure Field:</b></td>
        <td width="5%" align="center">&nbsp;</td>
        <td width="25%"><b>Arrival Field:</b></td>
        <td><b>Available Schedules:</b></td>
    </tr>
    <?php
        foreach($route as $leg)
        {
            
        }
        ?>
    <tr>
        <td align="center">1</td>
        <td><?php $from = OperationsData::getAirportInfo($route[0]->icao); echo $route[0]->icao.' - '.$from->name; ?></td>
        <td align="center">To</td>
        <td><?php $to = OperationsData::getAirportInfo($route[1]->icao); echo $route[1]->icao.' - '.$to->name; ?></td>
        <td>
            <?php
                    $schedules = TourData::get_schedules($route[0]->icao, $route[1]->icao);//print_r($schedules);
//                    if($schedules == ''){echo 'No scheduled flights available for this route.';}
//                    else
//                    {
                        echo '<select name="flight1">';
                        foreach($schedules as $schedule)
                        {
                            $aircraft = OperationsData::getAircraftInfo($schedule->aircraft);
                            echo '<option value="'.$schedule->id.'">'.$schedule->code . $schedule->flightnum.' - '.$aircraft->fullname.' ('.$aircraft->icao.') - '.$schedule->distance.'nm</option>';
                        }
                        echo '</select>';
//                    }
            ?>
        </td>
    </tr>
<?php
    $i = 1;
    while ($i < $legs):
        {
            $from = OperationsData::getAirportInfo($route[$i]->icao);
            $to = OperationsData::getAirportInfo($route[($i+1)]->icao);
            echo '<tr><td align="center">'.($i+1).'</td><td>'.$route[$i]->icao.' - '.$from->name.'</td>';
            echo '<td align="center">To</td>';
            echo '<td>'.$route[($i+1)]->icao.' - '.$to->name.'</td>';
            echo '<td>';
            $schedules = TourData::get_schedules($route[$i]->icao, $route[$i + 1]->icao);
//                    if($schedules == ''){echo 'No scheduled flights available for this route.';}
//                    else
//                    {
                        echo '<select name="flight'.($i+1).'">';
                        foreach($schedules as $schedule)
                        {
                            $aircraft = OperationsData::getAircraftInfo($schedule->aircraft);
                            echo '<option value="'.$schedule->id.'">'.$schedule->code . $schedule->flightnum.' - '.$aircraft->fullname.' ('.$aircraft->icao.') - '.$schedule->distance.'nm</option>';
                        }
                        echo '</select>';
//                    }
            echo '</td></tr>';
            $i++;
        }
    endwhile;
?>

</table>
<hr />
<br />
<?php
echo '<input type="hidden" name="legs" value="'.$legs.'" />';
echo '<input type="hidden" name="action" value="new_tour_3" />';
echo '<input type="submit" value="Create New Tour">';
echo '</form>';
?>