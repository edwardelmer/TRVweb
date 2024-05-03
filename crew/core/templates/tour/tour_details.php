<?php

//////////////////////////////////////////////////////////////////////
//simpilotgroup Tour 1.0 module for phpVMS virtual airline system   //
//@author David Clark (simpilot)                                    //
//@copyright Copyright (c) 2011, David Clark, All Rights Reserved   //
//////////////////////////////////////////////////////////////////////

$flights = unserialize($tour->flights);
    echo '<center><h6>Tour Details</h6></center>';
    echo '<table width="100%" border="1px">';
    echo '<tr><td>';
    echo '<center><h4>'.$tour->title.'</h4></center>';
    echo '<b>Status:</b> ';

    if($tour->active == '0'){echo '<font color="#FF0000"><b> Hidden</b></font><br />';}
    if($tour->active == '1'){echo '<font color="#00FF00"><b> Active</b></font><br />';}
    if($tour->active == '2'){echo '<font color="#FF0000"><b> Complete</b></font><br />';}
    if($tour->active == '3'){echo '<font color="#FF0000"><b> Upcoming</b></font><br />';}

    echo '<b>Description:</b> '.$tour->description.'<br />';
    if($tour->active == TRUE)
    {
        if(Auth::$loggedin)
        {
            
            if($tour->active == '2'){echo '<br /><b>Signups Closed</b><br />';}
            elseif($tour->active == '3'){echo '<br /><b>Signups Available After Tour Opens</b><br />';}
            elseif($tour->active == '1')
                {
                if(TourData::check_pilotsignup($tour->id) == 0)
                {echo '<br /><center><a href="'.url('tour/signup').'/'.$tour->id.'" text-decoration:underline;"><b>Signup For Tour</b></a></center>';}
                else
                {echo '<br /><center><u><b>You Are Signed Up For This Tour</b></u></center>';}
            }
        }
    }
    echo '</td><td>';
    if($tour->image == '')
    {echo 'No Image Available';}
    else
    {echo '<center><img src="'.$tour->image.'" alt="'.$tour->title.'" /></center>';}
    echo '</td></tr>';
    echo '</table>';
?>
<br />
<center><h2>Tour Flights</h2></center>
<table width="100%" border="1px" cellpadding="1px">
    <thead>
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
                echo '<td align="center">'.$i.'</td>';
                echo '<td>'.$dep->name.' ('.$dep->icao.')</td>';
                echo '<td>'.$arr->name.' ('.$arr->icao.')</td>';
                echo '<td>'.$leg->code . $leg->flightnum.'</td>';
                echo '<td>'.$leg->aircraft.'</td>';
                echo '<td>'.round($leg->distance, 0).' nm</td>';
                echo '</tr>';
                $totalmiles = $totalmiles + $leg->distance;
                $i++;
            }
        ?>
        <tr>
            <td colspan="6"><b>Total Distance Of Tour:</b> <?php echo round($totalmiles, 0); ?> nm</td>
        </tr>
    </tbody>
</table>
<br />
<center><h2>Pilot's Progress</h2>
Click * To View PIREP</center>
<table width="100%" border="1px">
    <thead>
        <tr>
            <?php
            $start = SchedulesData::getSchedule($flights[0]);
                $i=0;
                echo '<th colspan="2" width="25%">START: '.$start->depicao.'</th>';
            foreach($flights as $flight)
            {
                $i++;
                $leg = SchedulesData::getSchedule($flight);
                echo '<th>Leg: '.$i.' To: '.$leg->arricao.'</th>';
            }
            echo '<th>Complete</th>';
            $col_count= ($i++);
            ?>
        </tr>
    </thead>
    <tbody>
        <?php
            if(!$pilotdata)
            {echo '<tr><td colspan="'.($i + 1).'">No Pilots Have Signed Up For This Tour</td></tr>';}
            else
            {
                $pilot_count = 1;
                foreach($pilotdata as $data)
                {
                    $progress = unserialize($data->data);
                    $pilot = PilotData::getPilotData($data->pilotid);
                    $leg_count = 0;
                    if($pilot == ''){continue;}
                    if($pilot->retired == TRUE){continue;}
                    echo '<tr>';
                        echo '<th>'.$pilot_count.'</th>';
                        echo '<th>'.$pilot->firstname.' '.$pilot->lastname.' - '.PilotData::getPilotCode($pilot->code, $pilot->pilotid).'</td>';
                        foreach($progress as $leg)
                        {
                            if($leg == 0)
                            {echo '<td>&nbsp;';}
                            else
                            {
                                $pirep = PIREPData::getReportDetails($leg);
                                echo '<td bgcolor="#90EE90" align="center"><a href="'.url('pireps/view').'/'.$pirep->pirepid.'">';
                                echo '*</a>';
                                $leg_count++;
                            }
                            echo '</td>';
                        }
                        if($col_count == $leg_count)
                        {echo '<td>Tour Completed</td>';}
                        else
                        {echo '<td>&nbsp;</td>';}
                    echo '</tr>';
                    $pilot_count++;
                }
            }
        ?>    
    </tbody>
</table>