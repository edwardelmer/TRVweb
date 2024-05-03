<?php if(!defined('IN_PHPVMS') && IN_PHPVMS !== true) { die(); } ?>
<style>
    .routeimg {
        height: 35px;
        margin-right: 3px;
    }
</style>
<div class="section-header">
	<h1>Schedule Briefing</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?php echo SITE_URL; ?>">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="javascript::">Flight Operations</a></div>
        <div class="breadcrumb-item"><a href="javascript::">My Reservations</a></div>
        <div class="breadcrumb-item">Schedule Briefing</div>
    </div>
</div>

<form id="sbapiform">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Flight Plan Briefing</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr align="center">
                                    <!-- <th scope="row">Airline</th> -->
                                    <th scope="row">Flight</th>
                                    <th scope="row">Departure</th>
                                    <th scope="row">Arrival</th>
                                    <th scope="row">Distance</th>
                                    <th scope="row">Date</th>
                                    <th scope="row">ETD (UTC)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr align="center" width="100">
                                    <!-- <td><?php echo $schedule->code.$schedule->airline; ?></td> -->
                                    <td><?php echo $schedule->code.$schedule->flightnum; ?></td>
                                    <td><?php echo "{$schedule->depicao}"; ?></td>
                                    <td><?php echo "{$schedule->arricao}"; ?></td>
                                    <td><?php echo "{$schedule->distance}"; ?></td>
                                    <td width-"10">
                                        <input class="form-control datepicker" name="date" type="text" id="datepicker">
                                            <!--  additional javascript -->
                                            <?php
												$precision = 60 * 5;
												$scheduleDeparture = round((strtotime("+20 minutes") + $precision / 2) / $precision) * $precision;
												echo '<script type="text/javascript">
												document.getElementById("datepicker").value ="' . date('Y-m-d', $scheduleDeparture) . '";</script>'; 
											?>
                                    </td>
                                    <td>
                                        <?php
                                            $r = range(0, 23);
                    
                                            //$selected = is_null($selected) ? date('H') : $selected;
											$selected = date('H', $scheduleDeparture);
                                            $select = "<select class='form-control' style='width: auto; display: inline;' name=deph id=dephour>\n";
                                            foreach ($r as $hour)
                                            {
                                                    $select .= "<option value=\"$hour\"";
                                                    $select .= ($hour==$selected) ? ' selected="selected"' : '';
                                                    $select .= ">$hour</option>\n";
                                            }
                                            $select .= '</select>';
                                            echo $select;
                                            echo" : ";
                                                                                    $rminutes = range(0, 59);

                                            //$selected = is_null($selected) ? date('i') : $selected;
											$selected = date('i', $scheduleDeparture);
                                            $selectminutes = "<select class='form-control' style='width: auto; display: inline;' name=depm id=dephour>\n";
                                            foreach ($rminutes as $minutes) {
                                                    $selectminutes .= "<option value=\"$minutes\"";
                                                    $selectminutes .= ($minutes==$selected) ? ' selected="selected"' : '';
                                                    $selectminutes .= ">$minutes</option>\n";
                                            }
                                            $selectminutes .= '</select>';
                                            echo $selectminutes;
                                        ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4>Flight Plan Options</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <td>Aircraft Type :</td>
                            <!--
                            <td>
                                <select class="form-control" name="type">
                                    <?php
                                        $equipment = OperationsData::getAllAircraftSingle(true);
                                        if(!$equipment) $equipment = array();
                                        foreach($equipment as $equip) {
                                            echo '<option value="'.$equip->icao.'">'.$equip->name.'</option>';
                                        }
                                    ?>
                                </select>
                            </td>
                            <td>
								<select class="form-control" name="type">
									<option value="65207_1628836410123" selected>A320</option>
									<option value="65207_1628837517508">A21N</option>
									<option value="65207_1628837928348">A321</option>
									<option value="65207_1628838197544">A333</option>
									<option value="65207_1629208464246">A333 TAX</option>
								</select>
							</td>-->
                            <td>
                                <?php
                                    #Define aircraft data from Simbrief profile
                                    $aircraft['A320'] = '65207_1628836410123';
                                    $aircraft['A21N'] = '65207_1628837517508';
                                    $aircraft['A321'] = '65207_1628837928348';
                                    $aircraft['A333'] = '65207_1628838197544';
                                    $aircraft['A333 TAX'] = '65207_1629208448246';

                                    $selected = $schedule->code;
                                    if ($selected == 'TAX') { $selected = 'A333 TAX'; }
                                    elseif ($selected == 'IDX') { $selected = 'A333'; }
                                    else { $selected = 'A320'; }
                                    
                                    $select = '<select class="form-control" name="type">';
                                    foreach ($aircraft as $a => $value) {
                                        $select .= "<option value=\"$value\"";
                                        $select .= ($a == $selected) ? ' selected="selected"' : '';
                                        $select .= ">$a</option>\n";
                                    }
                                    $select .= '</select>';
                                    echo $select;
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Origin :</td>
                            <td><input class="form-control" name="orig" size="5" type="text" placeholder="ZZZZ" maxlength="4" value="<?php echo "$schedule->depicao"; ?>"></td>
                        </tr>
                        <tr>
                            <td>Destination :</td>
                            <td><input class="form-control" name="dest" size="5" type="text" placeholder="ZZZZ" maxlength="4" value="<?php echo "$schedule->arricao"; ?>"></td>
                        </tr>
                        <tr>
                            <td>Units :</td>
                            <td><select class="form-control" name="units"><option value="KGS" selected>KGS</option><option value="LBS">LBS</option></select></td>
                        </tr>
                        <tr>
                            <td>Cont Fuel : </td>
                            <td><select class="form-control" name="contpct"><option value="0">0 %</option><option value="0.03">3 %</option><option value="0.05" selected>5 %</option></select></td>
                        </tr>
                        <tr>
                            <td>Reserve Fuel : </td>
                            <td><select class="form-control" name="resvrule"><option value="0">0 MIN</option><option value="15">15 MIN</option><option value="30" selected>30 MIN</option><option value="45">45 MIN</option><option value="60">60 MIN</option></select></td>
                        </tr>	
                        <tr>
                            <td>Detailed Navlog : </td>
                            <td><input type="hidden" name="navlog" value="0"><input type="checkbox" name="navlog" value="1" checked></td>
                        </tr>
                        <tr>
                            <td>ETOPS Planning : </td>
                            <td><input type="hidden" name="etops" value="0"><input type="checkbox" name="etops" value="1"></td>
                        </tr>
                        <tr>
                            <td>Plan Stepclimbs : </td>
                            <td><input type="hidden" name="stepclimbs" value="0"><input type="checkbox" name="stepclimbs" value="1" checked></td>
                        </tr>
                        <tr>
                            <td>Runway Analysis : </td>
                            <td><input type="hidden" name="tlr" value="0"><input type="checkbox" name="tlr" value="1" checked></td>
                        </tr>
                        <tr>
                            <td>Include NOTAMS : </td>
                            <td><input type="hidden" name="notams" value="0"><input type="checkbox" name="notams" value="1" checked></td>
                        </tr>
                        <tr>
                            <td>FIR NOTAMS : </td>
                            <td><input type="hidden" name="firnot" value="0"><input type="checkbox" name="firnot" value="1"></td>
                        </tr>
                        <tr>
                            <td>Flight Maps : </td>
                            <td><select class="form-control" name="maps"><option value="detail">Detailed</option><option value="simple">Simple</option><option value="none">None</option></select></td>
                        </tr>
                        <tr>
                            <td>Plan Layout :</td>
                            <td><select class="form-control" onchange="" name="planformat" id="planformat"><option value="lido" selected="">LIDO</option><option value="aal">AAL</option><option value="aca">ACA</option><option value="afr">AFR</option><option value="awe">AWE</option><option value="baw">BAW</option><option value="ber">BER</option><option value="dal">DAL</option><option value="dlh">DLH</option><option value="ezy">EZY</option><option value="gwi">GWI</option><option value="jbu">JBU</option><option value="jza">JZA</option><option value="klm">KLM</option><option value="ryr">RYR</option><option value="swa">SWA</option><option value="uae">UAE</option><option value="ual">UAL</option><option value="ual f:wz">UAL F:WZ</option></select></td> 
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4>Route Planner</h4>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <td>
                                <span class="disphead">Route Guide</span> (<a href="https://www.simbrief.com/system/guide.php#routeguide" target="_blank">?</a>)
                                <span style="font-size:14px;font-weight:bold;padding:0px 5px">&rarr;</span>
                                <a href="https://flightaware.com/analysis/route.rvt?origin=<?php echo $schedule->depicao; ?>&destination=<?php echo $schedule->arricao; ?>" id="falink" target="_blank">
                                <img class="routeimg" src="<?php echo fileurl('/lib/skins/StislaSkin/assets/img/logos/flightaware.png');?>" alt="Flightaware" title="FlightAware"></a> 
                                <a href="https://skyvector.com/?chart=304&zoom=6&fpl=<?php echo $schedule->depicao; ?>%20<?php echo $schedule->route; ?>%20<?php echo $schedule->arricao; ?>" id="sklink" target="_blank">
                                <img class="routeimg" src="<?php echo fileurl('/lib/skins/StislaSkin/assets/img/logos/routes_skv.png');?>" alt="SkyVector" title="SkyVector"></a>
                                <a href="http://rfinder.asalink.net/free/" id="rflink" target="_blank">
                                <img class="routeimg" src="<?php echo fileurl('/lib/skins/StislaSkin/assets/img/logos/routefinder.png');?>" alt="RouteFinder" title="RouteFinder"></a>
                                <!-- <a target="_blank" style="cursor:pointer" onclick="validate_cfmu();">
                                <img class="routeimg" src="<?php echo fileurl('/lib/skins/StislaSkin/assets/img/logos/euro-ctl.png');?>" alt="CFMU Validation" title="CFMU Validation"></a>-->
                            </td>
                        </tr>
                        <tr>
                            <td><textarea class="form-control" name="route" placeholder="Enter your route here"><?php echo $schedule->route ?></textarea></td>
                        </tr>
                        <tr>
                            <td><em><strong>Note: This is company route from schedule data<?php echo empty(!str_replace(" " , "" , $schedule->notes)) ? ' according to <u>' . $schedule->notes . '</u>': ""; ?>. Remove any reference to &quot;SID&quot; &amp; &quot;STAR&quot; in your route, before generating your OFP. You may get errors if you don't.</strong></em></td>
                        </tr>
                    </table>
                </div>
            </div>
            
            <p><em><strong>SimBrief or Navigraph account is required to generate the OFP. Sign up for free <a href="https://www.simbrief.com" title="Sign up for SimBrief">SimBrief</a> account before using this feature. </strong></em></p>   
            <button type="button" style="width:100%" class="btn btn-primary btn-lg" onclick="simbriefsubmit('<?php echo SITE_URL; ?>/index.php/SimBrief');" style="font-size:30px" value="Generate SimBrief">Click to Generate OFP</button>
            <input type="hidden" name="airline" value="<?php echo $schedule->code ?>">
            <!-- #Set by Simbrief Aircraft data <input type="hidden" name="acdata" value="{'extrarmk':'OPR\/<?php echo $schedule->code ?>/THEREDSVIRTUAL'}"> -->
            <input type="hidden" name="fltnum" value="<?php echo $schedule->flightnum ?>"> 
            <input type="hidden" name="reg" value="<?php echo $schedule->registration ?>">
            <input type="hidden" name="fuelfactor" value="P03">
            <input type="hidden" name="civalue" value="21">
            <input type="hidden" name="dxname" value="Tone I. Pranandesh">
            

    	</div>
    </div>
</form>
