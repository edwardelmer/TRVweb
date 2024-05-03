<?php
/**
 * phpVMS - Virtual Airline Administration Software
 * Copyright (c) 2008 Nabeel Shahzad
 * For more information, visit www.phpvms.net
 *	Forums: https://www.phpvms.net/forum
 *	Documentation: https://www.phpvms.net/docs
 *
 * phpVMS is licenced under the following license:
 *   Creative Commons Attribution Non-commercial Share Alike (by-nc-sa)
 *   View license.txt in the root, or visit https://creativecommons.org/licenses/by-nc-sa/3.0/
 *
 * @author Nabeel Shahzad
 * @copyright Copyright (c) 2008, Nabeel Shahzad
 * @link https://www.phpvms.net
 * @license https://creativecommons.org/licenses/by-nc-sa/3.0/
 */
 
class Fleet extends CodonModule {

	public function index() {
        if(!Auth::LoggedIn()) {
          $this->set('message', 'You must be logged in to access this feature!');
          $this->render('core_error.php');
          return;
        }
		$this->set('aircrafts', FleetData::GetAllAircrafts());
		$this->render('fleet/fleet_list.php');
		
	}
	
    public function GetFleetsbyAirlines($airline)
		{
			$sql = 'SELECT * FROM '.TABLE_PREFIX.'aircraft WHERE `enabled` = 1 AND airline='.$airline;
			$airlinefleet = DB::get_rwo($sql);
			return $airlinefleet;
		}
	
    public function view($aircraftid) {
        if(!Auth::LoggedIn()) {
          $this->set('message', 'You must be logged in to access this feature!');
          $this->render('core_error.php');
          return;
        }
		$this->set('basicinfo', FleetData::getBasicInfo($aircraftid));
		$this->set('purchasedate', FleetData::getDateOfPurchase($aircraftid));
		$this->set('firstflight', FleetData::getFirstFlight($aircraftid));
		$this->set('lastflight', FleetData::getLastFlight($aircraftid));
		$this->set('detailedinfo', FleetData::getAircraftTotals($aircraftid));
		$this->set('recentflights', FleetData::get5MostRecentFlights($aircraftid));
		$this->set('scheduledflights', FleetData::getAllScheduledFlights($aircraftid));
		$this->render('fleet/fleet_view.php');
		
	}
}