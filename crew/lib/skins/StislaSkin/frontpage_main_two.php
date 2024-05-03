
<?php
    #new script to trim the time format
    $newhours = Util::AddTime($userinfo->totalhours, $pilot->transferhours);
    $hrs = intval($newhours);
    $min = round(($newhours - $hrs) * 100);

    $pilotid = Auth::$userinfo->pilotid;
    $last_location = FltbookData::getLocation($pilotid);
    $last_name = OperationsData::getAirportInfo($last_location->arricao);
    if(!$last_location) {
        FltbookData::updatePilotLocation($pilotid, Auth::$userinfo->hub);
    }
?>

<div class="row">
	<div class="col-lg-3 col-md-3 col-sm-6 col-12">
        <div class="card card-statistic-2">
            <div class="card-icon shadow-primary bg-primary">
                <i class="fas fa-clipboard-check"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Pireps Filed</h4>
                </div>
                <div class="card-body"><h5><?php echo $userinfo->totalflights; ?></h5></div>
            </div>
        </div>
	</div>
	<div class="col-lg-3 col-md-3 col-sm-6 col-12">
		<div class="card card-statistic-2">
			<div class="card-icon shadow-primary bg-danger">
				<i class="fas fa-globe-asia"></i>
			</div>
			<div class="card-wrap">
				<div class="card-header">
					<h4>Current Location</h4>
				</div>
				<div class="card-body"><h5><?php echo $last_name->icao; ?></h5></div>
			</div>
		</div>
	</div>
	<div class="col-lg-3 col-md-3 col-sm-6 col-12">
		<div class="card card-statistic-2">
			<div class="card-icon shadow-primary bg-info">
				<i class="fas fa-clock"></i>
			</div>
			<div class="card-wrap">
				<div class="card-header">
					<h4>Total Hours</h4>
				</div>
				<div class="card-body"><h5><?php echo $hrs.'h '.$min.'m';?></h5></div>
			</div>
		</div>
	</div>
	<div class="col-lg-3 col-md-3 col-sm-6 col-12">
		<div class="card card-statistic-2">
			<div class="card-icon shadow-primary bg-success">
				<i class="fas fa-plane-arrival"></i>
			</div>
			<div class="card-wrap">
				<div class="card-header">
					<h4>Landing Average</h4>
				</div>
				<div class="card-body"><h5><?php echo substr($touchstats, 0, 4); ?> FPM</h5></div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-lg-8 col-md-12 col-12 col-sm-12">
		<div class="card">
			<div class="card-header">
				<h4>Live Map</h4>
			</div>
			<div class="card-body p-0">
				<?php require 'acarsmap.php'; ?>
			</div>
		</div>

		<?php
			$lastbids = SchedulesData::GetAllBids();
			$countBids = (is_array($lastbids) ? count($lastbids) : 0);
		?>
		<div class="card">
			<div class="card-header">
				<h4>Upcoming Departure</h4>
				<div class="card-header-action">
					<?php if(!$countBids) { ?>
					<a href="javascript::" class="btn btn-info">No Departures</a>
					<?php } else { ?>
					<a href="javascript::" class="btn btn-success">Upcoming</a>
					<?php } ?>
				</div>
			</div>
			<div class="card-body">
				<?php if(!$countBids) { ?>
				<div class="alert alert-danger">
					<div class="alert-title">Oops</div>
					Looks like there are no upcoming departures at the moment, do you feel like flying? Click <a href="<?php echo SITE_URL?>/index.php/fltbook">here</a> to bid a flight!
				</div>
				<?php } else { ?>

				<table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th>
                                <div align="center">Flight #</div>
                            </th>
                            <th>
                                <div align="center">Pilot</div>
                            </th>
                            <!--
                            <th>
                                <div align="center">Slot added on</div>
                            </th>
                            -->
                            <th>
                                <div align="center">Limit</div>
                            </th>
                            <th>
                                <div align="center">Departure</div>
                            </th>
                            <th>
                                <div align="center">Arrival</div>
                            </th>
                            <th>
                                <div align="center">Aircraft</div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
							foreach($lastbids as $lastbid) {
								$flightid = $lastbidbid->id
						?>
						<tr>
							<td height="25" width="10%" align="center"><font face="Bauhaus"><span><?php echo $lastbid->code; ?><?php echo $lastbid->flightnum; ?></span></font></td>
							<?php
								$params = $lastbid->pilotid;

								$pilot = PilotData::GetPilotData($params);
								$pname = $pilot->firstname;
								$psurname = $pilot->lastname;
								$now = strtotime(date('d-m-Y',strtotime($lastbid->dateadded)));
								$date = date("d/m", strtotime('+48 hours', $now));
							?>
							<td height="25" width="15%" align="center"><span><?php echo '<a class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="top" title="Click to view Pilot Information!" href="  '.SITE_URL.'/index.php/profile/view/'.$pilot->pilotid.'">'.$pname.'</a>';?></span></td>
							
							<td height="25" width="15%" align="center"><span class="text-danger"><?php echo $date; ?></span></td>
							<td height="25" width="10%" align="center"><span><font face=""><?php echo '<a class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="top" title="Click to view Airport Information!" href="  '.SITE_URL.'/index.php/airports/get_airport?icao='.$lastbid->depicao.'">'.$lastbid->depicao.'</a>';?></font></span></td>
							<td height="25" width="10%" align="center"><span><font face=""><?php echo '<a class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="top" title="Click to view Airport Information!" href="'.SITE_URL.'/index.php/airports/get_airport?icao='.$lastbid->arricao.'">'.$lastbid->arricao.'</a>';?></font></span></td>
							<td height="25" width="10%" align="center"><span><a class="btn btn- btn-sm" data-toggle="tooltip" data-placement="top" title="Click to view Aircraft Information!" href="<?php echo SITE_URL?>/index.php/Fleet/view/<?php echo '' . $lastbid->registration . ''; ?>"><?php echo $lastbid->registration; ?></a></td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
				<?php } ?>
			</div>
		</div>
	</div>

	<div class="col-lg-4 col-md-12 col-12 col-sm-12">
		<div class="card">
			<div class="card-header">
				<h4>Airline NOTAMs</h4>
				<div class="card-header-action">
					<a data-collapse="#collapse" class="btn btn-icon btn-primary" href="#"><i class="fas fa-minus"></i></a>
				</div>
			</div>
			<div class="collapse show" id="collapse">
				<div class="card-body">
					<?php MainController::Run('News', 'ShowNewsFront', 1); ?>
				</div>
			</div>
		</div>

		<div class="card">
			<div class="card-header">
				<h4>Top Pilots</h4>
				<div class="card-header-action">
					<a data-collapse="#collapse2" class="btn btn-icon btn-primary" href="#"><i class="fas fa-minus"></i></a>
				</div>
			</div>
			<div class="collapse show" id="collapse2">
			<div class="card-body">
			    <a class="btn btn-icon btn-primary" href="javascript::">By Hours</a>
				<div class="table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th scope="row">Pilots</th>
								<th scope="row">Flights</th>
								<th scope="row">Miles</th>
								<th scope="row">Hours</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$all_hours = TopPilotData::alltime_hours(5);
								foreach($all_hours as $all) {
									$pilot = PilotData::GetPilotData($all->pilotid);
							?>
							<tr>
								<td><a href="<?php echo SITE_URL.'/index.php/profile/view/'.$pilot->pilotid?>"><?php echo $pilot->firstname.' ('.PilotData::GetPilotCode($pilot->code, $pilot->pilotid); ?>)</a></td>
								<td><?php echo $pilot->totalflights; ?></td>
								<td><?php echo StatsData::TotalPilotMiles($pilot->pilotid); ?></td>
								<!--td><b><?php echo $all->totalhours; ?></b></td> -->
								<td><b><?php echo number_format($all->totalhours, 2, ':', ','); ?></b></td>

							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
			</div>
		</div>

		<?php
			if($config->discordID) {
		?>
		<div class="card">
		<iframe src="https://discord.com/widget?id=840566006010347530&theme=dark" width="350" height="500" allowtransparency="true" frameborder="0" sandbox="allow-popups allow-popups-to-escape-sandbox allow-same-origin allow-scripts"></iframe>    
		<!-- <iframe src="https://discordapp.com/widget?id=<?php echo $config->discordID; ?>&theme=dark" height="400" allowtransparency="true" frameborder="0"></iframe> -->
			</div>
		<?php } ?>

		<?php
			if($event) {
				foreach($events as $event) {
		?>
		<div class="card">
			<div class="card-header">
				<h4>Upcoming Events</h4>
				<div class="card-header-action">
					<a href="<?php echo SITE_URL.'/index.php/events/get_event?id='.$event->id; ?>" class="btn btn-info"><?php echo $event->title; ?></a>
				</div>
			</div>
			<div class="card-body p-0">
				<a href="<?php echo SITE_URL.'/index.php/events/get_event?id='.$event->id; ?>">
					<img class="img-fluid" src="<?php echo $event->image; ?>" alt="<?php echo $event->title; ?>">
				</a>
			</div>
		</div>
		<?php break; } } ?>
	</div>
</div>
