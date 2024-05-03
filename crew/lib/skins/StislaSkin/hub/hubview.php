<?php if(!defined('IN_PHPVMS') && IN_PHPVMS !== true) { die(); } ?>
<?php
    //simpilotgroup addon module for phpVMS virtual airline system
    //
    //simpilotgroup addon modules are licenced under the following license:
    //Creative Commons Attribution Non-commercial Share Alike (by-nc-sa)
    //To view full icense text visit https://creativecommons.org/licenses/by-nc-sa/3.0/
    //
    //@author David Clark (simpilot)
    //@copyright Copyright (c) 2009-2010, David Clark
    //@license https://creativecommons.org/licenses/by-nc-sa/3.0/
?>
<?php 
    $dest = OperationsData::getAirportInfo($icao);
    $airs = FltbookData::arrivalairport($last_location->arricao);
    $last_location = FltbookData::getLocation(Auth::$userinfo->pilotid);
    $airlines = OperationsData::getAllAirlines();  
?>

<div class="section-header">
	<h1>Hub Data</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?php echo SITE_URL; ?>">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="javascript::">Flight Operation</a></div>
        <div class="breadcrumb-item">Hub Data</div>
    </div>
</div>
<div class="row">
	<div class="col-md-12">
        <div class="widget">
			<div class="widget-simple themed-background-dark">
				<a href="javascript:void(0)" class="widget-icon pull-right themed-background">
					<i class="gi gi-google_maps animation-floating"></i></a>
				<h4 class="widget-content widget-content-light themed-color-default"><?php echo $hubs->icao;?> information</h4>
			</div>
            <div class="widget-extra">
                <table width="100%" border="0">
					<tr>
						<td><strong>Hub ICAO:</strong></td>
						<td><?php echo $hubs->icao;?></td>
						<td><strong>Airport Name:</strong></td>
						<td><?php echo $hubs->name;?></td>
						<td rowspan="2"><img width="200" src="<?php echo SITE_URL;?>/lib/images/airports/<?php echo $hubs->icao;?>.png" alt="<?php echo $hubs->icao;?>"/></td>
					</tr>
					<tr>
						<td><strong>Latitude:</strong></td>
						<td><?php echo $hubs->lat;?></td>
						<td><strong>Longtitude:</strong></td>
						<td><?php echo $hubs->lng;?></td>
					</tr>
					<tr>
						<td><strong>Hub Manager:</strong></td>
						<?php $manager = HubData::get_hubs($hubs->icao);?>
						<td><a href="<?php echo SITE_URL?>/index.php/profile/view/<?php echo $manager->pilotid;?>"><?php echo $manager->manager;?></a></td>
					</tr>
                </table>
            </div>
        </div>
			
        <div class="mapcenter" align="center">
        	<h3><?php echo $hubs->icao;?> map</h3>
        	<div id="routemap" style="width: 80%; height: <?php echo Config::Get('MAP_HEIGHT')?>"></div>
        </div>
        
			<script src="<?php echo SITE_URL?>/lib/js/base_map.js"></script>
			<script type="text/javascript">
			
			const map = createMap({
        render_elem: 'routemap',
        worldCopyJump: true,
        provider: '<?php echo Config::Get("MAP_TYPE"); ?>'
    });
</script>

