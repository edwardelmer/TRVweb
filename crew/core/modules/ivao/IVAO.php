<?php

require_once('../codon.config.php'); 
require_once('../local.config.php');
require_once("../common/NavData.class.php"); 
require_once("../common/ACARSData.class.php");




class IVAO extends CodonModule {
    function get_whazzup ()
        {
        $ivao = file_get_contents('whazzup.json');
        $json_array = json_decode($ivao, true);
        }
        
}
?>