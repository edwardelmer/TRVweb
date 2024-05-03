<?php if(!defined('IN_PHPVMS') && IN_PHPVMS !== true) { die(); } ?>
<div class="section-header">
	<h1><?php echo SITE_NAME; ?> Past Event</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?php echo SITE_URL; ?>">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="javascript::">Flight Operations</a></div>
        <div class="breadcrumb-item"><a href="<?php echo url('/events'); ?>">Events</a></div>
        <div class="breadcrumb-item">Past Event</div>
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
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
			<div class="card-body">
                <div class="row">
			        <div class="col-md-3">
                        <h6>Participants : </h6>
                    </div>
                    <div class="col-md-9">
                        <?php
                            if(!$signups) {
                                echo 'No Participants';
                            } else {
                                foreach ($signups as $signup) {
                                    $pilot = PilotData::getPilotData($signup->pilot_id);
                                    echo date('G:i', strtotime($signup->time)).' - ';
                                    echo PilotData::GetPilotCode($pilot->code, $pilot->pilotid).' - ';
                                    echo $pilot->firstname.' '.$pilot->lastname.'<br />';
                                }
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>