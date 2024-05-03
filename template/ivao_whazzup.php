<?php

$site = 'https://api.ivao.aero/v2/tracker/whazzup';
$homepage = file_get_contents($site);
$filename = 'whazzup.json';
$handle = fopen($filename,"w");
fwrite($handle,$homepage);
fclose($handle);

?>