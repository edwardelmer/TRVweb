<?php

    class SimBrief extends CodonModule
    {


        public function index()
        {
            if(!Auth::LoggedIn()) {
              $this->set('message', 'You must be logged in to access this feature!');
              $this->render('core_error.php');
              return;
            }


            $url = 'http://www.simbrief.com/ofp/flightplans/xml/'.$this->get->ofp_id.'.xml';
            $xml = simplexml_load_file($url);
            $this->set('info', $xml);
            $this->render('SimBrief/SimBrief.php'); 
            //print_r($xml);
        }
}