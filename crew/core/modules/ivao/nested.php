<?php
$ivao = file_get_contents('whazzup.json');
$string = file_get_contents('whazzup.json');
$ivao_data = json_decode($ivao, true);

//uncomment below for quick data check
//print_r ($ivao_data['clients']['atcs']);
//print_r ($ivao_data['clients']['atcs']);
//$data_array = $ivao_data['clients']['atcs'];

/*
//ATC Data
echo "ATC Data<br/>";
foreach($ivao_data['clients']['atcs'] as $elem)  {
   echo("VID : ".$elem['userId']."<br>");
   echo("- Logged as : ".$elem['callsign']."<br>");
   echo("- ATC Position : ".$elem['atcSession']['position']."<br>");
   echo("- Radio Callsign :".$elem['atis']['lines']['1']."<br>");
   echo("- Frequency : ".$elem['atcSession']['frequency']."<br>" );
   echo("- ATIS Info :".$elem['atis']['revision']."<br>");
   echo("- ATIS Box :<br>");
   foreach ($elem['atis']['lines'] as $line) {
       echo $line." |<br/>";
       
   }
   echo("<br/>");
}




//Pilot Data
echo "Pilot Data<br/>";
foreach($ivao_data['clients']['pilots'] as $elem)  {
   echo($elem['callsign']." flown by ".$elem['userId']." on ".$elem['serverId'].".<br>");
   echo("<br>Flight Plan"."<br>");
   echo("- Aircraft : ".$elem['flightPlan']['aircraftId']."<br>");
   echo("- Departure : ".$elem['flightPlan']['departureId']."<br>");
   echo("- Arrival : ".$elem['flightPlan']['arrivalId']."<br>");
   echo("- Alternate : ".$elem['flightPlan']['alternativeId']."<br>" );
   echo("- Alternate : ".$elem['flightPlan']['alternative2Id']."<br>" );
   echo("- Route : ".$elem['flightPlan']['route']."<br>");
   echo("- Remarks : ".$elem['flightPlan']['remarks']."<br>");
   echo("- A/C ICAO : ".$elem['flightPlan']['aircraft']['icaoCode']."<br>");
   echo("<br>Actual"."<br>");
   echo("- Altitude : ".$elem['lastTrack']['altitude']." feet.<br>");
   echo("- Ground Speed : ".$elem['lastTrack']['groundSpeed']." kts.<br>");
   echo("- Flight Status : ".$elem['lastTrack']['state']."<br>");
   echo("- Distance Flown : ".$elem['lastTrack']['departureDistance']." Nm.<br>");
   echo("- Distance Remaining : ".$elem['lastTrack']['arrivalDistance']." Nm.<br>");
   
}
*/



echo("END OF DATA <br/>");

//Pilot Data Selective
echo "Pilot Data Selective<br/>";
$ivao_pilots = $ivao_data['clients']['pilots'];
foreach($ivao_pilots as $elem)  {
   echo("- Callsign : ".$elem['callsign']."<br>");
   echo("- VID : ".$elem['userId']."<br>");
   echo("- Flight Status : ".$elem['lastTrack']['state']."<br>");
   echo "<br/>";
}

/*
//echo $ivao_data['clients']['pilots']['0']['callsign'];
/*Bulk Info*/
/*
// Define function
function get_ivao_pilots($ivao_data){

  foreach ($ivao_data as $key => $val) {
    if (is_array($val)) {
      get_ivao_pilots($val);

    } else {
       echo("$key = $val <br/>");
    }
  }
return;
}

// Call function
/*ATC Recursive*/
//print_recursive($ivao_data['clients']['atcs']);

/*Pilots Recursive*/

//get_ivao_pilots($ivao_data['clients']['pilots']);


//echo $ivao_data['clients']['pilots']['0']['callsign'];

/*OBS Recursive*/
//print_recursive($ivao_data['clients']['observers']);


// Recursive function to search by Key and Value
/*
function search_recursive_key_value($ivao_data, $searchkey, $searchval, $result=null){

   foreach ($ivao_data as $key => $val) {
      if (is_array($val)) {
           search_recursive_key_value($val, $searchkey, $searchval,  $result);

      } else {
           if ($key == $searchkey) {
              $result = $val;
           }

           if ($searchval == $val) {
              echo("$result => $val <br/>");
           }
      }
   }
return;
}
// Call function with a key to output and value to search
search_recursive_key_value($ivao_data['clients']['pilots'], 'userId', 'LFPO');


//Recursive function to search by value
function search_recursive_by_value($ivao_data, $searchval){
    $val = 'IRB102';
   foreach ($ivao_data['clients']['pilots'] as $key => $val) {
      if (is_array($val)) {
         search_recursive_by_value($val, $searchval);
         } else {
         if ($searchval == $val) {
            echo("$key :: $val <br/>");
         }
      }
   }
return;
}
// Call function with value to search as second argument
search_recursive_by_value($ivao_data['clients']['pilots'], 'DLH');
*/


?>

