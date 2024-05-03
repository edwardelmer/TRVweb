<?php

$this->show('hub/hub_header.tpl');
echo '<h4>Hub:'.$hubs->icao.' - '.$hubs->name.'</h4><hr />';



echo 'Airport Name: <b>'.$hubs->name.'</b><hr />';

echo '</b><hr />';
echo '<a href="'.SITE_URL.'/admin/index.php/Hub_admin/edit_hub?icao='.$hubs->icao.'"><b>Edit Hub</b></a><br /><hr />';
echo '<a href="'.SITE_URL.'/admin/index.php/Hub_admin/delete_hub?icao='.$hubs->icao.'"><b>Delete Hub</b></a> - This will delete the Hub from the database permanently!<br /><hr />';
?>