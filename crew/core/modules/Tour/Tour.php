<?php

//////////////////////////////////////////////////////////////////////
//simpilotgroup Tour 1.0 module for phpVMS virtual airline system   //
//@author David Clark (simpilot)                                    //
//@copyright Copyright (c) 2011, David Clark, All Rights Reserved   //
//////////////////////////////////////////////////////////////////////

class Tour extends CodonModule  {

//    public function NavBar()
//    {
//        echo '<li><a href="'.url('Tour').'">Tours</a></li>';
//    }

    public function index()
{
	if(!Auth::LoggedIn()) {
      $this->set('message', 'You must be logged in to access this feature!');
      $this->render('core_error.php');
      return;
    }
        $this->set('tours', TourData::get_tours());
        $this->show('tour/tour_index');
    }

    public function details($id)    {
        $this->set('tour', TourData::get_tour($id));
        $this->set('pilotdata', TourData::get_pilot_data($id));
        $this->show('tour/tour_details');
    }

    public function signup($id) {

        $check = TourData::check_pilotsignup($id);

        if($check > 0){$this->details($id); return;}

        $tour = TourData::get_tour($id);
        $flights = unserialize($tour->flights);

        $data = array();
        $num = 0;
        foreach($flights as $flight)
        {
            $data[$num] = 0;
            $num++;
        }
        $data2 = serialize($data);

        TourData::pilot_signup(Auth::$userinfo->pilotid, $id, $data2);

        $this->details($id);
    }
}