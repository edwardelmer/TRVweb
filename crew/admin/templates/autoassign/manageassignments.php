<h3>Assigned Flights - <?php echo PilotData::GetPilotCode($pilot->code,$pilot->pilotid) ?> <?php echo $pilot->firstname.' '.$pilot->lastname; ?></h3>
<a href="<?php echo SITE_URL ?>/admin/index.php/AutoAssign/managepilots">back to Pilots</a><br /><br />
Manually assign flight to pilot:
<form method="post" action="<?php echo SITE_URL ?>/admin/index.php/AutoAssign/addflighttopilot/<?php echo $pilot->pilotid ?>">
<select id='schedid' name='schedid'>
<?php if($schedules)
foreach($schedules as $sched)
{
	?>
<option value="<?php echo $sched->id ?>"><?php echo $sched->code.$sched->flightnum.' | '.$sched->depicao.' ('.$sched->deptime.') - '.$sched->arricao.' ('.$sched->deptime.') | '.$sched->icao.' ('.$sched->registration.')'; ?></option>
<?php $seltp = ''; } ?>
</select>
<br /><br />
<input type="submit" value="Assign Flight">
</form>
<br /><hr /><br />
<?php if(!$flights) { echo "No assigned flights found for this pilot!"; } else { ?>
<table width="100%" border="1">
<tr>
<th>Trip ID</th>
<th>Flightnum</th>
<th>Departure</th>
<th>Arrival</th>
<th>Flighttime</th>
<th>Aircraft</th>
<th>Options</th>
</tr>

<?php foreach($flights as $flight) { $booked = AutoAssignData::isflightbooked(Auth::$userinfo->pilotid, $flight->id); ?>
<tr>
<td><?php echo PilotData::GetPilotCode(Auth::$userinfo->code,Auth::$userinfo->pilotid) ?>-<?php echo $flight->itid ?></td>
<td><?php echo $flight->code.$flight->flightnum ?></td>
<td><?php echo $flight->depicao ?> (<?php echo $flight->deptime ?>)<br /> <?php echo $flight->depname ?></td>
<td><?php echo $flight->arricao ?> (<?php echo $flight->arrtime ?>)<br /> <?php echo $flight->arrname ?></td>
<td><?php echo AutoAssignData::converttime($flight->flighttime); ?></td>
<td><?php echo $flight->aircraftname ?><br /> <?php echo $flight->registration ?></td>
<td><a href="<?php echo SITE_URL ?>/admin/index.php/autoassign/cancelflight/<?php echo $flight->assignid ?>?id=<?php echo $pilot->pilotid ?>" style="color:#F00">Delete Assignment</a></td>
</tr>

<?php } ?>
</table>
<?php } ?>
