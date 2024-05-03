<?php
include_once '/home/u1471677/public_html/crew/core/codon.config.php';



?>

Total Pilots : <?php echo StatsData::PilotCount(); ?><br>
Total Active Pilots : <?php echo StatsData::ActivePilotCount(); ?><br>
Total Hours : <?php echo StatsData::TotalHours(); ?><br>
Total Flights : <?php echo StatsData::TotalFlights(); ?><br>
Total Schedules : <?php echo StatsData::TotalSchedules (); ?><br>
Flight Today : <?php echo StatsData::TotalFlightsToday ();?> <br>
Total Aircraft : <?php echo StatsData::TotalAircraftInFleet () ; ?><br>
Total Distance : <?php echo number_format(StatsData::TotalMilesFlown()); ?><br>
Total Pax Carried : <?php echo number_format(StatsData::TotalPaxCarried());?><br>
Current Online Flights : <?php echo ACARSData::getLiveFlightCount(); ?><br>

<?php $pilots = PilotData::getAllPilots();?>
<?php $stafflevels = vStaffListData::GetAllStaffLevels();?>

<div class="card-body">
    <table id="tabledlist" class="table">
        <thead>
            <tr>
                <th>Pilot ID</th>
                <th>Name</th>
                <th>Rank</th>
                <th>Flights</th>
                <th>Hours</th>
                <th>Hub</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pilots as $pilot) {
            /* shows active pilots only */if($pilot->retired==0){
            ?>
            <tr><td><?php echo PilotData::GetPilotCode($pilot->code, $pilot->pilotid);?></td>
            <td>
                <img src="<?php echo Countries::getCountryImage($pilot->location);?>" 
                    alt="<?php echo Countries::getCountryName($pilot->location);?>" />
                    
                <?php echo $pilot->firstname.' '.$pilot->lastname;?>
            </td>
            <td><img src="<?php echo $pilot->rankimage;?>" alt="<?php echo $pilot->rank;?>" /></td>
            <td><?php echo $pilot->totalflights;?></td>
            <td><?php echo Util::AddTime($pilot->totalhours, $pilot->transferhours); ?></td>
            <td><?php echo $pilot->hub; ?></td>
            <td>
                <?php
                if($pilot->retired == 0) {
                    echo '<span class="label label-success">Active</span>';
                } elseif($pilot->retired == 1) {
                    echo '<span class="label label-danger">Inactive</span>';
                } else {
                    echo '<span class="label label-primary">On Leave</span>';
                }
                ?>
            </td></tr>
            <?php } else {echo '';}
            } ;?>
        </tbody>
    </table>
</div>

<div class="card-body">
    <img align=center" src="<?php echo SITE_URL?>/lib/images/reds/company.png" alt="Company Structure" width="1000" >
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
			<div class="card-body">
                <table class="table table-hover">
                    <?php
                    if(!$stafflevels)
                    {
                    echo 'There is no staff!';
                    $stafflevels = array();
                    }
                    foreach($stafflevels as $level)
                    {
                    ?>
                    <thead>
                        <tr align="float-center">
                            <th colspan="3"><h5><?php echo $level->name;?></h5></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $allstaff = vStaffListData::GetAllStaffInCat($level->id);
                            if(!$allstaff)
                            {
                            $allstaff = array();
                            echo '<tr class="row0"><td align="center" colspan="3">No Staff Members</td></tr>';
                            }
                            foreach($allstaff as $staff)
                            {
                        ?>
                    	<tr width="100" align="center">
                    	<td width="30" ><?php echo $staff->title;?></td>
                        <td width="30" ><?php if($staff->pilotid == 0)
                        					{
                                            	echo 'VACANT';
                                            }
                                            else
                                            {
                                            	echo '<a href="'.url('vStaff/view/'.$staff->id).'">'.$staff->firstname.' '.$staff->lastname.'</a>';
                                            }
                                            ?></td>
                        <td width="40" ><?php echo $staff->email;?></td>
                    	</tr>
                    
                    	<?php
                        }
                        ?>
                    <?php
                    }
                    ?>
                    </tbody>
                </table>
                
            </div>
        </div>
    </div>
</div>
    