<!-- WARNING (OPEN EYES FOR ANY CHANGE HERE) -->
<?php
    foreach ($airs as $air) {
        foreach ($airlines as $airline) {
            $allroutes = FltbookData::findschedule($air->arricao, $last_location->arricao, $airline->code);
            if(!$allroutes) { $allroutes = array(); }
            foreach($allroutes as $route) {
                if(Config::Get('RESTRICT_AIRCRAFT_RANKS') == 1 && Auth::LoggedIn()) {
                    if($route->aircraftlevel > Auth::$userinfo->ranklevel) {
                        continue;
                    }
                }
                
                $departure = OperationsData::getAirportInfo($route->depicao);
                $arrival   = OperationsData::getAirportInfo($route->arricao);
?>

<script type="text/javascript">
    var depLatlng = [{latitude: "<?php echo $departure->lat; ?>", longitude: "<?php echo $departure->lng; ?>"}];
    var arrLatlng = [{latitude: "<?php echo $arrival->lat; ?>", longitude: "<?php echo $arrival->lng; ?>"}];
    var selPoints = [];
    var selPointsLayer;

    // Departure & Arrival ICONs
    var depIcon = L.icon({iconUrl: url + '/lib/skins/StislaSkin/assets/img/light_red_marker_user.png', iconAnchor: [10, 33]});
    <?php if ($arrival->hub) { ?>
        <?php $hub = "(HUB)"; ?>
        var arrIcon = L.icon({iconUrl: url + '/lib/skins/StislaSkin/assets/img/light_red_marker_house.png', iconAnchor: [10, 33]});
    <?php } else { ?>
        <?php $hub = ""; ?>
        var arrIcon = L.icon({iconUrl: url + '/lib/skins/StislaSkin/assets/img/light_red_marker_plane.png', iconAnchor: [10, 33]});
    <?php } ?>

    // Departure Things
    depLatlng.forEach(function(d, i) {
        if(d.latitude != null && d.latitude != undefined) {
            // Set LatLng to get dep points
            pushDep = L.latLng([d.latitude, d.longitude]);
            selPoints.push(pushDep);

            // Marker
            selDepMarker = L.marker([d.latitude, d.longitude], {
                icon: depIcon,
                title: "<?php echo $departure->icao.' - '.$departure->name; ?>"
            }).addTo(map);
        }
    });

    // Arrival Marker
    arrLatlng.forEach(function(d, i) {
        if(d.latitude != null && d.latitude != undefined) {
            // Set LatLng to get arr points
            pushArr = L.latLng([d.latitude, d.longitude]);

            // Content to open modal
            var contentString = '<?php echo $route->arricao.' - '.$arrival->name.' '.$hub?> | <a data-toggle="modal" href="<?php echo SITE_URL?>/action.php/fltbook/confirm?id=<?php echo $route->id?>&airline=<?php echo $route->code?>&aicao=<?php echo $route->aircrafticao?>" data-target="#confirm" class="m-link">Book Flight</a>';

            // Marker
            selArrMarker = L.marker([d.latitude, d.longitude], {
                icon: arrIcon,
                title: "<?php echo $arrival->icao.' - '.$arrival->name; ?>"
            }).addTo(map).bindPopup(contentString, {maxWidth: 390});

            // On click marker function
            selArrMarker.on('click', function(event) {
                // Check if polyline already exist (if exist, the polyline will be deleted and the points reset.)
                if(selPointsLayer) {
                    selPointsLayer.remove();
                    selPointsLayer = null;
                    selPoints = [];
                }

                // Get marker and set points
                var marker = event.target;
                selPoints.push(pushDep);
                selPoints.push(marker.getLatLng());

                // Set polyline and options
                selPointsLayer = L.polyline.antPath([selPoints], {
                    weight: 2,
                    opacity: 1.0,
                    color: '#49ABEF',
                    steps: 10,
                    dashArray: [
                        15,
                        30
                    ],
                    pulseColor: "#216a9c"
                }).addTo(map);

                // Resize zoom to fit polyline
                map.fitBounds(selPointsLayer.getBounds());
            });

            // Resize zoom to all airports
            map.fitBounds([[pushDep], [pushArr]]);
        }
    });
</script>

<?php } } }  ?>
		<div class="widget-extra">
			<h3><?php echo $hubs->icao;?> stats</h3>
			<table width="100%" border="1" style="border-collapse:collapse;">
				<tr>
					<td><strong>Number of Pilots:</strong></td>
					<td><?php echo HubStats::CountPilots($hubs->icao);?></td>
				</tr>
				<tr>
					<td><strong>Number of Flights Flown:</strong></td>
					<td><?php echo HubStats::CountFlights($hubs->icao);?></td>
				</tr>
				<tr>
					<td><strong>Number of Routes Flown From <?php echo $hubs->icao;?>:</strong></td>
					<td><?php echo HubStats::CountRoutes($hubs->icao);?></td>
				</tr>
				<tr>
					<td><strong>Total Miles Flown:</strong></td>
					<td><?php echo HubStats::TotalMiles($hubs->icao);?>nm</td>
				</tr>
				<tr>
					<td><strong>Total Hours Flown:</strong></td>
					<td><?php echo round(HubStats::TotalHours($hubs->icao));?></td>
				</tr>
				<tr>
					<td><strong>Total Fuel Used:</strong></td>
					<td><?php echo round(HubStats::TotalFuelUsed($hubs->icao));?>lbs</td>
				</tr>
			</table>
		</div>
            
		<div class="widget-extra">
			<h3>Pilot Roster for <?php echo $hubs->icao;?></h3>
				<?php
				$hubs_details = HubStats::Pilots($hubs->icao);
				if($hubs_details == ''){ echo 'Sorry, no Pilots allocated to this hub yet. <br /></div>';}
				 else
				{
				?>
					<script type="text/javascript">
						$(document).ready(function() {
							$('#plist').dataTable( {
								"sPaginationType": "bootstrap"
							} );
						} );
					</script>
		
					<table width="100%"  id="plist" class="table table-striped">
						<thead>
							<tr id="tablehead">
								<th>Country</th>
								<th>Pilot ID</th>
								<th>Name</th>
								<th>Rank</th>
								<th>Flights</th>
								<th>Hours</th>
								<th>Group</th>
								<th>Vatsim ID/IVAO ID</th>
								<th>Active</th>
							</tr>
						</thead>
						<tbody>
							<?php
							foreach($hubs_details as $pilot)
							{
								 if($pilot->retired =='1') { continue; }
								 if($pilot->totalhours =='0'){ continue; }
								 if(!$pilot){echo "Sorry, no pilot allocated to this hub yet.";}
							?>
							<tr>
								<td><img src="<?php echo Countries::getCountryImage($pilot->location);?>" alt="<?php echo Countries::getCountryName($pilot->location);?>" /></td>
								<td width="1%" nowrap><a href="<?php echo SITE_URL?>/index.php/profile/view/<?php echo $pilot->pilotid;?>"><?php echo PilotData::GetPilotCode($pilot->code, $pilot->pilotid);?></a></td>
								<td><?php echo $pilot->firstname.' '.$pilot->lastname;?></td>
								<td align="center"><img src="<?php echo RanksData::getRankImage($pilot->rank);?>" alt="<?php echo $pilot->rank;?>" /></td>
								<td><?php echo $pilot->totalflights; ?></td>
								<td><?php echo Util::AddTime($pilot->totalhours, $pilot->transferhours); ?></td>
								<td><?php echo $pilot->group;?></td>
								<td><?php
										$fieldvalue = PilotData::GetFieldValue($pilot->pilotid, 'VATSIM ID');

										if($fieldvalue != '')

										{

										echo '<a href="http://www.vataware.com/pilot.cfm?cid='.$fieldvalue.'" target="_blank"><img src="'.SITE_URL.'/lib/skins/mva/images/vatsim.gif" alt="Vatsim ID" border="0" /></a>';
										}
									?>
									<?php
										$feildvalue = PilotData::GetFieldValue($pilot->pilotid, 'IVAO ID');
										if($feildvalue != '')
										{
										echo '<img src="https://status.ivao.aero/R/'.$feildvalue.'.png">';
										}
									?>
								</td>
								<td>
									<?php
										if($pilot->retired == 0)
										echo '<span class="label label-success">Active</span>';
										elseif($pilot->retired == 1)
										echo '<span class="label label-warning">Inactive</span>';
										elseif($pilot->retired == 2)
										echo '<span class="label label-error">Banned</span>';
										elseif($pilot->retired == 3)
										echo '<span class="label label-warning">On Leave</span>';

									?>
									<?php
									}
									?>
								</td>
							</tr>
						</tbody>
					</table>
			</div>
				<?php
				
					}
				?>
			<a href="<?php echo SITE_URL?>/index.php/Hub"><span class="btn">Back</span></a>
			<p>&copy; 2014 Strider V1.4.</p>
	</div>
