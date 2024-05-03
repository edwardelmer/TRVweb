<?php


class Hub_admin extends CodonModule
{
    public function HTMLHead()
    {
        $this->set('sidebar', 'hub/sidebar_hub.php');
    }

    public function NavBar()
    {
        echo '<li><a href="'.SITE_URL.'/admin/index.php/Hub_admin">Hubs</a></li>';
    }

    public function index()
    {
        if($this->post->action == 'save_new_hub')
        {
            $this->save_new_hub();
        }
        elseif($this->post->action == 'save_edit_hub')
        {
            $this->save_edit_hub();
        }
        else
        {
            $this->set('hubs', HubData::get_hub());
			$this->set('history', HubData::get_past_hub());
            $this->show('hub/hub_index');
        }
    }
    public function get_hubs()
    {
        $icao = $_GET[icao];
        $this->set('hubs', HubData::getHubs($icao));

        $this->show('hub/hubs_hub');
    }
    public function new_hub()
    {
        $hubs = HubData::get_airports();
		$this->set('hubs', $hubs);
		$this->show('hub/hub_new_form');
    }
    protected function save_new_hub()
    {
    	if($this->post->hubicao == '') {
    		$this->set('message', 'HUB ICAO is missing');
    		$this->show('core_error');
    		$this->set('hubs', HubData::get_hub());
        	$this->show('hub/hub_index');
        	return;
    	}
        $hubr = array();

        $hubr['hubicao'] = DB::escape($this->post->hubicao);
		$hubr['hubname'] = DB::escape($this->post->hubname);
		$hubr['lat'] = DB::escape($this->post->lat);
		$hubr['lng'] = DB::escape($this->post->lng);
		$hubr['pilotid'] = DB::escape($this->post->pilotid);
		$hubr['manager'] = DB::escape($this->post->manager);
		$hubr['image'] = DB::escape($this->post->image);
   /*     foreach($hubr as $test)
        {
            if(empty($test))
            {
                $this->set('aircrafts', $ac);
                $this->show('aircraft/aircraft_new_form.php');
                return;
            }
        }*/
        HubData::save_new_hub($hubr['hubicao'], $hubr['hubname'], $hubr['lat'], $hubr['lng'], $hubr['pilotid'], $hubr['manager'], $hubr['image']);
	$this->set('message', 'HUB Added');
	$this->show('core_success');
        $this->set('hubs', HubData::get_hub());
        $this->show('hub/hub_index');
        LogData::addLog(Auth::$userinfo->pilotid, "Added a new hub.");
    }
    public function edit_hub() {
            $hubid = $_GET[hubid];
            $hubed = array();
            //$aircraft = AircraftData::get_aircrafts($id);
            $this->set('hubs', HubData::get_hubs($hubid));
            $this->show('hub/hub_edit_form');
    }
    protected function save_edit_hub()
    {
    	if($this->post->hubicao == '') {
    		$this->set('message', 'HUB ICAO is missing');
    		$this->show('core_error');
    		$this->set('hubs', HubData::get_hubs($hubid));
        	$this->show('hub/hubs_hub');
        	return;
    	}
        $hb= array();

        $hb['hubicao'] = DB::escape($this->post->hubicao);
        $hb['hubname'] = DB::escape($this->post->hubname);
		$hb['lat'] = DB::escape($this->post->lat);
		$hb['lng'] = DB::escape($this->post->lng);
		$hb['pilotid'] = DB::escape($this->post->pilotid);
		$hb['manager'] = DB::escape($this->post->manager);
		$hb['image'] = DB::escape($this->post->image);
		$hb['hubid'] = DB::escape($this->post->hubid);


        HubData::save_edit_hub($hb['hubicao'],
										   $hb['hubname'],
										   $hb['lat'],
										   $hb['lng'],
										   $hb['pilotid'],
										   $hb['manager'],
										   $hb['image'],
										   $hb['hubid']);
        $hubid = $hb['hubid'];
        $this->set('message', 'HUB Updated');
        $this->show('core_success');
        $this->set('hubs', HubData::get_hubs($hubid));
        $this->show('hub/hubs_hub');
        LogData::addLog(Auth::$userinfo->pilotid, "Edited a HUB.");
    }

    public function delete_hub()
    {
        $hubid = $_GET[hubid];
        HubData::delete_hub($hubid);

        $this->set('hub', HubData::get_hub());
        $this->show('hub/hub_index');
        LogData::addLog(Auth::$userinfo->pilotid, "Deleted a HUB.");
    }
}
