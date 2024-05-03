<?php

//////////////////////////////////////////////////////////////////////
//simpilotgroup Tour 1.0 module for phpVMS virtual airline system   //
//@author David Clark (simpilot)                                    //
//@copyright Copyright (c) 2011, David Clark, All Rights Reserved   //
//////////////////////////////////////////////////////////////////////

class TourAdmin extends CodonModule
{
    public function __construct() {
        CodonEvent::addListener('TourAdmin', array('pirep_accepted'));
    }
    public function EventListener($eventinfo) {
        if($eventinfo[0] == 'pirep_accepted') {
            
            $flight = $eventinfo[2]->scheduleid;
            $pilotid = $eventinfo[2]->pilotid;
            $pirepid = $eventinfo[2]->pirepid;

            $pilot_tours = TourData::get_pilot_tours($pilotid);

            if($pilot_tours != '')
            {
                $i = 0;
                foreach($pilot_tours as $tour)
                {
                    //check to see if tour is active - if not skip it
                    $test = TourData::get_tour($tour->tourid);
                    if($test->active != 1) {$i++; continue;}

                    $pilot_legs = unserialize($pilot_tours[$i]->data);
                    $data = TourData::get_tour($tour->tourid);
                    $flights = unserialize($data->flights);
                    $num = 0;
                    $new_data = array();
                    $check = TRUE;
                    
                    foreach($flights as $leg)
                    {
                        if($check == TRUE && $leg == $flight)
                        {
                            //update tour record
                            $new_data[$num] = $pirepid;
                        }
                        else
                        {
                            //maintain old data
                            $new_data[$num] = $pilot_legs[$num];
                        }
                        if($pilot_legs[$num] > 0){$check = TRUE;}else{$check = FALSE;}
                        $num = $num + 1;
                    }
                    TourData::update_pilot_tourdata($pilot_tours[$i]->id, serialize($new_data));
                    $i++;
                }
            }
        }
    }

    public function HTMLHead()
    {
        $this->set('sidebar', 'tour/sidebar_tour.php');
    }

    public function NavBar()
    {
        echo '<li><a href="'.SITE_URL.'/admin/index.php/TourAdmin">Tour 2.0</a></li>';
    }
    
    public function index()
    {
        $this->set('tours', TourData::get_tours());
        $this->show('tour/tour_header');
        $this->show('tour/tour_index');
        $this->show('tour/tour_footer');
    }

    public function view_tour($id)  {
        $this->set('tour', TourData::get_tour($id));
        $this->set('pilotdata', TourData::get_pilot_data($id));
        $this->show('tour/tour_header');
        $this->show('tour/tour_details');
        $this->show('tour/tour_footer');
    }

    public function edit($id)   {
        if(isset($this->post->action))
        {
            if($this->post->action == 'edit_tour')
                {
                    $title = DB::escape($this->post->title);
                    $description = DB::escape($this->post->description);
                    $image = DB::escape($this->post->image);
                    $active = DB::escape($this->post->active);

                    TourData::edit_tour($title, $description, $image, $active, $id);

                    $this->view_tour($id);
                }
        }
        else
        {
            $this->set('tour', TourData::get_tour($id));
            $this->show('tour/tour_header');
            $this->show('tour/tour_edit');
            $this->show('tour/tour_footer');
        }
    }

    public function rebuild_progress()  {
            $this->set('pilots', TourData::get_pilots_participated());
            $this->show('tour/tour_header');
            $this->show('tour/rebuild_progress');
            $this->show('tour/tour_footer');
    }

    public function rebuild_pilotdata($pilotid, $tourid)    {
            if($this->post->new_flight_data_0 != '')
                    {
                        $count = DB::escape($this->post->count);
                        $i = 0;
                        while($i < $count):
                            $field = 'new_flight_data_'.$i;
                            $new_data[] = DB::escape($this->post->$field);
                            $i++;
                        endwhile;
                        $data = serialize($new_data);
                        $id = DB::escape($this->post->id);
                        $check = TourData::update_pilot_tourdata($id, $data);
                        if($check == TRUE){$this->set('message', 'Pilot Data Updated');}
                    }
            $this->set('pilotid', $pilotid);
            $this->set('tourid', $tourid);
            $this->show('tour/tour_header');
            $this->show('tour/rebuild_pilot');
            $this->show('tour/tour_footer');
    }

    public function rebuild_all_pilotdata()    {
            $this->show('tour/tour_header');
            $tours = TourData::get_tours();
            foreach($tours as $tour)
            {
                $pilots = TourData::get_pilot_data($tour->id);
                foreach($pilots as $pilot)
                {
                   $pilotsflights = unserialize($pilot->data);
                   $tourflights = unserialize($tour->flights);
                   $data = array();
                   $lastflight = TRUE;
                   foreach($tourflights as $schedule)
                        {
                            if($lastflight == TRUE)
                            {
                                $flight = SchedulesData::getSchedule($schedule);
                                $flightcheck = TourData::get_tour_pirep($pilot->pilotid, $flight->flightnum);
                                if($flightcheck)
                                {
                                    if($flight->flightnum == $flightcheck->flightnum)
                                            $data[] = $flightcheck->pirepid;
                                }
                                else
                                {
                                    $data[] = '0';
                                    $lastflight = FALSE;
                                }
                            }
                            else
                            {
                                $data[] = '0';
                            }
                        }
                        $datafinal = serialize($data);
                        $check = TourData::update_pilot_tourdata($pilot->id, $datafinal);
                        if($check == TRUE){echo 'Tour Data Record #'.$pilot->id.' Updated<br />';}else{echo 'Udpating Tour Data Record #'.$pilot->id.' Failed!<br />';}
                    }
            }
          echo '<hr />COMPLETE!<br /><br />';
          $this->show('tour/tour_footer');
    }

