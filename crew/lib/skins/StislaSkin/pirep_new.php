<?php if(!defined('IN_PHPVMS') && IN_PHPVMS !== true) { die(); } ?>
<style>
    @media (min-width: 992px) {
        .col-md-offset-3 {
            margin-left: 15%;
        }
    }
</style>

<div class="section-header">
	<h1>File Manual PIREP</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?php echo SITE_URL; ?>">Dashboard</a></div>
        <div class="breadcrumb-item">Manual Flight Report Form</div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 col-md-offset-2">
        <div class="card">
           <div class="row">
                <div class="col-md-8 col-md-offset-3">">
                <?php
                    if(isset($message))
                    echo '<div class="alert alert-danger mb-2" role="alert"><strong>Error!</strong> '.$message.'</div>';
                ?>

                <form action="<?php echo url('/pireps/mine'); ?>" method="post">
                    <div class="section-title mt-0"><?php echo $bid->code . ' ' .  $bid->flightnum. ' by ' . Auth::$pilot->firstname . ' ' . Auth::$pilot->lastname;?></div>
                    <div class="form-group">
                           <input type="hidden" class="form-control" value="<?php echo Auth::$pilot->firstname . ' ' . Auth::$pilot->lastname;?>" readonly>
                    </div>
                    
                    <div class="form-group">
                        <label>Airline</label>
                        <input type="text" name="code" class="form-control" value="<?php if(isset($bid->code)) { echo $bid->code ; }?><?php if(isset($_POST['code'])) { echo $_POST['code'];} ?>"readonly>
                    </div>

                    <div class="form-group">
                        <label>Flight Number</label>
                        <input type="text" name="flightnum" class="form-control" value="<?php if(isset($bid->flightnum)) { echo $bid->flightnum; }?><?php if(isset($_POST['flightnum'])) { echo $_POST['flightnum'];} ?>"readonly>
                    </div>
                    
                    <div class="form-group">
                        <label>Scheduled Departure</label>
                        <input type="text" name="depicao" class="form-control" value="<?php if(isset($bid->depicao)) { echo $bid->depicao . ' - ' . OperationsData::getAirportInfo($bid->depicao)->name; }?><?php if(isset($_POST['depicao'])) { echo $_POST['depicao'];} ?>"readonly>
                    </div>
                    
                    <!--
                    <div class="form-group">
                        <select name="code" id="code" class="form-control">
                            <option value="">Select your airline</option>
                            <?php
                                foreach($airline_list as $airline) {
                                    $sel = ($_POST['code'] == $airline->code || $bid->code == $airline->code)?'selected':'';
                                    echo '<option value="'.$airline->code.'" '.$sel.'>'.$airline->code.' - '.$airline->name.'</option>';
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Departure Airport</label>
                        <select name="depicao" id="depicao" class="form-control">
                            <option value="">Select departure airport</option>
                            <?php
                                foreach($allairports as $airport) {
                                    $sel = ($_POST['depicao'] == $airport->icao || $bid->depicao == $airport->icao)?'selected':'';
                                    echo '<option value="'.$airport->icao.'" '.$sel.'>'.$airport->icao . ' - '.$airport->name .'</option>';
                                }
                            ?>
                        </select>
                    </div>
                    -->

                    <div class="form-group">
                        <label>Actual Arrival Airport</label>
                        <select name="arricao" id="arricao" class="form-control">
                            <option value="">Select arrival airport</option>
                            <?php
                                foreach($allairports as $airport) {
                                    $sel = ($_POST['arricao'] == $airport->icao || $bid->arricao == $airport->icao)?'selected':'';
                                    echo '<option value="'.$airport->icao.'" '.$sel.'>'.$airport->icao . ' - '.$airport->name .'</option>';
                                }
                            ?>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label>Aircraft Flown</label>
                        <select name="aircraft" id="aircraft" class="form-control">
                            <option value="">Select aircraft</option>
                            <?php
                                foreach($allaircraft as $aircraft) {
                                    if(Config::Get('RESTRICT_AIRCRAFT_RANKS') === true) {
                                        if($aircraft->ranklevel > Auth::$userinfo->ranklevel) {
                                            continue;
                                        }
                                    }
                                    $sel = ($_POST['aircraft'] == $aircraft->name || $bid->registration == $aircraft->registration)?'selected':'';
                                    echo '<option value="'.$aircraft->id.'" '.$sel.'>'.$aircraft->name.' - '.$aircraft->registration.'</option>';
                                }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Fuel Used</label>
                        <input type="text" name="fuelused" class="form-control" placeholder="Enter fuel used in <?php echo Config::Get('LIQUID_UNIT_NAMES', Config::Get('LiquidUnit'))?>" value="<?php echo $_POST['fuelused']; ?>">
                    </div>

                    <div class="form-group">
                        <label>Flight Time</label>
                        <input type="text" name="flighttime" class="form-control" placeholder="Enter in format HH.MM (example 3.45 = 3 hours and 45 minutes)" value="<?php echo $_POST['flighttime'] ?>">
                    </div>

                    <div class="form-group">
                        <label>Route</label>
                        <textarea class="form-control" name="route"><?php echo (!isset($_POST['route'])) ? $bid->route : $_POST['route']; ?></textarea>
                        <p>Enter the route flown, or default will be from the schedule</p>
                    </div>

                    <div class="form-group">
                        <label>RedTrax Log</label>
                        <textarea class="form-control" name="comment" placeholder="Paste complete RedTrax Log here." ><?php echo $_POST['comment'] ?></textarea>
                      
                    </div>
                    
                    <?php $bidid = ( isset($bid) )? $bid->bidid:$_POST['bid']; ?>
                    <input type="hidden" name="bid" value="<?php echo $bidid ?>" />
                    <input type="submit" name="submit_pirep" value="Submit" class="btn btn-primary float-right" />
                </form>
                </div>
            </div>
        </div>
    </div>
</div>