<?php
$this->show('hub/hub_header.php');

echo 'Click On Hub ICAO For Details/Editing<hr />';

echo '<h4>'. SITE_NAME .' Hubs</h4><hr />';
    if(!$hubs)
    {
     echo 'No Hubs found';

    }
    else
    {
  		echo '<table width="100%">';
    echo '<tr><td width="30%"><u>Hub ICAO</u></td><td width="60%"><u>Airport Name</u></td></tr>';

    foreach($hubs as $hub)
    {
        echo '<tr><td><a href="'.SITE_URL.'/admin/index.php/Hub_admin/get_hubs?icao='.$hub->icao.'">'.$hub->icao.'</a></td>';
        echo '<td>'. $hub->name .'</td></tr>';
    }

    echo '</table>';

    }

?>
