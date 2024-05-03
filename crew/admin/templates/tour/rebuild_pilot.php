<?php

//////////////////////////////////////////////////////////////////////
//simpilotgroup Tour 1.0 module for phpVMS virtual airline system   //
//@author David Clark (simpilot)                                    //
//@copyright Copyright (c) 2011, David Clark, All Rights Reserved   //
//////////////////////////////////////////////////////////////////////

$pilot = PilotData::getPilotData($pilotid);
                    echo '<form action="'.adminurl('/TourAdmin/rebuild_pilotdata').'/'.$pilotid.'/'.$tourid.'" method="post" enctype="multipart/form-data">';
                    echo '<h3>Tour progress rebuild for: '.$pilot->firstname.' '.$pilot->lastname.' - '.PilotData::getPilotCode($pilot->code, $pilot->pilotid).'</h3>';
                    echo '<table width="100%" border="1px">';
                    echo '<tr><td>Tour Flights</td><td>Flights Currently Credited To Pilot</td><td>Actual Flights Flown</td></tr>';
                    //required tour flights
                        $data = TourData::get_tour($tourid);
                        $flights = unserialize($data->flights);
                        $old_data = TourData::get_rebuild_data($pilotid, $tourid);
                        $old_flight_data = unserialize($old_data->data);
                        $i = 0;
                        foreach($flights as $flight)
                        {
                            echo '<tr><td>';
                            $ft = SchedulesData::getSchedule($flight);
                            echo $ft->code.$ft->flightnum.'<br />';
                            echo '</td><td>';
                            //flights currently credited to pilot
                            if($old_flight_data[$i] == 0)
                            {
                                echo 'No Flight Credited<br />';
                            }
                            else
                            {
                                $credited_flight = TourData::get_pirep_data($old_flight_data[$i]);
                                echo $credited_flight->code.$credited_flight->flightnum.' - Submitted: '.date('m/d/Y H:i', strtotime($credited_flight->submitdate));
                            }

                            echo '</td><td>';
                                $flightcheck = TourData::get_tour_pirep($pilotid, $ft->flightnum);
                                if($flightcheck)
                                {
                                    echo $flightcheck->code.$flightcheck->flightnum.' - Submitted: '.date('m/d/Y H:i', strtotime($flightcheck->submitdate));
                                    echo '<input type="hidden" name="new_flight_data_'.$i.'" value="'.$flightcheck->pirepid.'" />';
                                }
                                else
                                {
                                    echo 'Flight Not Flown';
                                    echo '<input type="hidden" name="new_flight_data_'.$i.'" value="0" />';
                                }
                            echo '</td></tr>';
                        $i++;
                        }
                    echo '</table><hr />';
                    echo '<input type="hidden" name="id" value="'.$old_data->id.'" />';
                    echo '<input type="hidden" name="count" value="'.$i.'" />';
                    echo '<input type="submit" value="Update Pilot\'s Progress" />';
?>