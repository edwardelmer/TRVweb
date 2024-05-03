<?php
// Read the JSON file 
$ivao = file_get_contents('whazzup.json');
$start=stripos($ivao,"pilots");
$end=stripos($ivao,"atcs");
 
$ivao_pilots = substr($ivao,$start-2,$end-$start)."}";
echo $ivao_pilots;


$json_array = json_decode($ivao);

foreach($json_array as $key => $arrays){
    echo $key . "<br />";
    foreach($arrays as $array){
        foreach($array as $key => $value){
            echo $key . " => " . $value . "<br />";
        }
    }
    echo "<br />";
}


?>