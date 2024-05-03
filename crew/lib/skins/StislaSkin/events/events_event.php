<?php if(!defined('IN_PHPVMS') && IN_PHPVMS !== true) { die(); } ?>
<div class="section-header">
	<h1><?php echo SITE_NAME; ?> Event</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?php echo SITE_URL; ?>">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="javascript::">Flight Operations</a></div>
        <div class="breadcrumb-item"><a href="<?php echo url('/events'); ?>">Events</a></div>
        <div class="breadcrumb-item">Event</div>
    </div>
</div>

<div class="row">
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
			<div class="card-header">
				<h5><?php echo $event->title; ?></h5>
			</div>
			<div class="card-body">
			    <div class="row">
			        <table class="table table-bordered">
                        <tr>
                            <td width="75%" align="left"><?php echo $event->description; ?></td>
                            <td width="25%" align="center">
                                <?php if($event->image !='none') { ?>
                                <img src="<?php echo $event->image; ?>" class="img-fluid" alt="Event Image"/>
                                <?php } ?>
                            </td>
                        </tr>
                    </table>
			    </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
			<div class="card-body">			    
			    <div class="row">
			        <div class="col-md-6">
                        <h6>Departure Field :</h6> <?php echo $event->dep; ?>
                    </div>
                    <div class="col-md-6">
                        <h6>Arrival Field :</h6> <?php echo $event->arr; ?>
                    </div>
			    </div>
			    <?php {
			     
			         
			     }   
			    ?>
			    <div class="row">
			        <div class="col-md-6">
                        <h6>Scheduled Start Time :</h6> <?php echo date('G:i', strtotime($event->time)); ?>z.
                    </div>
                    <div class="col-md-6">
                        <h6>Company Schedule :</h6> <?php echo $event->schedule; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>





<div class="row">
    <div class="col-md-12">
        <div class="card">
			<div class="card-body">
                <table class="table table-bordered">

                    <?php if(!Auth::LoggedIn()) { ?>
                    <tr>
                        <td>Current Signups:</td>
                        <td align="left">
                            <?php
                                $count=0;
                                if (!$signups) {
                                    echo 'No Signups';
                                } else {
                                    foreach ($signups as $signup) {
                                        $pilot = PilotData::getPilotData($signup->pilot_id);
                                        echo date('G:i', strtotime($signup->time)).' - ';
                                        echo PilotData::GetPilotCode($pilot->code, $pilot->pilotid).' - ';
                                        echo $pilot->firstname.' '.$pilot->lastname.'<br />';
                                        $count++;
                                    }
                                }
                            ?>
                        </td>
                    </tr>
                    <?php } else { ?>
                    <tr>
                        <?php
                            $check = EventsData::check_signup(Auth::$userinfo->pilotid, $event->id);
                            if($check->total >= '1') {
                                echo '<td>You Are Already Signed Up For This Event</td>';

                                echo '<td align="left">';
                                    $slot_time = strtotime($event->time);
                                    $slots=1;
                                    while ($slots <= $event->slot_limit):
                                        $test = date('G:i',$slot_time);
                                        $check2 = EventsData::signup_time($event->id, $test);
                                        if(!$check2) {
                                            echo date('G:i', $slot_time).' - Open<br />';
                                            $slots++;
                                        } else {
                                            $pilot = PilotData::getPilotData($check2->pilot_id);
                                            echo date('G:i', $slot_time).' - ';
                                            echo PilotData::GetPilotCode($pilot->code, $pilot->pilotid).' - ';
                                            echo $pilot->firstname.' '.$pilot->lastname;
                                            if($pilot->pilotid == Auth::$pilotid) {echo ' <a href="'.SITE_URL.'/index.php/events/remove_signup?id='.$pilot->pilotid.'&event='.$event->id.'">- Remove</a>';}
                                            echo '<br />';
                                        }
                                        $slot_time = $slot_time + ($event->slot_interval * 60);
                                    endwhile;
                                    echo '</td>';
                            } else {
                                echo '<td scope="col">Available Signups</td>';

                                echo '<td style="margin-top: 10px; margin-bottom: 10px;" align="left">';
                                    $slot_time = strtotime($event->time);
                                    $slots=1;
                                    while ($slots <= $event->slot_limit):
                                        $test = date('G:i',$slot_time);
                                        $check2 = EventsData::signup_time($event->id, $test);
                                        if(!$check2) {
                                            echo date('G:i', $slot_time).' - <a href="'.SITE_URL.'/index.php/events/signup?eid='.$event->id.'&pid='.Auth::$userinfo->pilotid.'&time='.date('G:i', $slot_time).'">Open</a><br />';
                                            $slots++;
                                        } else {
                                            $pilot = PilotData::getPilotData($check2->pilot_id);
                                            echo date('G:i', $slot_time).' - ';
                                            echo PilotData::GetPilotCode($pilot->code, $pilot->pilotid).' - ';
                                            echo $pilot->firstname.' '.$pilot->lastname.'<br />';
                                        }
                                        $slot_time = $slot_time + ($event->slot_interval * 60);
                                    endwhile;
                                echo '</td>';
                            }
                        ?>
                    </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
</div>