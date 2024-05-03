<?php if(!defined('IN_PHPVMS') && IN_PHPVMS !== true) { die(); } ?>
<style>
    pre {
        display: block;
        padding: 9.5px;
        margin: 0 0 10px;
        font-size: 13px;
        line-height: 1.4;
        word-break: break-all;
        color: #333;
        background-color: #f5f5f5;
        border: 1px solid #ccc;
        border-radius: 4px;
    }
    
    .comments p {
        display: inline;
    }
</style>
<div class="section-header">
	<h1>My Reservations</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?php echo SITE_URL; ?>">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="javascript::">Flight Operations</a></div>
        <div class="breadcrumb-item">My Reservations</div>
    </div>
</div>

<div class="row">
    <?php
        //$bids = FltbookData::getBidsForPilot(Auth::$userinfo->pilotid);
        $bids = SchedulesData::getBids(Auth::$userinfo->pilotid);
        if(!$bids) {
            echo '<div class="col-md-12"><div class="alert alert-danger">You have not bid on any flights</div></div>';
        } else {
            foreach($bids as $bid) {
                $depAirport = OperationsData::getAirportInfo($bid->depicao);
                $arrAirport = OperationsData::getAirportInfo($bid->arricao);
    ?>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h4>Flight Informations</h4>
                <div class="card-header-action">
                   <a href="<?php echo SITE_URL;?>/index.php/Weather" target="_blank" class="btn btn-primary">Weather</a>
				</div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <ul class="list-unstyled">
                            <li>
                                <strong>Departure:</strong>
                                <a href="<?php echo SITE_URL;?>/index.php/airports/get_airport?icao=<?php echo $bid->depicao; ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo $depAirport->name; ?>"><?php echo $bid->depicao; ?></a>
                            </li>
                            <li>
                                <strong>Callsign:</strong>
                                <?php echo $bid->code . $bid->flightnum; ?>
                            </li>
                            <li>
                                <strong>Flight Level:</strong>
                                <?php echo $bid->flightlevel;?>
                            </li>
                            <li>
                                <strong>Distance:</strong>
                                <?php echo $bid->distance;?>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <ul class="list-unstyled">
                            <li>
                                <strong>Arrival:</strong>
                                <a href="<?php echo SITE_URL;?>/index.php/airports/get_airport?icao=<?php echo $bid->arricao; ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo $arrAirport->name; ?>"><?php echo $bid->arricao; ?></a>
                            </li>
                            <li>
                                <strong>Aircraft:</strong>
                                <?php echo $bid->aircraft; ?> (<?php echo $bid->registration?>)
                            </li>
                            <!--
                            <li>
                                <strong>Price:</strong>
                                <?php echo $bid->price; ?>
                            </li>-->
                            <li>
                                <strong>Flight Length:</strong>
                                <?php $bid->flighttime = str_replace(':', '.' , is_float($bid->flighttime) ? $bid->flighttime : $bid->flighttime . '.00');?>
                                <?php echo date("H:i", strtotime($bid->flighttime));?>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h4>Dispatch Options</h4>
                <?php $aircraft = OperationsData::getAircraftByReg($bid->registration); ?>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <a href="<?php echo url('/schedules/brief/'.$bid->id);?>" class="btn btn-primary" style="width: 100%">Simbrief OFP</a>
                        <br/><br/>
                        <a href="<?php echo url('/pireps/filepirep/'.$bid->bidid);?>" class="btn btn-warning" style="width: 100%">Manual PIREP</a>
                        </div>
                    <div class="col-md-6">

                        <form target="_blank" action="https://fpl.ivao.aero/api/fp/load" method="POST">
                            <input type="hidden" name="CALLSIGN" value="<?php echo $bid->code . $bid->flightnum; ?>" />
                            <input type="hidden" name="RULES" value="I" />
                            <input type="hidden" name="FLIGHTTYPE" value="S" />
                            <input type="hidden" name="NUMBER" value="" />
                            <input type="hidden" name="DEPICAO" value="<?php echo $bid->depicao; ?>" />
                            <input type="hidden" name="DEPTIME" value="" />
                            <input type="hidden" name="SPEEDTYPE" value="N" />
                            <input type="hidden" name="SPEED" value="440" />
                            <input type="hidden" name="LEVELTYPE" value="F" />
                            <input type="hidden" name="LEVEL" value="<?php echo substr($bid->flightlevel,0,3);?>" />
                            <input type="hidden" name="ROUTE" value="<?php echo $bid->route; ?>" />
                            <input type="hidden" name="DESTICAO" value="<?php echo $bid->arricao; ?>" />
                            <input type="hidden" name="EET" value="<?php echo date("Hi", strtotime($bid->flighttime));?>" />
                            <input type="hidden" name="ALTICAO" value="" />
                            <input type="hidden" name="ALTICAO2" value="" />
                            <input type="hidden" name="ENDURANCE" value="" />
                            <input type="hidden" name="POB" value="" />
                            
                            <input type="hidden" name="ACTYPE" value="<?php echo $aircraft->icao; ?>" />
                            <?php
                                if ($aicraft->icao = "A333") {
                                    echo '
                                    <input type="hidden" name="WAKECAT" value="H" />
                                    <input type="hidden" name="EQUIPMENT" value="SDE3GHIJ2J3J5M1RVWXYZ" />
                                    <input type="hidden" name="TRANSPONDER" value="LB1D1" />
                                	<input type="hidden" name="OTHER" value="PBN/A1B1C1D1L1O1S2 NAV/RNP2 DAT/SV DOF/';?><?php echo date("ymd");?><?php echo' REG/';?><?php echo str_replace('-','',($bid->registration)); ?><?php echo ' OPR/THEREDSVIRTUAL PER/C RMK/ACAS II EQUIPPED" />';
                                }
                                  else {
                                    echo '
                                    <input type="hidden" name="WAKECAT" value="M" />
                                    <input type="hidden" name="EQUIPMENT" value="SDE3FGHIRWY" />
                                    <input type="hidden" name="TRANSPONDER" value="LB1" />
                                    <input type="hidden" name="OTHER" value="PBN/A1B1C1D1O1S2 DOF/';?><?php echo date("ymd");?><?php echo' REG/';?><?php echo str_replace('-','',($bid->registration)); ?><?php echo ' OPR/THEREDSVIRTUAL PER/C RMK/TCAS II EQUIPPED" />
                                    ';
                                }
                                ?>

                            <input type="submit" name="submit" class="btn btn-primary" style="width: 100%" value="IVAO PreFile" />
                        </form>
                        <!-- <a target="_blank" href="https://www.vatsim.net/fp/index.php?fpc=&amp;2=<?php echo $bid->code . $bid->flightnum; ?>&amp;3=<?php echo $aircraft->icao; ?>&amp;5=<?php echo $bid->depicao; ?>&amp;7=<?php echo $bid->flightlevel;?>&amp;8=<?php echo $bid->route; ?>&amp;9=KATL&amp;11=<?php echo $bid->registration; ?> OPR/<?php echo preg_replace('#^https?://#', '', SITE_URL); ?>&amp;14=<?php echo Auth::$userinfo->firstname.' '.Auth::$userinfo->lastname; ?>" class="btn btn-primary" style="width: 100%">Vatsim Pre-File</a> -->
                        <br/>
                        <a id="<?php echo $bid->bidid; ?>" class="deleteitem btn btn-danger" href="<?php echo url('/schedules/removebid');?>" style="width: 100%">Cancel Booking</a>
                    </div>
                    <div class="card-header">
                        
                        <h6>File manual pirep ONLY when you completed the flight on Redtrax but not able to send PIREP</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4>Route</h4>
            </div>
            <div class="card-body">
                <blockquote>
                    <?php 
                        if(!$bid->route) {
                            echo 'No route found on the database.';
                        } else {
                            echo $bid->route;
                        }  
                    ?>
                </blockquote>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h4>Flight Map</h4>
            </div>
            <div class="card-body p-0">
                <?php require 'bids_map.php'; ?>
            </div>
        </div>
    </div>
    <?php } } ?>
</div>






                

<!-- REMOVE BIDS HELPER - START -->
<script>
    $('.deleteitem').on('click', function() {
        var bid_id = $(this).attr("id");
        console.log(bid_id);
        $.ajax({
            type: "POST",
            url: "<?= url('/schedules/removebid') ?>",
            data:{
                id: bid_id
            },
            success:function(response) {
                $('#bid'+bid_id).fadeOut( "slow" );
                Swal.fire({
                    title: 'Success!', 
                    html: "Reservation removed successfully!", 
                    icon: "success"
                }).then(function() {
                    window.location = "<?php echo SITE_URL; ?>";
                });
            },
            error:function(){
                Swal.fire({
                    title: 'Oopsss!', 
                    html: "There was an error removing your reservation, if you think this is an error, contact an administrator.", 
                    icon: "error"
                }).then(function() {
                    window.location = "<?php echo SITE_URL; ?>";
                });
            }
        });
        
        return false;
    });
</script>
<!-- REMOVE BIDS HELPER - END -->
