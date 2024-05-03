<?php if(!defined('IN_PHPVMS') && IN_PHPVMS !== true) { die(); } ?>
<div class="section-header">
    <h1><?php echo $tour->title; ?> Tour</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?php echo SITE_URL; ?>">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="javascript::">Flight Operation</a></div>
        <div class="breadcrumb-item"><a href="javascript::">Tours & Events</a></div>
        <div class="breadcrumb-item">Tours-<?php echo $tour->title; ?></div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
			<div class="card-body">
			    <div class="table-responsive">
			        <tbody>
                        <?php
                        $flights = unserialize($tour->flights);
                            
                            echo '<table width="100%" >';
                            echo '<tr><td width="50%">';
                            echo 'Tour Status : ';
                            if($tour->active == '0'){echo '<font color="#FF0000"><b> Hidden</b></font><br />';}
                            if($tour->active == '1'){echo '<font color="#00FF00"><b> Active</b></font><br />';}
                            if($tour->active == '2'){echo '<font color="#FF0000"><b> Complete</b></font><br />';}
                            if($tour->active == '3'){echo '<font color="#FF0000"><b> Upcoming</b></font><br />';}
                            echo '</td><td>';
                            if($tour->active == TRUE)
                            {
                                if(Auth::$loggedin)
                                {
                                    
                                    if($tour->active == '2'){echo '<b>Signups Closed</b>';}
                                    elseif($tour->active == '3'){echo '<b>Signups Available After Tour Opens</b>';}
                                    elseif($tour->active == '1')
                                        {
                                        if(TourData::check_pilotsignup($tour->id) == 0)
                                        {echo '<center><a href="'.url('tour/signup').'/'.$tour->id.'" text-decoration:underline;"><b>Click Here to Start the Tour</b></a></center>';}
                                        else
                                        {echo '<center><u><b>You Are Signed Up For This Tour</b></u></center>';}
                                    }
                                }
                            }
                            echo '</td></tr>';
                            echo '</table>';
                        ?>
                    </tbody>
                <br />
            </div>
        </div>
        </div>
        <div class="card card-primary">
            <div class="card-body">
                <div class="table-responsive">
			        <tbody>
                        <?php
                        $flights = unserialize($tour->flights);
                            echo '<center><h2>Tour Details</h2></center>';
                            echo '<table width="100%" border="1px">';
                            echo '<tr><td>';
                            echo '<b>Description:</b> '.$tour->description.'<br />';
                            echo '</td><td width="25%">';
                            if($tour->image == '')
                            {echo 'No Image Available';}
                            else
                            {echo '<center><img width="150" src="'.$tour->image.'" alt="'.$tour->title.'" /></center>';}
                            echo '</td></tr>';
                            echo '</table>';
                        ?>
                    </tbody>
                </div>
            </div>
                    <br />
			<div class="card-body">
			    <div class="table-responsive">
					                
                    <center><h2>Legs</h2></center>
                    <!-- <table width="100%" border="1px" cellpadding="1px"> -->
                    <table id="schedules_table" class="table table-striped table-bordered">    
                        <thead>
                            <tr>
                                <th>Leg:</th>
                                <th>Departure:</th>
                                <th>Arrival:</th>
                                <th>Flight:</th>
                                <th>Aircraft:</th>
                                <th>Distance:</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $totalmiles = 0;
                                $i = 1;
                                foreach($flights as $flight)
                                {
                                    $leg = SchedulesData::getSchedule($flight);
                                    $dep = OperationsData::getAirportInfo($leg->depicao);
                                    $arr = OperationsData::getAirportInfo($leg->arricao);
                                    echo '<tr>';
                                    echo '<td align="center">'.$i.'</td>';
                                    echo '<td>'.$dep->name.' ('.$dep->icao.')</td>';
                                    echo '<td>'.$arr->name.' ('.$arr->icao.')</td>';
                                    echo '<td>'.$leg->code . $leg->flightnum.'</td>';
                                    echo '<td>' .$leg->aircraft. '</td>';
                                    echo '<td>'.round($leg->distance, 0).' nm</td>';
                                    echo '</tr>';
                                    $totalmiles = $totalmiles + $leg->distance;
                                    $i++;
                                }
                            ?>
                            <tr>
                                <td colspan="6"><b>Total Distance Of Tour:</b> <?php echo round($totalmiles, 0); ?> nm</td>
                            </tr>
                            <tr>
                                <td colspan="6"><b>Flights must be reported in sequence. Do not re-fly any tour leg before you finished the tour, otherwise your record will be reset.</b></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
                <br />
        </div>
        <div class="card card-primary">
            <div class="card-body">
                <div class="table-responsive"> 
                <center><h2>Tour Progress</h2>
                Click * To View PIREP</center>
                <table id="schedules_table" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <?php
                            $start = SchedulesData::getSchedule($flights[0]);
                                $i=0;
                                echo '<th colspan="2" width="25%">START: '.$start->depicao.'</th>';
                            foreach($flights as $flight)
                            {
                                $i++;
                                $leg = SchedulesData::getSchedule($flight);
                                echo '<th>Leg: '.$i.' To: '.$leg->arricao.'</th>';
                            }
                            echo '<th>Complete</th>';
                            $col_count= ($i++);
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if(!$pilotdata)
                            {echo '<tr><td colspan="'.($i + 1).'">No Pilots Have Signed Up For This Tour</td></tr>';}
                            else
                            {
                                $pilot_count = 1;
                                foreach($pilotdata as $data)
                                {
                                    $progress = unserialize($data->data);
                                    $pilot = PilotData::getPilotData($data->pilotid);
                                    $leg_count = 0;
                                    if($pilot == ''){continue;}
                                    if($pilot->retired == TRUE){continue;}
                                    echo '<tr>';
                                        echo '<th>'.$pilot_count.'</th>';
                                        echo '<th>'.$pilot->firstname.' '.$pilot->lastname.' - '.PilotData::getPilotCode($pilot->code, $pilot->pilotid).'</td>';
                                        foreach($progress as $leg)
                                        {
                                            if($leg == 0)
                                            {echo '<td>&nbsp;';}
                                            else
                                            {
                                                $pirep = PIREPData::getReportDetails($leg);
                                                echo '<td align="center"><a href="'.url('pireps/view').'/'.$pirep->pirepid.'">';
                                                echo '<i class="fas fa-check-square"></i></a>';
                                                $leg_count++;
                                            }
                                            
                                            echo '</td>';
                                        }
                                        if($col_count == $leg_count)
                                        {echo '<td><b>Tour Completed</b></td>';}
                                        else
                                        {echo '<td>&nbsp;</td>';}
                                    echo '</tr>';
                                    $pilot_count++;
                                }
                            }
                        ?>    
                    </tbody>
                </table>
                </div>
            </div>
            </div>
    </div>
</div>