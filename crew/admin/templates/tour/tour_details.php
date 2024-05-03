<?php

//////////////////////////////////////////////////////////////////////
//simpilotgroup Tour 1.0 module for phpVMS virtual airline system   //
//@author David Clark (simpilot)                                    //
//@copyright Copyright (c) 2011, David Clark, All Rights Reserved   //
//////////////////////////////////////////////////////////////////////

echo '<h3>'.$tour->title.'</h3><a href="'.adminurl('TourAdmin/edit').'/'.$tour->id.'"><b>Click to Edit</b></a><hr />';
    $flights = unserialize($tour->flights);
    if($tour->image == '')
    {echo 'No Image Available';}
    else
    {echo '<center><img src="'.$tour->image.'" alt="'.$tour->title.'" style="max-width:350px;" /></center>';}
    echo '<hr />';
    echo '<h4><b>Tour Status:</b> ';
    if($tour->active == '0'){echo '<font color="#FF0000"><b> Hidden</b></font></td></h4>';}
    if($tour->active == '1'){echo '<font color="#00FF00"><b> Active</b></font></td></h4>';}
    if($tour->active == '2'){echo '<font color="#FBB917"><b> Completed</b></font></td></h4>';}
    if($tour->active == '3'){echo '<font color="#FBB917"><b> Upcoming</b></font></td></h4>';}
    echo '<b>Description:</b><br /> '.$tour->description.'<br />';
    
?>
<center><h4><b>Tour Flights</b></h4></center>
<table width="100%" border="1px" cellpadding="1px">
    <thead>
        <tr>
            <th>Leg</th>
            <th>Departure</th>
            <th>Arrival</th>
            <th>Flight</th>
            <th>Aircraft</th>
            <th>Distance</th>
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
<br />
<center><h4><b>Pilot's Progress</h4></b></b></center>
<table width="100%" border="1px" cellpadding="1px">
    <thead>
        <tr bgcolor="#E3E4FA">
            <?php
            $start = SchedulesData::getSchedule($flights[0]);
                $i=0;
                echo '<th width="25%">START<br />'.$start->depicao.'</th>';
            foreach($flights as $flight)
            {
                $i++;
                $leg = SchedulesData::getSchedule($flight);
                echo '<th>Leg: '.$i.'<br />To: '.$leg->arricao.'</th>';
            }
            echo '<th>Delete<br />Record</th>';
            ?>
        </tr>
    </thead>
    <tbody>
        <?php
            if(!$pilotdata)
            {echo '<tr><td colspan="'.($i + 1).'">No Pilots Have Signed Up For This Tour</td></tr>';}
            else
            {
                foreach($pilotdata as $data)
                {
                    $progress = unserialize($data->data);
                    $pilot = PilotData::getPilotData($data->pilotid);
                    if($pilot->retired == TRUE){continue;}
                    echo '<tr>';
                        echo '<td bgcolor="#E3E4FA"><center>'.$pilot->firstname.' '.$pilot->lastname.' - '.PilotData::getPilotCode($pilot->code, $pilot->pilotid).'</center></td>';
                        foreach($progress as $leg)
                        {
                            if($leg == 0)
                            {echo '<td>&nbsp;';}
                            else
                            {
                                $pirep = PIREPData::getReportDetails($leg);
                                echo '<td bgcolor="#E3E4FA"><a href="'.url('pireps/view').'/'.$pirep->pirepid.'">';
                                echo '<center><b><font size="1">Completed:<br />'.date ('m/d/Y', $pirep->submitdate).'</font></b></center>';
                                echo '</a>';
                            }
                            echo '</td>';
                        }
                    echo '<td><a href="'.adminurl('/TourAdmin/delete_pilot_record').'/'.$data->id.'/'.$tour->id.' "onclick="return confirm(\'Are you sure you want to delete this pilot from the tour? This action can not be reversed.\')"><b>Delete Record</b></a></td>';
                    echo '</tr>';
                }
            }
        ?>
    </tbody>
</table>
<br /><br />