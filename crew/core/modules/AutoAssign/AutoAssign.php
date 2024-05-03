<?php class AutoAssign extends CodonModule {

public function index()
{
	if(!Auth::LoggedIn()) {
      $this->set('message', 'You must be logged in to access this feature!');
      $this->render('core_error.php');
      return;
    }
	/*if(!self::routecheck())
        {
            $this->set('message', base64_decode('RXJyb3I6IFB1cmNoYXNlIFZlcmlmaWNhdGlvbiBGYWlsZWQu'));
            $this->show('core_error.php');
            exit;
        }*/
 
	$setting = AutoAssignData::getsettings();
	
if($setting->enabled = '0')
	{
		$this->set('message', 'Flight Assignments are currently disabled!');
         $this->show('core_error.php');
		return;
	}
	
$this->set('setting', AutoAssignData::getsettings());
$this->set('flights', AutoAssignData::getassignments(Auth::$userinfo->pilotid));
$this->show('autoassign/index.php');
}

public function resetassignments()
{
	if(!self::routecheck())
        {
            $this->set('message', "Verification Error");
            $this->show('core_success.php');
            exit;
        }
self::generatepilotassignments(Auth::$userinfo->pilotid);
	
$this->set('message', 'Assignments Successfully Created!');
$this->show('core_success.php');
$this->index();
}

public function cancelflight($aid)
{
AutoAssignData::cancelflight($aid);
	
$this->set('message', 'Flight Cancelled!');
$this->show('core_success.php');
$this->index();
}

public function defaultsettings()
{
AutoAssignData::deletepilotsindisettings(Auth::$userinfo->pilotid);
	
$this->set('message', 'Settings set to default!');
$this->show('core_success.php');
$this->index();
}


public function addbid($routeid)
		{	
	if(!self::routecheck())
        /*{
            $this->set('message', base64_decode('RXJyb3I6IFB1cmNoYXNlIFZlcmlmaWNhdGlvbiBGYWlsZWQu'));
            $this->show('core_error.php');
            exit;
        }*/
				$ret = SchedulesData::addBid(Auth::$userinfo->pilotid, $routeid);				
				if($ret)
				{
					$this->set('message', 'Flight Booked!');
$this->show('core_success.php');

				}
$this->index();
		}


public function pilotsettings()
{
	
	if(!self::routecheck())
        {
            $this->set('message', "Verification Error");
            $this->show('core_error.php');
            exit;
        }
	
$this->set('setting', AutoAssignData::getsettings());
$this->set('pilotsetting', AutoAssignData::getpilotsettings(Auth::$userinfo->pilotid));
$this->set('airports', AutoAssignData::suidepapts());
$this->show('autoassign/settings.php');
}


public function savesettings()
{
	$pilotsettings = AutoAssignData::getpilotsettings(Auth::$userinfo->pilotid);
	$setting = AutoAssignData::getsettings();
	
	
$enabled = $setting->enabled;
$defaultstate = $setting->defaultstate;
$assignmode = $setting->assignmode;
$howmany = $setting->howmany;
$creationinterval = $setting->creationinterval;
$deleteopen = $setting->deleteopen;
$useranklimit = $setting->useranklimit;
$maxtime = $setting->maxtime;
$tohubonly = $setting->tohubonly;
$onlyonce = $setting->onlyonce;
$sendemail = $setting->sendemail;
$allowprefac = $setting->allowprefac;
$pilotreject = $setting->pilotreject;
$pilinstacreate = $setting->pilinstacreate;
$airlines = $setting->airlines;

$pilotenabled = DB::escape($this->post->pilotenabled);
$howmany = DB::escape($this->post->howmany);
$creationinterval = DB::escape($this->post->creationinterval);
$deleteopen = DB::escape($this->post->deleteopen);
$maxtime = DB::escape($this->post->maxtime);
$sendemail = DB::escape($this->post->sendemail);
$selectedairline = $this->post->selectedairline;
if(count($selectedairline) > '1')
{
if($selectedairline)
{
$selectedairline = DB::escape(implode(':', $selectedairline));
}
}
else
{
$selectedairline = $selectedairline[0];
}
$prefac = $this->post->prefac;
if(count($prefac) > '1')
{
if($prefac)
{
$prefac = DB::escape(implode(':', $prefac));
}
}
else
{
$prefac = $prefac[0];
}
$prefdepicao = DB::escape($this->post->prefdepicao);

if($pilotsettings)
{
AutoAssignData::savepilsettings($enabled, $defaultstate, $assignmode, $howmany, $creationinterval, $deleteopen, $useranklimit, $maxtime, $tohubonly, $onlyonce, $sendemail, $allowprefac, $pilotreject, $pilinstacreate, $airlines, $pilotenabled, $selectedairline, $prefac, $prefdepicao, Auth::$userinfo->pilotid);
}
else
{
AutoAssignData::newspilsettings($enabled, $defaultstate, $assignmode, $howmany, $creationinterval, $deleteopen, $useranklimit, $maxtime, $tohubonly, $onlyonce, $sendemail, $allowprefac, $pilotreject, $pilinstacreate, $airlines, $pilotenabled, $selectedairline, $prefac, $prefdepicao, Auth::$userinfo->pilotid);
}


$this->set('message', 'Settings Saved!');
$this->show('core_success.php');
$this->index();
}


public function generatepilotassignments($pilotid)
{
	$setting = AutoAssignData::getsettings();

	if($setting->enabled = '0')
	{
		return;
	}

	
	$pilot = AutoAssignData::getpilotinfo($pilotid);
		
		
	$pilotsetting = AutoAssignData::getpilotsettings($pilot->pilotid);
		

	if($setting->assignmode == '1')
	{
	if($pilotsetting)
	{
		$setting = $pilotsetting;
	}
	}

	$interval = $setting->creationinterval;
	
	if($setting->deleteopen == '1')
	{
		AutoAssignData::setopenflightstoinactive($pilot->pilotid, '0');
	}
else
	{
		AutoAssignData::setopenflightstoinactive($pilot->pilotid, '2');
	}
	
	$itid = AutoAssignData::getstartitineraryid($pilot->pilotid);
	$itid = $itid + 1;
	
	self::generateassignmentsaction($setting, $pilot, $itid);
	
}


public function generateassignments()
{
	$setting = AutoAssignData::getsettings();

	if($setting->enabled = '0')
	{
		return;
	}

	
	$pilots = AutoAssignData::getactivepilots();
	if(!$pilots)
	{
	return;
	}

	foreach($pilots as $pilot)
	{
		
	$pilotsetting = AutoAssignData::getpilotsettings($pilot->pilotid);
	
	if($setting->enabled == '2' && !$pilotsetting && $setting->defaultstate == '0')
	{
		continue;
	}

	if($setting->assignmode == '1')
	{
	if($pilotsetting)
	{
		$setting = $pilotsetting;
		
		if($setting->pilotenabled != '1')
	{
		continue;
	}
	}
	}
	
	$interval = $setting->creationinterval;
	$today = date('Y-m-d');
	$lastcreation = AutoAssignData::getlastcreationdate($pilot->pilotid);
	$creationdate = date('Y-m-d', strtotime($lastcreation. ' + '.$interval.' days'));
	
	if($lastcreation && $today < $creationdate)
	{
		continue;
	}
	
	if($setting->deleteopen == '1')
	{
		AutoAssignData::setopenflightstoinactive($pilot->pilotid, '0');
	}
else
	{
		AutoAssignData::setopenflightstoinactive($pilot->pilotid, '2');
	}
	
	
	
	$itid = AutoAssignData::getstartitineraryid($pilot->pilotid);
	$itid = $itid + 1;
	
	self::generateassignmentsaction($setting, $pilot, $itid);
	}
}




public function generateassignmentsaction($setting, $pilot, $itid = '1', $run = '1')
{
	if($run > '10')
	{
		$this->set('message', 'No available Flights Found - Please adjust settings!');
        $this->show('core_error.php');
		return;
	}

	$amountofflights = $setting->howmany;
	$currentactiveflights = AutoAssignData::getlatestassignments($pilot->pilotid);
	
	if($amountofflights <= count($currentactiveflights))
	{
		if($setting->sendemail == '1')
		{
		self::sendemail($pilot);
		}
		return;
	}
	
	if($setting->useranklimit == '1')
	{
		$ranklimit = $pilot->ranklevel;
	}
	else
	{
		$ranklimit = '0';
	}
	
	if($setting->tohubonly == '1')
	{
		$depicao = $pilot->hub;
	}
	else
	{
		if($setting->prefdepicao)
		{
		$depicao = $setting->prefdepicao;
		}
		else
		{
		$depicao = AutoAssignData::getrandomdepicao();
		}
	}
	
	if($setting->allowprefac == '1' && $setting->prefac)
	{
		$aircraft = explode(':', $setting->prefac);
		$aircraft = $aircraft[array_rand($aircraft)];
	}
	else
	{
		$aircraft = '';
	}
	
	if($setting->selectedairline)
	{
		$airline = explode(':', $setting->selectedairline);
		$airline = $airline[array_rand($airline)];
	}
	else
	{
		$airline = explode(':', $setting->airlines);
		$airline = $airline[array_rand($airline)];
	}
	
	if($aircraft != '')
	{
		$csac = AutoAssignData::checkaircraftinairline($airline, $aircraft);
		
		if(!$csac)
		{
			$aircraft = AutoAssignData::getrandaircraftinairline($airline);
			if(!$aircraft)
			{
				$aircraft = '';
			}
		}
	}
	
	if($setting->onlyonce == '1')
	{
		$unique = '1';
	}
	else
	{
		$unique = '0';
	}
	
	$missingflights = $amountofflights - count($currentactiveflights);
	
	
	if($missingflights >= 4 && $run < '5')
	{
		if(rand(1,10) > '5')
		{ 
			$flights = AutoAssignData::searchflightsmethodA($ranklimit, $aircraft, $depicao, $depicao, '00:30:00', '400', rand(0,6), 'RAND(), s1.deptime, s2.arrtime', $airline, '0', $setting->maxtime, $unique);
			if(!$flights)
	{
		 $flights = AutoAssignData::searchflightsmethodC($ranklimit, $aircraft, $depicao, $depicao, '00:30:00', '400', rand(0,6), 'RAND(), s1.deptime, s2.arrtime', $airline, '0', $setting->maxtime, $unique);
        if(!$flights)
	       {
		return self::generateassignmentsaction($setting, $pilot, $itid, $run + 1);
           }
	}
			AutoAssignData::addnewassignment($pilot->pilotid, $flights->schedAid, date('Y-m-d H:i:s'), '1', $itid);
			AutoAssignData::addnewassignment($pilot->pilotid, $flights->schedBid, date('Y-m-d H:i:s'), '1', $itid);
			
		}
		else
		{
			$flights = AutoAssignData::searchflightsmethodB($ranklimit, $aircraft, $depicao, $depicao, '00:30:00', '400', rand(0,6), 'RAND(), s1.deptime, s2.arrtime', $airline, '0', $setting->maxtime, $unique);
			if(!$flights)
	{
		return self::generateassignmentsaction($setting, $pilot, $itid, $run + 1);
	}
			AutoAssignData::addnewassignment($pilot->pilotid, $flights->schedAid, date('Y-m-d H:i:s'), '1', $itid);
	        AutoAssignData::addnewassignment($pilot->pilotid, $flights->schedBid, date('Y-m-d H:i:s'), '1', $itid);
	        AutoAssignData::addnewassignment($pilot->pilotid, $flights->schedCid, date('Y-m-d H:i:s'), '1', $itid);
	        AutoAssignData::addnewassignment($pilot->pilotid, $flights->schedDid, date('Y-m-d H:i:s'), '1', $itid);
		}
	}
	else
	{
	$flights = AutoAssignData::searchflightsmethodA($ranklimit, $aircraft, $depicao, $depicao, '00:30:00', '400', rand(0,6), 'RAND(), s1.deptime, s2.arrtime', $airline, '0', $setting->maxtime, $unique);
	if(!$flights)
	{
		 $flights = AutoAssignData::searchflightsmethodC($ranklimit, $aircraft, $depicao, $depicao, '00:30:00', '400', rand(0,6), 'RAND(), s1.deptime, s2.arrtime', $airline, '0', $setting->maxtime, $unique);
        if(!$flights)
	       {
		return self::generateassignmentsaction($setting, $pilot, $itid, $run + 1);
           }
	}
	AutoAssignData::addnewassignment($pilot->pilotid, $flights->schedAid, date('Y-m-d H:i:s'), '1', $itid);
	AutoAssignData::addnewassignment($pilot->pilotid, $flights->schedBid, date('Y-m-d H:i:s'), '1', $itid);
	}
	
	$itid = $itid + 1;
	return self::generateassignmentsaction($setting, $pilot, $itid, '1');
	
}

public function sendemail($pilot)
{
	
			$this->set('firstname', $pilot->firstname);
			$this->set('lastname', $pilot->lastname);
			$this->set('pilotid', PilotData::GetPilotCode($pilot->code,$pilot->pilotid));
			$this->set('flights', AutoAssignData::getassignments($pilot->pilotid));
			
			$message = Template::Get('autoassign/email.php', true);
			Util::SendEmail($pilot->email, SITE_NAME.' - New Flight Assignments', $message);
}

public function __construct()
{
 CodonEvent::addListener('AutoAssign', array('pirep_filed'));
}



public function EventListener($eventinfo)
{
 $eventname = $eventinfo[0]; // Event name
 $eventmodule = $eventinfo[1]; // Class calling it


if($eventinfo[0] == 'pirep_filed')
 { 
$query0 = "SELECT * FROM ".TABLE_PREFIX."pireps ORDER BY submitdate DESC LIMIT 1";
					
					$pirep =	DB::get_row($query0);
					
					$pilotid = $pirep->pilotid;
					$flcode = $pirep->code;
					$flnum = $pirep->flightnum;

$query1 = "SELECT * FROM ".TABLE_PREFIX."schedules WHERE code = '$flcode' AND flightnum = '$flnum'";
					
					$pilotflight =	DB::get_row($query1);

if($pilotflight)
{
$schedid = $pilotflight->id;

$query3 = "DELETE FROM autoassign_current WHERE pilotid = '$pilotid' AND schedid = '$schedid'";
DB::query($query3);
}
}
}

	
	 public function routecheck()
    {
        $module = "automatic-flight-assignments";
        $airline = SITE_URL;
        $airline = str_replace("https://", "", $airline);
        $airline = str_replace("https://", "", $airline);
        $connect = 'aHR0cDovL3d3dy5jcmF6eWNyZWF0aXZlcy5jb20vdmFsaWRhdGUv';
        
        if (file_exists('core/cache/cc_'.$module.'.cache')) {
        $contents = file('core/cache/cc_'.$module.'.cache');
        
        
        if(time() <= $contents[0]) {
				$result = $contents[1];
                $error = $contents[2];
                $errormsg = $contents[3];
			}
        }
        
        if (!$result || base64_decode($result) == "NO") {
       
        $ch = curl_init();
        curl_setopt ($ch, CURLOPT_URL, base64_decode($connect).'?module='.$module.'&airline='.$airline);
        curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt ($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.6) Gecko/20070725 Firefox/2.0.0.6");
        curl_setopt ($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec ($ch);
       
            
        if(curl_errno($ch))
        {
         $error = '1';
         $errormsg = curl_error($ch);
        }
        else
        {
          $error = '0';
          $errormsg = "0";
        }
            
        curl_close($ch);
        
        $ttl = strtotime('+ 7 days');
        if(!trim($result))
        {
            $result = "Tk8=";
        }
        $value = trim($result);
		
        $value = $ttl.PHP_EOL.$value.PHP_EOL.$error.PHP_EOL.$errormsg;
        file_put_contents('core/cache/cc_'.$module.'.cache', $value);
            
        }
        
        if(base64_decode($result) == "OK".$module || $error == '1')
        {
            return true;
        }
        
        
        return false;   
    }
    

}
?>