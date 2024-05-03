<?php

//////////////////////////////////////////////////////////////////////
//simpilotgroup Tour 1.0 module for phpVMS virtual airline system   //
//@author David Clark (simpilot)                                    //
//@copyright Copyright (c) 2011, David Clark, All Rights Reserved   //
//////////////////////////////////////////////////////////////////////

echo '<center><h6>'.SITE_NAME.' Tours</h6></center>';
if($tours)
{
echo '<table width="100%" border="1px">';
foreach($tours as $tour)
{
    if($tour->active == '0'){continue;}
    $flights = unserialize($tour->flights);
    echo '<tr>';
    echo '<td width="25%">';
    echo '<center><h2>'.$tour->title.'</h2></center>';
    echo '<b>Status:</b> ';
    if($tour->active == '1'){echo '<font color="#00FF00"><b> Active</b></font>';}
    if($tour->active == '2'){echo '<font color="#FF0000"><b> Complete</b></font>';}
    if($tour->active == '3'){echo '<font color="#FF0000"><b> Upcoming</b></font>';}
    echo '<br /><b>Description:</b> '.$tour->description.'<br />';
    echo '<b>Participants:</b> '.TourData::participants($tour->id).'<br />';
    echo '<br /><a href="'.url('tour/details').'/'.$tour->id.'" text-decoration:underline;"><b>View Details</b></a>';
    echo '</td><td>';
    if($tour->image == '')
    {echo 'No Image Available';}
    else
    {echo '<center><img src="'.$tour->image.'" alt="'.$tour->title.'" style="max-width:400px;" /></center>';}
    echo '</td>';
    echo '<td>';
    echo '<b>Flights:</b><br />';
    $i = 1;
    foreach($flights as $flight)
    {
        $schedule = SchedulesData::getSchedule($flight);
        echo 'Leg: '.$i.' - '.$schedule->code . $schedule->flightnum.' - '.$schedule->depicao.' to '.$schedule->arricao.'<br />';
        $i++;
    }
    echo '</td>';
    echo '</tr>';
}
echo '</table>';
}
else
{echo 'No Tours Have Been Created.';}
?>