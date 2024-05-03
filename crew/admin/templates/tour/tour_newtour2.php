<?php

//////////////////////////////////////////////////////////////////////
//simpilotgroup Tour 1.0 module for phpVMS virtual airline system   //
//@author David Clark (simpilot)                                    //
//@copyright Copyright (c) 2011, David Clark, All Rights Reserved   //
//////////////////////////////////////////////////////////////////////

echo 'Leg '.$leg.' of '.$legs.'<hr />';

$route = $_SESSION['route'];
//print_r($airports);
echo '<form action="'.adminurl('/TourAdmin/build_tour').'" method="post" enctype="multipart/form-data">';

if($leg == 1)
{
    echo 'The tour will start at <b>'.$start->name.' ('.$start->icao.')</b>';
    echo '<br /><br />';
    echo '<select name="arrival">';
    echo '<option value ="">Destination for leg '.$leg.'</option>';
    foreach ($airports as $airport) {
        if($start->icao == $airport->arricao){continue;}
        $airfield = OperationsData::getAirportInfo($airport->arricao);
        echo '<option value="'.$airfield->icao.'">'.$airfield->icao.' - '.$airfield->name.' - '.$airfield->country.'</option>';
    }
    echo '</select>';
}
else
{
    echo '<table width="100%" border="1" cellpadding="5px">';
    $i = 0;
    while($i < ($leg - 1)):
        echo '<tr>';
        echo '<td width="20%">Leg: '.($i + 1).'</td>';
        echo '<td width="40%">'.$route[$i]->icao.' -'.$route[$i]->name.'</td>';
        echo '<td width="40%">'.$route[($i + 1)]->icao.' - '.$route[($i + 1)]->name.'</td>';
        echo '</tr>';
        $i++;
    endwhile;

    echo '<tr>';
    echo '<td>Leg: '.($i + 1).'</td>';
    echo '<td>'.$route[($i)]->icao.' - '.$route[($i)]->name.'</td>';
    echo '<td>';


    echo '<select name="arrival">';
    echo '<option value ="">Destination for leg '.$leg.'</option>';
    foreach ($airports as $airport) {
        if($route[($i)]->icao == $airport->arricao){continue;}
        $airfield = OperationsData::getAirportInfo($airport->arricao);
        echo '<option value="'.$airfield->icao.'">'.$airfield->icao.' - '.$airfield->name.' - '.$airfield->country.'</option>';
    }
    echo '</select>';
    echo '</td>';
    echo '</tr>';
    echo '</table>';
}
echo '<br /><br />';
echo '<input type="hidden" name="leg" value="'.$leg.'" />';
echo '<input type="hidden" name="start" value="'.$start->icao.'" />';
echo '<input type="hidden" name="legs" value="'.$legs.'" />';
echo '<input type="hidden" name="function" value="flights" />';
echo '<input type="hidden" name="action" value="new_tour_2" />';
echo '<input type="submit" value="Save Legs">';
echo '</form>';
?>
