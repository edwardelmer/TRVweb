<?php
//////////////////////////////////////////////////////////////////////
//simpilotgroup Tour 1.0 module for phpVMS virtual airline system   //
//@author David Clark (simpilot)                                    //
//@copyright Copyright (c) 2011, David Clark, All Rights Reserved   //
//////////////////////////////////////////////////////////////////////

echo '<table width="100%" border="1" cellpadding="10px">';
if(!$tours)
{echo '<tr><td>There Are No Tours Created</td></tr>';}
else
{
foreach($tours as $tour)
{
    $flights = unserialize($tour->flights);
    echo '<tr><td width=60% style="vertical-align:top">';
    echo '<h3><b>Tour :</b> '.$tour->title.'</h3>';
    echo '<h4><b>Status:</b> ';
    if($tour->active == '0'){echo '<font color="#FF0000"><b> Hidden</b></font><br /></h4>';}
    if($tour->active == '1'){echo '<font color="#00FF00"><b> Active</b></font><br /></h4>';}
    if($tour->active == '2'){echo '<font color="#FF0000"><b> Completed</b></font><br /></h4>';}
    if($tour->active == '3'){echo '<font color="#FF0000"><b> Upcoming</b></font><br /></h4>';}
    echo '</b> ';
    if($tour->image == '')
    {echo 'No Image Available';}
    else
    {echo '<br /><img src="'.$tour->image.'" alt="'.$tour->title.'" style="max-height:200px;" /><br />';
    echo '<br /><h4><b>Description:</b></h4><br />'.$tour->description.'<br /><br />';}
    echo '</td><td width=25% style="vertical-align:top">';
    echo '<h4><b>Flights:</b></h4><br />';
    $i = 1;
    foreach($flights as $flight)
    {
        $schedule = SchedulesData::getSchedule($flight);
        echo '<b>Leg '.$i.' :</b> '.$schedule->code . $schedule->flightnum.' - '.$schedule->depicao.' to '.$schedule->arricao.'<br />';
        $i++;
    }
    echo '</td><td style="vertical-align:top">';
    echo '<a href="'.adminurl('TourAdmin/view_tour').'/'.$tour->id.'"><b>Tour Details</b></a><br />';
    echo '<a href="'.adminurl('TourAdmin/edit').'/'.$tour->id.'"><b>Edit Tour</b></a><br />';
    echo '<a href="'.adminurl('TourAdmin/delete').'/'.$tour->id.'" onclick="return confirm(\'Are you sure you want to delete this tour? It will delete the tour and any associated records.\')"><font color="#FF0000"><b>Delete</b></font></a>';
    echo '</td></tr>';
}
}
echo '</table>';
?>