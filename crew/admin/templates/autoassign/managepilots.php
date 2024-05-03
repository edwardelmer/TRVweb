<h3>Active Pilots</h3>

<?php if(!$pilots) { echo "No Pilots found"; return; } ?>

<table class="tablesorter" width="100%">
<tr>
<th>PilotID</th>
<th>Name</th>
<th>Reset Assignments</th>
<th>Delete Assignments</th>
<th>Manage Assignments</th>
</tr>
<?php foreach($pilots as $pilot) { ?>
<tr>
<td><?php echo PilotData::GetPilotCode($pilot->code,$pilot->pilotid); ?></td>
<td><?php echo $pilot->firstname.' '.$pilot->lastname; ?></td>
<td><button class="{button:{icons:{primary:'ui-icon-grip-dotted-vertical'}}}" 
			onclick="window.location='<?php echo adminurl('/AutoAssign/resetpilotassignments/'.$pilot->pilotid); ?>';">Reset Assignments</button></td>
<td><button class="{button:{icons:{primary:'ui-icon-grip-dotted-vertical'}}}" 
			onclick="window.location='<?php echo adminurl('/AutoAssign/deletepilotassignments/'.$pilot->pilotid); ?>';">Delete Assignments</button></td>
<td><button class="{button:{icons:{primary:'ui-icon-grip-dotted-vertical'}}}" 
			onclick="window.location='<?php echo adminurl('/AutoAssign/manageassignments/'.$pilot->pilotid); ?>';">Manage Assignments</button></td>
</tr>
<?php } ?>
</table>