<?php
//simpilotgroup addon module for phpVMS virtual airline system
//
//simpilotgroup addon modules are licenced under the following license:
//Creative Commons Attribution Non-commercial Share Alike (by-nc-sa)
//To view full license text visit https://creativecommons.org/licenses/by-nc-sa/3.0/
//
//@author David Clark (simpilot)
//@copyright Copyright (c) 2009-2010, David Clark
//@license https://creativecommons.org/licenses/by-nc-sa/3.0/
?>
<?php if(!defined('IN_PHPVMS') && IN_PHPVMS !== true) { die(); } ?>
<div class="section-header">
	<h1>Touchdown Statistics</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?php echo SITE_URL; ?>">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="javascript::">Pilot Administration</a></div>
        <div class="breadcrumb-item"><a href="javascript::">Leaderboard</a></div>
        <div class="breadcrumb-item">Landing Statistic</div>
    </div>
</div>
<div class="row">
    <h5>Most Kissed Landings</h5>
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                        <table class="table" width="100%">
                            <thead>
                                <tr align="center">
                                    <th scope="row">Pilot</th>
                                    <th scope="row">Aircraft</th>
                                    <th scope="row">Arrival Field</th>
                                    <th scope="row">Landing Rate</th>
                                    <th scope="row">Date Posted</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach($stats as $stat)
                                    //if($stat->landingrate < '-50'){exit;}
                                    {
                                        $pilot = PilotData::getPilotData($stat->pilotid);
                                        $aircraft = OperationsData::getAircraftInfo($stat->aircraft);
                                        echo '<tr align="center">';
                                        echo '<td>'.PilotData::getPilotCode($pilot->code, $pilot->pilotid).' - '.$pilot->firstname.' '.$pilot->lastname.'</td>';
                                        echo '<td>'.$aircraft->fullname.'</td>';
                                        echo '<td>'.$stat->arricao.'</td>';
                                        echo '<td>'.$stat->landingrate.'</td>';
                                        echo '<td>'.date(DATE_FORMAT, strtotime($stat->submitdate)).'</td>';
                                        echo '</tr>';
                                    }
                                ?>
                            </tbody>
                            
                            
                        </table>
                        
                </div>
            </div>
    </div>

<div class="row">
    <h5>Bonecrusher Landings</h5>
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                        <table class="table" width="100%">
                            <thead>
                                <tr align="center">
                                    <th scope="row">Pilot</th>
                                    <th scope="row">Aircraft</th>
                                    <th scope="row">Arrival Field</th>
                                    <th scope="row">Landing Rate</th>
                                    <th scope="row">Date Posted</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach($gabruks as $gabruk)
                                    //if($stat->landingrate < '-50'){exit;}
                                    {
                                        $pilot = PilotData::getPilotData($gabruk->pilotid);
                                        $aircraft = OperationsData::getAircraftInfo($gabruk->aircraft);
                                        echo '<tr align="center">';
                                        echo '<td>'.PilotData::getPilotCode($pilot->code, $pilot->pilotid).' - '.$pilot->firstname.' '.$pilot->lastname.'</td>';
                                        echo '<td>'.$aircraft->fullname.'</td>';
                                        echo '<td>'.$gabruk->arricao.'</td>';
                                        echo '<td>'.$gabruk->landingrate.'</td>';
                                        echo '<td>'.date(DATE_FORMAT, strtotime($gabruk->submitdate)).'</td>';
                                        echo '</tr>';
                                    }
                                ?>
                            </tbody>
                            
                            
                        </table>
                        
                </div>
            </div>
    </div>
</div>
