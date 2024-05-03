<?php

class credits extends CodonModule   {
    
    function index()    {
        if(!Auth::LoggedIn()) {
          $this->set('message', 'You must be logged in to access this feature!');
          $this->render('core_error.php');
          return;
        }
        $this->title = 'Partners';
        $this->set('credits', CreditsData::get_active_credits());
        $this->show('credits/index');
    }
    
}