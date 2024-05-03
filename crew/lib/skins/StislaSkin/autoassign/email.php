<img src="<?php echo SITE_URL?>/lib/images/reds/the reds logo.png" align="center" width="300" >

Dear <?php echo $firstname.' '.$lastname ?>,
<br /><br />
these are your current week assigned flights:<br /><br />
<?php if(!$flights) { echo "No assigned flights found!"; } else { ?>
<table width="100%" border="1">
<tr>
<th>Trip ID</th>
<th>Flightnum</th>
<th>Departure</th>
<th>Arrival</th>
<th>Flighttime</th>
<th>Aircraft</th>
</tr>

<?php foreach($flights as $flight) { ?>
<tr>
<td><?php echo PilotData::GetPilotCode(Auth::$userinfo->code,Auth::$userinfo->pilotid) ?>-<?php echo $flight->itid ?></td>
<td><?php echo $flight->code.$flight->flightnum ?></td>
<td><?php echo $flight->depicao ?> (<?php echo $flight->deptime ?>)<br /> <?php echo $flight->depname ?></td>
<td><?php echo $flight->arricao ?> (<?php echo $flight->arrtime ?>)<br /> <?php echo $flight->arrname ?></td>
<td><?php echo AutoAssignData::converttime($flight->flighttime); ?></td>
<td><?php echo $flight->aircraftname ?><br /> <?php echo $flight->registration ?></td>
</tr>

<?php } ?>
</table>
<?php } ?>
<br /><br />
To fly your assigned flights please login to <a href="<?php echo SITE_URL ?>/index.php/AutoAssign/"><?php echo SITE_URL ?>/index.php/AutoAssign/</a> and click the "Book Flight" button!
<br /><br /><br /><br />
- The <?php echo SITE_NAME ?> Crew Control Division
