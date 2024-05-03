<?php

$online_data = file_get_contents('online_pilots.json');

$obj = json_decode($online_data);

foreach($obj as $key => $value) {
  echo $key . " => " . $value . "<br>";
}
?>