</div>


<?php {
    
}

?>

<div id="routemap" style="border-bottom-right-radius: .5rem;; border-bottom-left-radius: .5rem; height: 500px;"></div>

<!-- Create Map -->
<script type="text/javascript" src="<?php echo SITE_URL; ?>/lib/js/bootstrap.js"></script>
<script src="<?php echo SITE_URL?>/lib/js/base_map.js"></script>
<script>
    const map = createMap({
        render_elem: 'routemap',
        worldCopyJump: true,
        provider: '<?php echo Config::Get("MAP_TYPE"); ?>'
    });
</script>

<!-- WARNING (OPEN EYES FOR ANY CHANGE HERE) -->
<?php
    foreach ($airs as $air) {
        foreach ($airlines as $airline) {
            $allroutes = FltbookData::findschedule($air->arricao, $last_location->arricao, $airline->code);
            if(!$allroutes) { $allroutes = array(); }
            foreach($allroutes as $route) {
                if(Config::Get('RESTRICT_AIRCRAFT_RANKS') == 1 && Auth::LoggedIn()) {
                    if($route->aircraftlevel > Auth::$userinfo->ranklevel) {
                        continue;
                    }
                }
                
                $departure = OperationsData::getAirportInfo($route->depicao);
                $arrival   = OperationsData::getAirportInfo($route->arricao);
?>

<script type="text/javascript">
    var depLatlng = [{latitude: "<?php echo $departure->lat; ?>", longitude: "<?php echo $departure->lng; ?>"}];
    var arrLatlng = [{latitude: "<?php echo $arrival->lat; ?>", longitude: "<?php echo $arrival->lng; ?>"}];
    var selPoints = [];
    var selPointsLayer;

    // Departure & Arrival ICONs
    var depIcon = L.icon({iconUrl: url + '/lib/skins/StislaSkin/assets/img/light_red_marker_user.png', iconAnchor: [10, 33]});
    <?php if ($arrival->hub) { ?>
        <?php $hub = "(HUB)"; ?>
        var arrIcon = L.icon({iconUrl: url + '/lib/skins/StislaSkin/assets/img/light_red_marker_house.png', iconAnchor: [10, 33]});
    <?php } else { ?>
        <?php $hub = ""; ?>
        var arrIcon = L.icon({iconUrl: url + '/lib/skins/StislaSkin/assets/img/light_red_marker_plane.png', iconAnchor: [10, 33]});
    <?php } ?>

    // Departure Things
    depLatlng.forEach(function(d, i) {
        if(d.latitude != null && d.latitude != undefined) {
            // Set LatLng to get dep points
            pushDep = L.latLng([d.latitude, d.longitude]);
            selPoints.push(pushDep);

            // Marker
            selDepMarker = L.marker([d.latitude, d.longitude], {
                icon: depIcon,
                title: "<?php echo $departure->icao.' - '.$departure->name; ?>"
            }).addTo(map);
        }
    });

    // Arrival Marker
    arrLatlng.forEach(function(d, i) {
        if(d.latitude != null && d.latitude != undefined) {
            // Set LatLng to get arr points
            pushArr = L.latLng([d.latitude, d.longitude]);

            // Content to open modal
            var contentString = '<?php echo $route->arricao.' - '.$arrival->name.' '.$hub?> | <a data-toggle="modal" href="<?php echo SITE_URL?>/action.php/fltbook/confirm?id=<?php echo $route->id?>&airline=<?php echo $route->code?>&aicao=<?php echo $route->aircrafticao?>" data-target="#confirm" class="m-link">Book Flight</a>';

            // Marker
            selArrMarker = L.marker([d.latitude, d.longitude], {
                icon: arrIcon,
                title: "<?php echo $arrival->icao.' - '.$arrival->name; ?>"
            }).addTo(map).bindPopup(contentString, {maxWidth: 390});

            // On click marker function
            selArrMarker.on('click', function(event) {
                // Check if polyline already exist (if exist, the polyline will be deleted and the points reset.)
                if(selPointsLayer) {
                    selPointsLayer.remove();
                    selPointsLayer = null;
                    selPoints = [];
                }

                // Get marker and set points
                var marker = event.target;
                selPoints.push(pushDep);
                selPoints.push(marker.getLatLng());

                // Set polyline and options
                selPointsLayer = L.polyline.antPath([selPoints], {
                    weight: 2,
                    opacity: 1.0,
                    color: '#49ABEF',
                    steps: 10,
                    dashArray: [
                        15,
                        30
                    ],
                    pulseColor: "#216a9c"
                }).addTo(map);

                // Resize zoom to fit polyline
                map.fitBounds(selPointsLayer.getBounds());
            });

            // Resize zoom to all airports
            map.fitBounds([[pushDep], [pushArr]]);
        }
    });
</script>

<?php } } }  ?>


