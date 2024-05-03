<?php class AutoAssign extends CodonModule {

public function HTMLHead()
    {
        $this->set('sidebar', 'autoassign/sidebar.php');
    }

    public function NavBar()
    {
 echo '<li><a href="'.SITE_URL.'/admin/index.php/AutoAssign">Automatic Flight Assignments</a></li>';
    }

public function index()
{
$this->settings();
}

public function settings()
{
$settings = AutoAssignData::getsettings(); 

if(!$settings)
{
AutoAssignData::createsettings();
}

$this->set('setting', $settings);
$this->set('airlines', AutoAssignData::getallairlines());
$this->show('autoassign/settings.php');
}


public function savesettings()
{

$enabled = DB::escape($this->post->enabled);
$defaultstate = DB::escape($this->post->defaultstate);
$assignmode = DB::escape($this->post->assignmode);
$howmany = DB::escape($this->post->howmany);
$creationinterval = DB::escape($this->post->creationinterval);
$deleteopen = DB::escape($this->post->deleteopen);
$useranklimit = DB::escape($this->post->useranklimit);
$maxtime = DB::escape($this->post->maxtime);
$tohubonly = DB::escape($this->post->tohubonly);
$onlyonce = DB::escape($this->post->onlyonce);
$sendemail = DB::escape($this->post->sendemail);
$allowprefac = DB::escape($this->post->allowprefac);
$pilotreject = DB::escape($this->post->pilotreject);
$pilinstacreate = DB::escape($this->post->pilinstacreate);
$airlines = $this->post->airlines;
if(count($airlines) > '1')
{
if($airlines)
{
$airlines = DB::escape(implode(':', $airlines));
}
}
else
{
$airlines = $airlines[0];
}

AutoAssignData::savesettings($enabled, $defaultstate, $assignmode, $howmany, $creationinterval, $deleteopen, $useranklimit, $maxtime, $tohubonly, $onlyonce, $sendemail, $allowprefac, $pilotreject, $pilinstacreate, $airlines);

AutoAssignData::deletepilotsettings();

$this->set('message', 'Settings Saved!');
$this->show('core_success.php');
$this->settings();

}

public function resetassignments()
{
	AutoAssignData::deleteallassignments();
	self::generateassignments();
	
$this->set('message', 'Assignments Successfully Reset!');
$this->show('core_success.php');
$this->settings();
}

public function deleteassignments()
{
	AutoAssignData::deleteallassignments();
	
	$this->set('message', 'All Assignments Deleted!');
    $this->show('core_success.php');
    $this->settings();
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

	if($setting->enabled == '0')
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
	
	if(!$pilotsetting && $setting->enabled == '2' && $setting->defaultstate != '1')
	{
		
		return;
	}

	if($setting->assignmode == '1')
	{
	if($pilotsetting)
	{
		$setting = $pilotsetting;
		
		if($setting->pilotenabled != '1')
	{
		return;
	}
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


public function managepilots()
{
	$this->set('pilots', AutoAssignData::getactivepilots());
	$this->show('autoassign/managepilots.php');
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


public function resetpilotassignments($pilotid)
{
self::generatepilotassignments($pilotid);
	
$this->set('message', 'Assignments Successfully Created!');
$this->show('core_success.php');
$this->managepilots();
}

public function deletepilotassignments($pilotid)
{
	
AutoAssignData::delpilassignments($pilotid);
	
$this->set('message', 'Assignments Deleted!');
$this->show('core_success.php');
$this->managepilots();
}

public function manageassignments($pilotid)
{
$this->set('schedules', AutoAssignData::getallschedules());
$this->set('pilot', AutoAssignData::getpilotinfo($pilotid));
$this->set('flights', AutoAssignData::getassignments($pilotid));
$this->show('autoassign/manageassignments.php');
}

public function cancelflight($aid)
{
	$pilotid = $this->get->id;
	
AutoAssignData::cancelflight($aid);
	
$this->set('message', 'Assignment Deleted!');
$this->show('core_success.php');
$this->manageassignments($pilotid);
}

public function addflighttopilot($pilotid)
{

$schedid = DB::escape($this->post->schedid);

AutoAssignData::addnewassignment($pilotid, $schedid, date('Y-m-d H:i:s'), '1', '0');

$this->set('message', 'Assignment added to pilot!');
$this->show('core_success.php');
$this->manageassignments($pilotid);
}



} ?>