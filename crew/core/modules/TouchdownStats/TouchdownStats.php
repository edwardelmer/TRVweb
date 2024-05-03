<?php
//simpilotgroup addon module for phpVMS virtual airline system
//
//simpilotgroup addon modules are licenced under the following license:
//Creative Commons Attribution Non-commercial Share Alike (by-nc-sa)
//To view full license text visit https://creativecommons.org/licenses/by-nc-sa/3.0/
//
//@author David Clark (simpilot)
//@copyright Copyright (c) 2009-2010, David Clark
//@license https://creativecommons.org/licenses/by-nc-sa/3.0/

class TouchdownStats extends CodonModule {

    public function index() {
        //$this->set('stats', TouchdownStatsData::get_all_stats());
        $this->set('stats', TouchdownStatsData::get_stats(10));
        $this->set('gabruks', TouchdownStatsData::get_worst_stats(10));
        $this->show('touchdownstats/touchdownstats_index.php');
    }

    public function top_landings($howmany)  {
        if(!is_numeric($howmany)){exit;}
        $this->set('stats', TouchdownStatsData::get_stats($howmany));
        $this->show('touchdownstats/touchdownstats_index.php');
    }
    
    public function worst_landing($howmany)  {
        if(!is_numeric($howmany)){exit;}
        $this->set('gabruks', TouchdownStatsData::get_worst_stats($howmany));
        $this->show('touchdownstats/touchdownstats_index.php');
    }
}