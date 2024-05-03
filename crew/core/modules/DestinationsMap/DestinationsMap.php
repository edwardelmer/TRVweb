<?php
/** Destination Map Module
	Exclusively made for The Reds Virtual
	Inspired by Destination Map Module by Zueweb
*/



class DestinationsMap extends CodonModule 

{
	public function index()
	{
		if(!Auth::LoggedIn()) {
          $this->set('message', 'You must be logged in to access this feature!');
          $this->render('core_error.php');
          return;
        }
    
	$this ->render ('destinationsmap.php');

	}


}

