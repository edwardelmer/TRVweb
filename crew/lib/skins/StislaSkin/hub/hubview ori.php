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
						provider: '<?php echo Config::Get("MAP_TYPE"); ?>',
					});
				
					map.setView(new L.LatLng(<?php echo $hubs->lat; ?>, <?php echo $hubs->lng; ?>), 4);
				
				
				var airport_coords = {lat: <?php echo $hubs->lat; ?>, lng: <?php echo $hubs->lng; ?>};
				const marker = L.marker(airport_coords).addTo(map);
				
				
			</script>
            
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

