<?php

//////////////////////////////////////////////////////////////////////
//simpilotgroup Tour 1.0 module for phpVMS virtual airline system   //
//@author David Clark (simpilot)                                    //
//@copyright Copyright (c) 2011, David Clark, All Rights Reserved   //
//////////////////////////////////////////////////////////////////////

echo 'Edit Tour Details<hr />';
    $flights = unserialize($tour->flights);

    echo '<form action="'.adminurl('/TourAdmin/edit').'/'.$tour->id.'" method="post" enctype="multipart/form-data">';
    echo '<table width="100%" border="1px" cellpadding="5px">';
    echo '<thead>';
    echo '<tr><th>Current Value</th><th>Edited Value</th></tr>';
    echo '</thead>';
    echo '<tbody>';
    
    echo '<tr><td><b>Status:</b>';

    if($tour->active == '0'){echo '<font color="#FF0000"><b> Hidden</b></font></td>';}
    if($tour->active == '1'){echo '<font color="#00FF00"><b> Active</b></font></td>';}
    if($tour->active == '2'){echo '<font color="#FBB917"><b> Complete</b></font></td>';}
    if($tour->active == '3'){echo '<font color="#FBB917"><b> Upcoming</b></font></td>';}

    echo '<td>';
    echo '<select name="active">';

        echo '<option value="0"';
            if($tour->active == '0'){echo ' selected="selected" ';}
                echo '>Hidden</option>';
        echo '<option value="1"';
            if($tour->active == '1'){echo ' selected="selected" ';}
                echo '>Active</option>';
        echo '<option value="2"';
            if($tour->active == '2'){echo ' selected="selected" ';}
                echo '>Complete</option>';
        echo '<option value="3"';
            if($tour->active == '3'){echo ' selected="selected" ';}
                echo '>Upcoming</option>';

    echo '</select>';
    echo '</td>';
    echo '<tr><td><b>Title:</b> '.$tour->title.'</td><td><input type="text" name="title" value="'.$tour->title.'" /></td></tr>';
    echo '<tr><td><b>Description:</b> '.$tour->description.'</td><td><textarea cols="60" rows="5" name="description">'.$tour->description.'</textarea></td></tr>';
    echo '<tr><td><b>Image Link:</b> '.$tour->image.'</td><td><input type="text" name="image" value="'.$tour->image.'" /></td></tr>';
    echo '</tbody>';
    echo '</table>';
    echo '<hr />';
?>
<table width="100%" border="1px" cellpadding="5px">
    <thead>
        <tr>
            <th colspan="6">Tour Flights</th>
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
            foreach($flights as $flight)
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
    echo '<input type="hidden" name="action" value="edit_tour" />';
    echo '<input type="submit" value="Save Changes">';
?>
<br /><br />