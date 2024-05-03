<?php

//////////////////////////////////////////////////////////////////////
//simpilotgroup Tour 1.0 module for phpVMS virtual airline system   //
//@author David Clark (simpilot)                                    //
//@copyright Copyright (c) 2011, David Clark, All Rights Reserved   //
//////////////////////////////////////////////////////////////////////

?>
<table width="100%" border="1px" cellpadding="5px">
    <thead>
        <tr>
            <th colspan="6">New Tour</th>
        </tr>
        <tr>
            <th>Leg:</th>
            <th>Departure:</th>
            <th>Arrival:</th>
            <th>Flight:</th>
            <th>Aircraft:</th>
            <th>Distance:</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $totalmiles = 0;
            $i = 1;
            foreach($_SESSION['flights'] as $flight)
            {
                $leg = SchedulesData::getSchedule($flight);
                $dep = OperationsData::getAirportInfo($leg->depicao);
                $arr = OperationsData::getAirportInfo($leg->arricao);
                echo '<tr>';
                echo '<td>'.$i.'</td>';
                echo '<td>'.$dep->name.' ('.$dep->icao.')</td>';
                echo '<td>'.$arr->name.' ('.$arr->icao.')</td>';
                echo '<td>'.$leg->code . $leg->flightnum.'</td>';
                echo '<td>'.$leg->aircraft.'</td>';
                echo '<td>'.$leg->distance.'</td>';
                echo '</tr>';
                $totalmiles = $totalmiles + $leg->distance;
                $i++;
            }
        ?>
    </tbody>
</table>
<br />
<b>Total Distance Of Tour:</b> <?php echo $totalmiles; ?>nm.
<br /><br />
<?php
    echo '<form action="'.adminurl('/TourAdmin/build_tour').'" method="post" enctype="multipart/form-data">';
    echo '<b>Tour Title:</b><br /><input type="text" name="title" value ="" /><br /><br />';
    echo '<b>Tour Description:</b><br /><textarea name="description" cols="50" rows="5"></textarea><br /><br />';
    echo '<b>Tour Image Link:</b> (example: http://www.image.com/image.jpg) <br /><input type="text" name="image" value ="" /><br /><br />';
    echo '<b>Tour Active:</b><br />';
    echo '<td><select name="active">';
    echo '<option value="1">Active</option>';
    echo '<option value="0">Hidden</option>';
    echo '<option value="2">Complete</option>';
    echo '<option value="3">Upcoming</option>';
    echo '</select></td>';
    echo '<br /><br />';
    echo '<input type="hidden" name="action" value="save_tour" />';
    echo '<input type="submit" value="Save New Tour"><br /><br />';
?>