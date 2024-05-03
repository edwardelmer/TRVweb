<?php
/**
* phpVMS - Virtual Airline Administration Software
* Copyright (c) 2008 Nabeel Shahzad
* For more information, visit www.phpvms.net
*	Forums: http://www.phpvms.net/forum
*	Documentation: http://www.phpvms.net/docs
*
* phpVMS is licenced under the following license:
*   Creative Commons Attribution Non-commercial Share Alike (by-nc-sa)
* 
* Hub Created by Strider
*/

class Hub extends CodonModule 
{
	public function index()
	{
		$this->set('hubs', HubData::get_hub());
		$this->show('hub/index');
	}
	public function HubView($icao='')
	{
		$hubs = HubData::getHubs($icao);
		$this->set('hubs', $hubs);
		$this->show('hub/hubview');
	}
}
?>