    public function delete_pilot_record($id, $tourid)  {
        TourData::delete_pilot_data($id);
        $this->view_tour($tourid);
    }

    public function delete($id) {
        TourData::delete_tour($id);
        $this->index();
    }

    public function build_tour()
    {
        if(isset($this->post->action))
        {
            if($this->post->action == 'new_tour_2')
                {$this->new_tour_2();}
            if($this->post->action == 'new_tour_3')
                {$this->new_tour_3();}
            if($this->post->action == 'save_tour')
                {$this->save_tour();}
        }
        else
        {
            $this->new_tour();
        }
    }

    public function new_tour()
    {
        if(PilotGroups::group_has_perm(Auth::$usergroups, ACCESS_ADMIN))
        {
            $this->set('airlines', OperationsData::getAllAirlines());
            $this->set('airports', OperationsData::getAllAirports());
            $this->show('tour/tour_header');
            $this->show('tour/tour_newtour.php');
            $this->show('tour/tour_footer');
        }
        else
        {
            $this->set('message', 'You must be logged in to access this feature!');
            $this->render('core_error.php');
            return;
        }
    }

    protected function new_tour_2()
    {
        if($this->post->function == 'initial')
        {
            $start = DB::escape($this->post->start);
                if($start == '')
                    {$error['start'] = 'No Starting Airfield Chosen';}
            $legs = DB::escape($this->post->legs);
                if($legs == '')
                    {$error['legs'] = 'Number Of Legs Not Set';}

            if(isset($error))
            {
                $this->set('airlines', OperationsData::getAllAirlines());
                $this->set('airports', OperationsData::getAllAirports());
                $this->set('errors', $error);
                if($legs !='')
                    {$this->set('legs', $legs);}
                if($start !='')
                    {$this->set('start', $start);}
                $this->show('tour/tour_header');
                $this->show('tour/tour_newtour.php');
                $this->show('tour/tour_footer');
            }
            else
            {
                $start = OperationsData::getAirportInfo($start);

                $route = array();
                $route[] = $start;
                $_SESSION['route'] = $route;

                $this->set('start', $start);
                $this->set('legs', $legs);
                $this->set('leg', 1);

                $this->set('airports', TourData::available_flights($start->icao));

                $this->show('tour/tour_header');
                $this->show('tour/tour_newtour2.php');
                $this->show('tour/tour_footer');
            }
        }
        //we are past the initial setup and first leg
        else
        {
            if($this->post->leg <= $this->post->legs)
            {
                $leg = DB::escape($this->post->leg);
                $legs = DB::escape($this->post->legs);
                $depicao = $_SESSION['route'][($leg - 1)]->icao;
                $departure = OperationsData::getAirportInfo($depicao);
                $arrival = OperationsData::getAirportInfo(DB::escape($this->post->arrival));

                        //lets move to the next leg or end this thing
                        if($this->post->leg < $this->post->legs)
                        {
                            $route = array();
                            $route = $_SESSION['route'];
                            $route[] = $arrival;
                            $_SESSION['route'] = $route;

                            $this->set('airports', TourData::available_flights($route[$leg]->icao));

                            $leg++;
                            $this->set('leg', $leg);
                            $this->set('legs', $this->post->legs);
                            $this->show('tour/tour_header');
                            $this->show('tour/tour_newtour2.php');
                            $this->show('tour/tour_footer');
                        }
                        //its the last leg - lets move on and assign schedules
                        else
                        {
                            $route = array();
                            $route = $_SESSION['route'];
                            $route[] = $arrival;
                            $_SESSION['route'] = $route;
                            
                            $this->set('legs', $this->post->legs);
                            $this->show('tour/tour_header');
                            $this->show('tour/tour_newtour3.php');
                            $this->show('tour/tour_footer');
                        }
                    }
            else
            {
                $this->index();//crap - something shit the bed - go back to the begining
            }
        }
    }

    protected function new_tour_3()
    {

        $route = $_SESSION['route'];

        $legs = DB::escape($this->post->legs);
        $flights = array();
        $i = 1;
        while ($i <= $legs):
            {
                $id = 'flight' . $i;
                $flight = DB::escape($this->post->$id);
                $flights[] = $flight;
                $i++;
        }
        endwhile;
        $_SESSION['flights'] = $flights;
        $this->show('tour/tour_header');
        $this->show('tour/tour_newtour4.php');
        $this->show('tour/tour_footer');
    }

    protected function save_tour()
    {
        $flights = $_SESSION['flights'];

        if(!$flights)
        {$this->index();return;}
        $tour = array();
        $tour['month'] = DB::escape($this->post->month);
        $tour['year'] = DB::escape($this->post->year);
        $tour['title'] = DB::escape($this->post->title);
        $tour['description'] = DB::escape($this->post->description);
        $tour['image'] = DB::escape($this->post->image);
        $tour['active'] = DB::escape($this->post->active);

        TourData::save_tour($tour);

        unset($_SESSION['flights']);
        unset($_SESSION['route']);
        unset($tour);
        $this->set('message', 'New Tour Created');
        $this->index();
    }
}