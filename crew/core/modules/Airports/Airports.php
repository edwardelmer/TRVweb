<?php

class Airports extends CodonModule
{
	public function index()
	{
	   if(!Auth::LoggedIn()) {
          $this->set('message', 'You must be logged in to access this feature!');
          $this->render('core_error.php');
          return;
        }
		$this->set('airports', OperationsData::getAllAirports());
		$this->show('airports/airport_main.php');
		
	}
    public function get_airport() 
    {
        if(!Auth::LoggedIn()) {
          $this->set('message', 'You must be logged in to access this feature!');
          $this->render('core_error.php');
          return;
        }
        $icao = $_GET['icao'];
        $this->set('name', OperationsData::getAirportInfo($icao));
        $this->show('airports/airport_info.php');
    }
}
