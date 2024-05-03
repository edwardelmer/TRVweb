<?php if(!defined('IN_PHPVMS') && IN_PHPVMS !== true) { die(); } ?>
<div class="section-header">
	<h1>Flight Assignment</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?php echo SITE_URL; ?>">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="javascript::">Flight Operations</a></div>
        <div class="breadcrumb-item"><a href="javascript::">Informations</a></div>
        <div class="breadcrumb-item">Filght Assignment</div>
    </div>
</div>

<div class="row">
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4>Flight Assignment for <?php echo PilotData::GetPilotCode(Auth::$userinfo->code,Auth::$userinfo->pilotid) ?></h4>
            </div>
            
            
            <div class="card-body">
                <div class="row">
                        <table class="table" width="100%">
                            <tr align="center">    
                                <td><?php if(!$flights) { echo "No assigned flights found!"; } else { ?> 
                                    <table class="table" width="100%">
                                        <thead>
                                            <tr align="center">
                                                <th scope="row">Trip ID</th>
                                                <th scope="row">Flight</th>
                                                <th scope="row">Departure</th>
                                                <th scope="row">Arrival</th>
                                                <th scope="row">ETE</th>
                                                <th scope="row">Aircraft</th>
                                                <th scope="row">Options</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($flights as $flight) { $booked = AutoAssignData::isflightbooked(Auth::$userinfo->pilotid, $flight->id); ?>
                                                <tr align="center">
                                                    <td><?php echo PilotData::GetPilotCode(Auth::$userinfo->code,Auth::$userinfo->pilotid) ?>-<?php echo $flight->itid ?></td>
                                                    <td><?php echo $flight->code.$flight->flightnum ?></td>
                                                    <!-- <td><?php echo $flight->depicao ?> (<?php echo $flight->deptime ?>)<br /> <?php echo $flight->depname ?></td>
                                                    <td><?php echo $flight->arricao ?> (<?php echo $flight->arrtime ?>)<br /> <?php echo $flight->arrname ?></td>-->
                                                    <td><?php echo $flight->depicao ?> (<?php echo $flight->deptime ?>)<br /></td>
                                                    <td><?php echo $flight->arricao ?> (<?php echo $flight->arrtime ?>)<br /></td>
                                                    <td><?php echo AutoAssignData::converttime($flight->flighttime); ?></td>
                                                    <td><?php echo $flight->aircraftname ?><br /> <?php echo $flight->registration ?></td>
                                                    <td><?php if(!$booked) { ?><a href="<?php echo SITE_URL ?>/index.php/autoassign/addbid/<?php echo $flight->id ?>">Book Flight</a><?php } else { ?><a href="<?php echo SITE_URL ?>/index.php/schedules/brief/<?php echo $flight->id ?>">View Briefing</a><?php } ?><br />
                                                    <?php if($setting->pilotreject == '1') { ?><a href="<?php echo SITE_URL ?>/index.php/autoassign/cancelflight/<?php echo $flight->assignid ?>" style="color:#F00">Cancel Flight</a><?php } ?></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                        <tbody>
                                            <tr align="center">
                                                <td align="right" valign="top">
                                                    <?php if($setting->pilinstacreate == '1') { ?><a href="<?php echo SITE_URL ?>/index.php/autoassign/resetassignments">Generate New Assignments</a><?php } ?>
                                                    <?php if($setting->assignmode == '1') { ?><hr /><a href="<?php echo SITE_URL ?>/index.php/autoassign/pilotsettings">Advanced Settings</a><?php } ?>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <?php } ?>
                                </td>
                            </tr>   
                        </table>
                    </div>
            </div>
        </div>
    </div>
</div>