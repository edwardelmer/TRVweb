<?php if(!defined('IN_PHPVMS') && IN_PHPVMS !== true) { die(); } ?>
<div class="section-header">
	<h1>IVAO FPL</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?php echo SITE_URL; ?>">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="javascript::">Flight Operation</a></div>
        <div class="breadcrumb-item">Hub Data</div>
    </div>
</div>

        

<?php
        $bids = SchedulesData::getBids(Auth::$userinfo->pilotid);
        if(!$bids) {
            echo '<div class="col-md-12"><div class="alert alert-danger">You have not bid on any flights</div></div>';
        } else {
            foreach($bids as $bid) {
                $depAirport = OperationsData::getAirportInfo($bid->depicao);
                $arrAirport = OperationsData::getAirportInfo($bid->arricao);
                $aircraft = OperationsData::getAircraftByReg($bid->registration);
  
                
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
                    'departureTime'=> 'null',
                    'cruisingSpeedType'=> 'N',
                    'cruisingSpeed'=> 447,
                    'altitudeType'=> 'F',
                    'altitude'=> substr($bid->flightlevel,0,3),
                    'route'=> $bid->route,
                    'arrivalId'=> $bid->arricao,
                    'eet'=> date("H", strtotime($bid->flighttime))*3600+date("i", strtotime($bid->flighttime))*60,
                    'alternativeId'=> 'null',
                    'alternative2Id'=> 'null',
                    'remarks'=> $rmk,
                    'endurance'=> '18000',
                    'pob'=> '150', 
                    );
            
                    echo $fpl."\n";
                    echo json_encode($fpl)."\n";
                    $ivao_fpl=base64_encode(json_encode($fpl));
                    echo $ivao_fpl;
        
            }
        }
            
?>

    <div class="container">
        <h1 style="text-align:center;">Submit FPL</h1>
        <a href="https://fpl.ivao.aero/flight-plans/create?flightPlan=<?php echo $ivao_fpl;?>">
            <button class="btn btn-primary btn-lg" method="get" target="_blanks">SEND</button>
        </a>
    </div>