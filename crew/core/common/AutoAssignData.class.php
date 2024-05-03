<?php class AutoAssignData extends CodonModule {

public static function savesettings($enabled, $defaultstate, $assignmode, $howmany, $creationinterval, $deleteopen, $useranklimit, $maxtime, $tohubonly, $onlyonce, $sendemail, $allowprefac, $pilotreject, $pilinstacreate, $airlines)
{
$sql = "UPDATE autoassign_settings SET enabled = '$enabled', defaultstate = '$defaultstate', assignmode = '$assignmode', howmany = '$howmany', creationinterval = '$creationinterval', deleteopen = '$deleteopen', useranklimit = '$useranklimit', maxtime = '$maxtime', tohubonly = '$tohubonly', onlyonce = '$onlyonce', sendemail = '$sendemail', allowprefac = '$allowprefac', pilotreject = '$pilotreject', pilinstacreate = '$pilinstacreate', airlines = '$airlines' WHERE id = '1'";

DB::query($sql);

}

public static function savepilsettings($enabled, $defaultstate, $assignmode, $howmany, $creationinterval, $deleteopen, $useranklimit, $maxtime, $tohubonly, $onlyonce, $sendemail, $allowprefac, $pilotreject, $pilinstacreate, $airlines, $pilotenabled, $selectedairline, $prefac, $prefdepicao, $pilotid)
{
$sql = "UPDATE autoassign_settings SET enabled = '$enabled', defaultstate = '$defaultstate', assignmode = '$assignmode', howmany = '$howmany', creationinterval = '$creationinterval', deleteopen = '$deleteopen', useranklimit = '$useranklimit', maxtime = '$maxtime', tohubonly = '$tohubonly', onlyonce = '$onlyonce', sendemail = '$sendemail', allowprefac = '$allowprefac', pilotreject = '$pilotreject', pilinstacreate = '$pilinstacreate', airlines = '$airlines', pilotenabled = '$pilotenabled', selectedairline = '$selectedairline', prefac = '$prefac', prefdepicao = '$prefdepicao'  WHERE pilotid = '$pilotid'";

DB::query($sql);

}

public static function createsettings()
{

$airlines = self::getallairlines();

$airlines2 = array();

if(count($airlines) > '1')
{
foreach ($airlines as $airline) {
    $airlines2[] = $airline->code;
}

$airlines3 = implode(':', $airlines2);
}
else
{
$airlines3 = $airlines[0]->code;
}

$sql = "INSERT INTO autoassign_settings (id, enabled, defaultstate, assignmode, howmany, creationinterval, deleteopen, useranklimit, maxtime, tohubonly, onlyonce, sendemail, allowprefac, pilotreject, pilinstacreate, airlines) VALUES ('1', '0', '1', '0', '4', '7', '1', '1', '4', '1', '1', '0', '1', '1', '0', '$airlines3')";

DB::query($sql);

}

public static function newspilsettings($enabled, $defaultstate, $assignmode, $howmany, $creationinterval, $deleteopen, $useranklimit, $maxtime, $tohubonly, $onlyonce, $sendemail, $allowprefac, $pilotreject, $pilinstacreate, $airlines, $pilotenabled, $selectedairline, $prefac, $prefdepicao, $pilotid)
{

$sql = "INSERT INTO autoassign_settings (enabled, defaultstate, assignmode, howmany, creationinterval, deleteopen, useranklimit, maxtime, tohubonly, onlyonce, sendemail, allowprefac, pilotreject, pilinstacreate, airlines, pilotenabled, selectedairline, prefac, prefdepicao, pilotid) VALUES ('$enabled', '$defaultstate', '$assignmode', '$howmany', '$creationinterval', '$deleteopen', '$useranklimit', '$maxtime', '$tohubonly', '$onlyonce', '$sendemail', '$allowprefac', '$pilotreject', '$pilinstacreate', '$airlines', '$pilotenabled', '$selectedairline', '$prefac', '$prefdepicao', '$pilotid')";
DB::query($sql);

}


public static function getsettings() {

$sql = "SELECT * FROM autoassign_settings WHERE id = '1'";

return DB::get_row($sql);

}

public static function getpilotsettings($pilotid) {

$sql = "SELECT * FROM autoassign_settings WHERE pilotid = '$pilotid'";

return DB::get_row($sql);

}

public static function getallairlines()
{
$sql = "SELECT * FROM ".TABLE_PREFIX."airlines WHERE enabled > '0'";
return DB::get_results($sql);
}

public static function getactivepilots()
{
$sql = "SELECT * FROM ".TABLE_PREFIX."pilots WHERE retired = '0'";
return DB::get_results($sql);
}

public static function getpilotinfo($pilotid)
{
$sql = "SELECT * FROM ".TABLE_PREFIX."pilots WHERE pilotid = '$pilotid'";
return DB::get_row($sql);
}

public static function getassignments($pilotid) {

$sql = "SELECT a.id as assignid, a.itinerary as itid, s.*, ac.name as aircraftname, ac.icao as aircrafticao, ac.registration, dep.name as depname, arr.name as arrname FROM autoassign_current a 
LEFT JOIN ".TABLE_PREFIX."schedules s ON s.id = a.schedid
LEFT JOIN ".TABLE_PREFIX."aircraft ac ON ac.id = s.aircraft 
LEFT JOIN ".TABLE_PREFIX."airports dep ON s.depicao = dep.icao 
LEFT JOIN ".TABLE_PREFIX."airports arr ON s.arricao = arr.icao 
WHERE a.pilotid = '$pilotid' AND a.active != '0'  ORDER BY a.id ASC";
return DB::get_results($sql);

}

public static function getlatestassignments($pilotid) {
$sql = "SELECT * FROM autoassign_current WHERE pilotid = '$pilotid' AND `active` = '1'  ORDER BY id ASC";
return DB::get_results($sql);
}

public function getstartitineraryid($pilotid)
{
$sql = "SELECT itinerary FROM autoassign_current WHERE pilotid = '$pilotid' AND `active` != '0' GROUP BY itinerary ORDER BY itinerary DESC LIMIT 1";
$itid = DB::get_row($sql);
if($itid)
 {
return $itid->itinerary;
 }
 else
 {
 return 1;
 }
}

public static function setopenflightstoinactive($pilotid, $value)
{
	$sql = "UPDATE autoassign_current SET `active` = '$value' WHERE pilotid = '$pilotid' AND `active` = '1'";
	 DB::query($sql);
}
	

public static function checkaircraftinairline($airline, $aircraft)
{
	$sql = "SELECT s.id FROM ".TABLE_PREFIX."schedules s LEFT JOIN ".TABLE_PREFIX."aircraft a ON a.id = s.aircraft WHERE s.code = '$airline' AND a.icao = '$aircraft' LIMIT 1";
	return DB::get_row($sql);
}
	

public static function getrandaircraftinairline($airline)
{
	$sql = "SELECT a.icao FROM ".TABLE_PREFIX."schedules s LEFT JOIN ".TABLE_PREFIX."aircraft a ON a.id = s.aircraft WHERE s.code = '$airline' ORDER BY RAND() LIMIT 1";
	$res = DB::get_row($sql);
	return $res->icao;
}


public static function searchflightsmethodA($ranklevel = '0', $acicao='', $depicao, $arricao, $mingrountime, $maxgroundtime, $weekday = '', $order = 'RAND(), s1.deptime, s2.arrtime', $airline, $domestic = '0', $maxfltime = '3', $unique = '1')
{
    
    if($maxfltime < 10)
    {
    $maxfltime = '0'.$maxfltime.'.00';
    }
    else
    {
    $maxfltime = $maxfltime.'.00';
    }
	
	if(!$arricao)
	{
		$arricao = $depicao;
	}
	if(!$mingrountime)
	{
		$mingrountime = '00:30:00';
	}
	if(!$maxgroundtime)
	{
		$maxgroundtime = '900'; // 8 Hours
	}
	$nextweekday = $weekday + 1;
	if($nextweekday > 6)
	{
		$nextweekday = '0';
	}
	$weekday = str_replace('7','0', $weekday);
	
$sql = "SELECT s1.id as schedAid, s2.id as schedBid FROM ".TABLE_PREFIX."schedules s1
INNER JOIN ".TABLE_PREFIX."schedules s2 ON s1.arricao = s2.depicao 
LEFT JOIN ".TABLE_PREFIX."aircraft as ac1 ON ac1.id = s1.aircraft
LEFT JOIN ".TABLE_PREFIX."aircraft as ac2 ON ac2.id = s2.aircraft
LEFT JOIN ".TABLE_PREFIX."airports as dep1 ON dep1.icao = s1.depicao
LEFT JOIN ".TABLE_PREFIX."airports as dep2 ON dep2.icao = s2.depicao
LEFT JOIN ".TABLE_PREFIX."airports as arr1 ON arr1.icao = s1.arricao
LEFT JOIN ".TABLE_PREFIX."airports as arr2 ON arr2.icao = s2.arricao
WHERE s1.depicao = '$depicao' AND s2.arricao = '$arricao'
AND s1.arricao != s1.depicao
AND s2.arricao != s2.depicao
AND ((
REPLACE(ADDTIME(STR_TO_DATE(REPLACE(SUBSTR(TRIM(s1.arrtime),1,5),':',''), '%H%i'), '$mingrountime'), '24', '00') < REPLACE(STR_TO_DATE(REPLACE(SUBSTR(TRIM(s2.deptime),1,5),':',''), '%H%i'), '', '')
AND (REPLACE(SUBSTR(TRIM(s2.deptime),1,5),':','')) - REPLACE(SUBSTR(TRIM(s1.arrtime),1,5),':','') < $maxgroundtime
AND s1.daysofweek LIKE '%$weekday%' AND s2.daysofweek LIKE '%$weekday%'
)
OR
(
SUBSTR(TRIM(s1.arrtime ),1,2) > '22'
AND s1.daysofweek LIKE '%$weekday%' AND s2.daysofweek LIKE '%$nextweekday%'
))
AND s1.flighttime < '$maxfltime' AND s2.flighttime < '$maxfltime'
AND (ac1.icao LIKE '%$acicao%') AND (ac2.icao LIKE '%$acicao%')
AND (s1.code LIKE '%$airline%') AND (s2.code LIKE '%$airline%')
AND (ac1.ranklevel <= '$ranklevel') AND (ac2.ranklevel <= '$ranklevel')";

if($unique != '0')
{
$sql .= "AND s1.id NOT IN (SELECT schedid FROM autoassign_current WHERE `active` != '0') AND s2.id NOT IN (SELECT schedid FROM autoassign_current WHERE `active` != '0')";
}


if($domestic != '0')
{
$sql .= "AND SUBSTR(TRIM(s1.arricao),1,2) = SUBSTR(TRIM(s1.depicao),1,2) AND SUBSTR(TRIM(s2.arricao),1,2) = SUBSTR(TRIM(s2.depicao),1,2)";
}

$sql .= "
ORDER BY $order
LIMIT 1";

return DB::get_row($sql);	
}


public static function searchflightsmethodB($ranklevel = '0', $acicao='', $depicao, $arricao, $mingrountime, $maxgroundtime, $weekday = '', $order = 'RAND(), s1.deptime, s4.arrtime', $airline, $domestic = '0', $maxfltime = '3', $unique = '1')
{
	if($maxfltime < 10)
    {
    $maxfltime = '0'.$maxfltime.'.00';
    }
    else
    {
    $maxfltime = $maxfltime.'.00';
    }
    
	if(!$arricao)
	{
		$arricao = $depicao;
	}
	if(!$mingrountime)
	{
		$mingrountime = '00:30:00';
	}
	if(!$maxgroundtime)
	{
		$maxgroundtime = '900'; // 9 Hours
	}
	
	$nextweekday = $weekday + 1;
	if($nextweekday > 6)
	{
		$nextweekday = '0';
	}
	$weekday = str_replace('7','0', $weekday);
	
$sql = "SELECT s1.id as schedAid, s2.id as schedBid, s3.id as schedCid, s4.id as schedDid FROM ".TABLE_PREFIX."schedules s1
INNER JOIN ".TABLE_PREFIX."schedules s2 ON s2.depicao = s1.arricao 
INNER JOIN ".TABLE_PREFIX."schedules s3 ON s3.depicao = s2.arricao 
INNER JOIN ".TABLE_PREFIX."schedules s4 ON s4.depicao = s3.arricao 
LEFT JOIN ".TABLE_PREFIX."aircraft as ac1 ON ac1.id = s1.aircraft
LEFT JOIN ".TABLE_PREFIX."aircraft as ac2 ON ac2.id = s2.aircraft
LEFT JOIN ".TABLE_PREFIX."aircraft as ac3 ON ac3.id = s3.aircraft
LEFT JOIN ".TABLE_PREFIX."aircraft as ac4 ON ac4.id = s4.aircraft
LEFT JOIN ".TABLE_PREFIX."airports as dep1 ON dep1.icao = s1.depicao
LEFT JOIN ".TABLE_PREFIX."airports as dep2 ON dep2.icao = s2.depicao
LEFT JOIN ".TABLE_PREFIX."airports as dep3 ON dep3.icao = s3.depicao
LEFT JOIN ".TABLE_PREFIX."airports as dep4 ON dep4.icao = s4.depicao
LEFT JOIN ".TABLE_PREFIX."airports as arr1 ON arr1.icao = s1.arricao
LEFT JOIN ".TABLE_PREFIX."airports as arr2 ON arr2.icao = s2.arricao
LEFT JOIN ".TABLE_PREFIX."airports as arr3 ON arr3.icao = s3.arricao
LEFT JOIN ".TABLE_PREFIX."airports as arr4 ON arr2.icao = s4.arricao
WHERE s1.depicao = '$depicao' AND s4.arricao = '$arricao'
AND s1.arricao != s1.depicao
AND s2.arricao != s2.depicao
AND s3.arricao != s3.depicao
AND s2.arricao != s1.depicao
AND s3.arricao != s1.depicao
AND REPLACE(ADDTIME(STR_TO_DATE(REPLACE(SUBSTR(TRIM(s1.arrtime),1,5),':',''), '%H%i'), '$mingrountime'), '24', '00') < REPLACE(STR_TO_DATE(REPLACE(SUBSTR(TRIM(s2.deptime),1,5),':',''), '%H%i'), '', '')
AND REPLACE(ADDTIME(STR_TO_DATE(REPLACE(SUBSTR(TRIM(s2.arrtime),1,5),':',''), '%H%i'), '$mingrountime'), '24', '00') < REPLACE(STR_TO_DATE(REPLACE(SUBSTR(TRIM(s3.deptime),1,5),':',''), '%H%i'), '', '')
AND REPLACE(ADDTIME(STR_TO_DATE(REPLACE(SUBSTR(TRIM(s3.arrtime),1,5),':',''), '%H%i'), '$mingrountime'), '24', '00') < REPLACE(STR_TO_DATE(REPLACE(SUBSTR(TRIM(s4.deptime),1,5),':',''), '%H%i'), '', '')
AND (REPLACE(SUBSTR(TRIM(s2.deptime),1,5),':','')) - REPLACE(SUBSTR(TRIM(s1.arrtime),1,5),':','') < $maxgroundtime
AND (REPLACE(SUBSTR(TRIM(s3.deptime),1,5),':','')) - REPLACE(SUBSTR(TRIM(s2.arrtime),1,5),':','') < $maxgroundtime
AND (REPLACE(SUBSTR(TRIM(s4.deptime),1,5),':','')) - REPLACE(SUBSTR(TRIM(s3.arrtime),1,5),':','') < $maxgroundtime
AND s1.daysofweek LIKE '%$weekday%' AND (s2.daysofweek LIKE '%$weekday%' OR s2.daysofweek LIKE '%$nextweekday%') AND (s3.daysofweek LIKE '%$weekday%' OR s3.daysofweek LIKE '%$nextweekday%') AND (s4.daysofweek LIKE '%$weekday%' OR s4.daysofweek LIKE '%$nextweekday%')
AND s1.flighttime < '$maxfltime' AND s2.flighttime < '$maxfltime' AND s3.flighttime < '$maxfltime' AND s4.flighttime < '$maxfltime'
AND (ac1.icao LIKE '%$acicao%') AND (ac2.icao LIKE '%$acicao%') AND (ac3.icao LIKE '%$acicao%') AND (ac4.icao LIKE '%$acicao%')
AND (s1.code LIKE '%$airline%') AND (s2.code LIKE '%$airline%') AND (s3.code LIKE '%$airline%') AND (s4.code LIKE '%$airline%')
AND (ac1.ranklevel <= '$ranklevel') AND (ac2.ranklevel <= '$ranklevel') AND (ac3.ranklevel <= '$ranklevel') AND (ac4.ranklevel <= '$ranklevel')";

if($unique != '0')
{
$sql .= "AND s1.id NOT IN (SELECT schedid FROM autoassign_current WHERE `active` != '0') AND s2.id NOT IN (SELECT schedid FROM autoassign_current WHERE `active` != '0') AND s3.id NOT IN (SELECT schedid FROM autoassign_current WHERE `active` != '0') AND s4.id NOT IN (SELECT schedid FROM autoassign_current WHERE `active` != '0')";
}

if($domestic != '0')
{
$sql .= "AND SUBSTR(TRIM(s1.arricao),1,2) = SUBSTR(TRIM(s1.depicao),1,2) AND SUBSTR(TRIM(s2.arricao),1,2) = SUBSTR(TRIM(s2.depicao),1,2) AND SUBSTR(TRIM(s3.arricao),1,2) = SUBSTR(TRIM(s3.depicao),1,2) AND SUBSTR(TRIM(s4.arricao),1,2) = SUBSTR(TRIM(s4.depicao),1,2)";
}

$sql .= "
ORDER BY $order
LIMIT 1";

return DB::get_row($sql);	
}
    
public static function searchflightsmethodC($ranklevel = '0', $acicao='', $depicao, $arricao, $mingrountime, $maxgroundtime, $weekday = '', $order = 'RAND(), s1.deptime, s2.arrtime', $airline, $domestic = '0', $maxfltime = '3', $unique = '1')
{
    
    if($maxfltime < 10)
    {
    $maxfltime = '0'.$maxfltime.'.00';
    }
    else
    {
    $maxfltime = $maxfltime.'.00';
    }
	
	if(!$arricao)
	{
		$arricao = $depicao;
	}
	if(!$mingrountime)
	{
		$mingrountime = '00:30:00';
	}
	if(!$maxgroundtime)
	{
		$maxgroundtime = '900'; // 8 Hours
	}
	$nextweekday = $weekday + 1;
	if($nextweekday > 6)
	{
		$nextweekday = '0';
	}
	$weekday = str_replace('7','0', $weekday);
	
$sql = "SELECT s1.id as schedAid, s2.id as schedBid FROM ".TABLE_PREFIX."schedules s1
INNER JOIN ".TABLE_PREFIX."schedules s2 ON s1.arricao = s2.depicao 
LEFT JOIN ".TABLE_PREFIX."aircraft as ac1 ON ac1.id = s1.aircraft
LEFT JOIN ".TABLE_PREFIX."aircraft as ac2 ON ac2.id = s2.aircraft
LEFT JOIN ".TABLE_PREFIX."airports as dep1 ON dep1.icao = s1.depicao
LEFT JOIN ".TABLE_PREFIX."airports as dep2 ON dep2.icao = s2.depicao
LEFT JOIN ".TABLE_PREFIX."airports as arr1 ON arr1.icao = s1.arricao
LEFT JOIN ".TABLE_PREFIX."airports as arr2 ON arr2.icao = s2.arricao
WHERE s1.depicao = '$depicao' AND s2.arricao = '$arricao'
AND s1.arricao != s1.depicao
AND s2.arricao != s2.depicao
AND s1.flighttime < '$maxfltime' AND s2.flighttime < '$maxfltime'
AND (s1.code LIKE '%$airline%') AND (s2.code LIKE '%$airline%')
AND (ac1.icao LIKE '%$acicao%')";

if($unique != '0')
{
$sql .= "AND s1.id NOT IN (SELECT schedid FROM autoassign_current WHERE `active` != '0') AND s2.id NOT IN (SELECT schedid FROM autoassign_current WHERE `active` != '0')";
}


if($domestic != '0')
{
$sql .= "AND SUBSTR(TRIM(s1.arricao),1,2) = SUBSTR(TRIM(s1.depicao),1,2) AND SUBSTR(TRIM(s2.arricao),1,2) = SUBSTR(TRIM(s2.depicao),1,2)";
}

$sql .= "
ORDER BY $order
LIMIT 1";

return DB::get_row($sql);	
}

public static function getrandomdepicao($acicao = '', $airline = '')
{
	$sql = "SELECT s.depicao FROM ".TABLE_PREFIX."schedules s LEFT JOIN ".TABLE_PREFIX."aircraft a ON s.aircraft = a.id WHERE s.code LIKE '%$airline%' AND a.icao LIKE '%$acicao%' ORDER BY RAND() LIMIT 1";
	$apt = DB::get_row($sql);
	return $apt->depicao;
}

public static function addnewassignment($pilotid, $schedid, $assigndate, $active, $itid)
{
	$sql = "INSERT INTO autoassign_current (pilotid, schedid, assigndate, `active`, itinerary) VALUES ('$pilotid', '$schedid', '$assigndate', '$active', '$itid')";
	 DB::query($sql);
}


	public static function deleteallassignments()
		{
			$sql="TRUNCATE TABLE autoassign_current";
			DB::query($sql);
		}
		
		public static function cancelflight($aid)
		{
			$sql="DELETE FROM autoassign_current WHERE id = '$aid'";
			DB::query($sql);
		}
		
		public static function delpilassignments($pilotid)
		{
			$sql="DELETE FROM autoassign_current WHERE pilotid = '$pilotid'";
			DB::query($sql);
		}
		
		public static function isflightbooked($pilotid, $flightid)
		{
			$sql = "SELECT * FROM ".TABLE_PREFIX."bids WHERE pilotid = '$pilotid' AND routeid = '$flightid' LIMIT 1";
	        return DB::get_row($sql);
		}
		
		public static function getAircraftforPilot($pilotid)
		{
			$setting = self::getsettings();
			
		if($setting->useranklimit == '1')
		{
		    $userranklvl = Auth::$userinfo->ranklevel;
		}
		else
		{
			$userranklvl = '99999999';
		}
		
			$sql="SELECT * FROM ".TABLE_PREFIX."aircraft WHERE enabled != '0' AND (ranklevel <= '$userranklvl' OR ranklevel = '0') GROUP BY icao ORDER BY icao ASC";
			return DB::get_results($sql);
			
		}
		
		public static function suidepapts()
		{
			$sql = "SELECT s.depicao, a.name FROM ".TABLE_PREFIX."schedules s LEFT JOIN ".TABLE_PREFIX."airports a ON s.depicao = a.icao GROUP BY s.depicao HAVING COUNT(s.depicao) > 10 ORDER by s.depicao";
	        return DB::get_results($sql);
		}
		
		public static function deletepilotsettings()
		{
			$sql="DELETE FROM autoassign_settings WHERE id != '1'";
			DB::query($sql);
		}
		
		public static function deletepilotsindisettings($pilotid)
		{
			$sql="DELETE FROM autoassign_settings WHERE pilotid = '$pilotid'";
			DB::query($sql);
		}
		
		public static function getlastcreationdate($pilotid)
{
	$sql = "SELECT assigndate FROM autoassign_current WHERE pilotid = '$pilotid' AND active = '1' ORDER BY assigndate DESC LIMIT 1";
	$date = DB::get_row($sql);
	return $date->assigndate;
}

public static function getallschedules()
{
	$sql="SELECT s.*, a.icao, a.registration FROM ".TABLE_PREFIX."schedules s LEFT JOIN ".TABLE_PREFIX."aircraft a ON a.id = s.aircraft ORDER BY s.code, s.flightnum ASC";
	return DB::get_results($sql);
}
		

public static function converttime($time)
{
	return sprintf('%02d:%02d', (int) $time, round(fmod($time, 1) * 60));
}

} ?>
