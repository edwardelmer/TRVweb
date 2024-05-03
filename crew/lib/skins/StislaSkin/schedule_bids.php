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
                        <?php
                            $bids = SchedulesData::getBids(Auth::$userinfo->pilotid);
                            if(!$bids) {
                                echo '<div class="col-md-12"><div class="alert alert-danger">You have not bid on any flights</div></div>';
                            } else {
                                foreach($bids as $bid) {
                                    $depAirport = OperationsData::getAirportInfo($bid->depicao);
                                    $arrAirport = OperationsData::getAirportInfo($bid->arricao);
                                    $aircraft = OperationsData::getAircraftByReg($bid->registration);
                                    date_default_timezone_set('Zulu');
                      
                                    
                                    if(OperationsData::getAircraftByReg($bid->registration)->icao =="A333") {
                                            $wtc = 'H';
                                            $eqp = array ('S','D','E3','G','H','I','J2','J3','J5','M1','R','V','W','X','Y','Z');
                                            $trx = array ('L','B1','D1');
                                            $rmk = 'PBN/A1B1C1D1L1O1S2 NAV/RNP2 DAT/SV DOF/'.date("ymd").' REG/'.str_replace('-','',($bid->registration)).' OPR/THEREDSVIRTUAL PER/C RMK/ACAS II EQUIPPED';
                                        } else {
                                            $wtc = 'M';
                                            $eqp = array ('S','D','E3','F','G','H','I','R','W','Y');
                                            $trx = array ('L','B1');
                                            $rmk = 'PBN/A1B1C1D1O1S2 DOF/'.date("ymd").' REG/'.str_replace('-','',($bid->registration)).' OPR/THEREDSVIRTUAL PER/C RMK/TCAS II EQUIPPED';                                   ';';
                                        }
                                        
                    
                                    
                                    $fpl = array(
                                        'callsign'=> $bid->code . $bid->flightnum,
                                        'flightRules'=> 'I',
                                        'flightType'=> 'S',
                                        'aircraftNumber'=> 1,
                                        'aircraftId'=> OperationsData::getAircraftByReg($bid->registration)->icao,
                                        'aircraftWakeTurbulence'=> $wtc,
                                        'aircraftEquipments'=> $eqp,
                                        'aircraftTransponderTypes'=>$trx,
                                        'departureId'=> $bid->depicao,
                                        'departureTime'=> date("H")*3600+date("i")*60+(30*60),
                                        'cruisingSpeedType'=> 'N',
                                        'cruisingSpeed'=> 447,
                                        'altitudeType'=> 'F',
                                        'altitude'=> substr($bid->flightlevel,0,3),
                                        'route'=> $bid->route,
                                        'arrivalId'=> $bid->arricao,
                                        'eet'=> date("H", strtotime($bid->flighttime))*3600+date("i", strtotime($bid->flighttime))*60,
                                        'alternativeId'=> '',
                                        'alternative2Id'=> '',
                                        'remarks'=> $rmk,
                                        'endurance'=> '',
                                        'pob'=> '', 
                                        );
                                
                                        $ivao_fpl=base64_encode(json_encode($fpl));

                            
                                }
                            }
                                
                        ?>
                    
                        <a onclick="window.open ('https://fpl.ivao.aero/flight-plans/create?flightPlan=<?php echo $ivao_fpl;?>', ''); return false" href="javascript:void(0);" class="btn btn-icon btn-primary" style="width: 100%">IVAO Pre File</a>
                        <br/><br/>
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

<script>
$('.prefile').on('click', function() {
    window.location = "https://fpl.ivao.aero/flight-plans/create?flightPlan=" + fpl;
}
        let plans = [];
        const addPlan = (ev)=>{
            ev.preventDefault();  //to stop the form submitting
            let plan = {
                callsign: document.getElementById('callsign').value,
                flightRules: document.getElementById('flightRules').value,   
                flightType: document.getElementById('flightType').value,
                aircraftNumber: document.getElementById('aircraftNumber').value,
                aircraftId: document.getElementById('aircraftId').value,
                aircraftWakeTurbulence : document.getElementById('aircraftWakeTurbulence').value,
                aircraftEquipments: document.getElementById('aircraftEquipments').value,
                aircraftTransponderTypes: document.getElementById('aircraftTransponderTypes').value,
                departureId: document.getElementById('departureId').value,
                departureTime: document.getElementById('departureTime').value,
                cruisingSpeedType: document.getElementById('cruisingSpeedType').value,
                cruisingSpeed: document.getElementById('cruisingSpeed').value,
                altitudeType: document.getElementById('altitudeType').value,
                altitude: document.getElementById('altitude').value,
                route: document.getElementById('route').value,
                arrivalId: document.getElementById('arrivalId').value,
                eet: document.getElementById('eet').value,
                alternativeId: document.getElementById('alternativeId').value,
                alternative2Id: document.getElementById('alternative2Id').value,
                remarks: document.getElementById('remarks').value,
                endurance: document.getElementById('endurance').value,
                pob: document.getElementById('pob').value

            }
            plans.push(plan);
            const string = JSON.stringify(plans);
            var fpl = btoa(string);
            
            document.forms[0].reset(); // to clear the form for the next entries
            //document.querySelector('form').reset();

            //for display purposes only
            //console.warn('added' , {movies} );
            //let pre = document.querySelector('#msg pre');
            encoded = '\n' + btoa(JSON.stringify(plans, '\t', 2));


            //saving to localStorage
            //localStorage.setItem('MyMovieList', JSON.stringify(movies) );
        }
        document.addEventListener('DOMContentLoaded', ()=>{
            document.getElementById('prefile').addEventListener('click', addPlan);
        });
    </script>




                

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
