<h3>Flight Assignments Settings</h3>
<a href="<?php echo SITE_URL ?>/index.php/AutoAssign/">back to Assignments</a><br /><br />
<?php if($setting->assignmode != '1') { ?>Assignments are Admin Controlled!<?php return; } ?>
<?php if($pilotsetting) { $setting = $pilotsetting; } ?>
<form method='post' action='<?php echo SITE_URL ?>/index.php/AutoAssign/savesettings'>


<label for='pilotenabled'>Enable Automatic Flight Assignments?</label><br />

<select name='pilotenabled' id='pilotenabled'>
<?php 
if($setting->pilotenabled == '0')
{
$sel1 = 'selected';
$sel2 = '';
}
elseif($setting->pilotenabled == '1')
{
$sel2 = 'selected';
$sel1 = '';
}
elseif(!$setting->pilotenabled || $setting->pilotenabled == '')
{
if($setting->defaultstate == '1')
{
$sel2 = 'selected';
$sel1 = '';
}
else
{
$sel1 = 'selected';
$sel2 = '';
}
}
else
{
$sel2 = 'selected';
$sel1 = '';
}
?>
<option value='0' <?php echo $sel1 ?>>Disabled</option>
<option value='1'<?php echo $sel2 ?>>Enabled</option>
</select>
<br />
<br />



<label for='howmany'>How many assignments do you want the module to create during each interval?</label><br />

<select id='howmany' name='howmany'>
<?php for($i =1; $i < 11; ++$i) { if($i % 2 == 1) { continue; } if($setting->howmany == $i) { $sel9 = 'selected'; } else { $sel9 = ''; } ?>
<option value="<?php echo $i; ?>" <?php echo $sel9 ?>><?php echo $i; ?></option>
<?php $sel9 = ''; } ?>
</select>
<br />
<br />


<label for='creationinterval'>Flight Assignment Interval?</label><br />

<select id='creationinterval' name='creationinterval'>
<?php for($i =1; $i < 15; ++$i) { if($setting->creationinterval == $i) { $sel10 = 'selected'; } else { $sel10 = ''; } ?>
<option value="<?php echo $i; ?>" <?php echo $sel10 ?>><?php echo $i; ?> Days</option>
<?php $sel10 = ''; } ?>
</select>
<br />
<br />

<label for='deleteopen'>Delete old assignments that haven't been flown whenever new assignments are created? (If "No" is selected new assignments will be appended to the already existing ones!)</label><br />

<select id='deleteopen' name='deleteopen'>
<?php if($setting->deleteopen == '1') { $sel11 = 'selected'; } elseif($setting->deleteopen == '0') { $sel12 = 'selected'; } ?>
<option value="1" <?php echo $sel11 ?>>Yes</option>
<option value="0" <?php echo $sel12 ?>>No</option>
</select>
<br />
<br />

<label for='maxtime'>Maximum flighttime per flight?</label><br />

<select id='maxtime' name='maxtime'>
<?php for($i =1; $i < 21; ++$i) { if($setting->maxtime == $i) { $sel15 = 'selected'; } else { $sel15 = ''; } ?>
<option value="<?php echo $i; ?>" <?php echo $sel15 ?>><?php echo $i; ?> Hours</option>
<?php $sel15 = ''; } ?>
</select>
<br />
<br />

<label for='sendemail'>Receive E-Mail whenever new assignments are created?</label><br />

<select id='sendemail' name='sendemail'>
<?php if($setting->sendemail == '1') { $sel20 = 'selected'; } elseif($setting->sendemail == '0') { $sel21 = 'selected'; } ?>
<option value="1" <?php echo $sel20 ?>>Yes</option>
<option value="0" <?php echo $sel21 ?>>No</option>
</select>
<br />
<br />

<label for='selectedairline'>Airlines to use for assignments?</label><br />

<select name="selectedairline[]" multiple >
              <?php 
                         $seltal = explode(':', $setting->selectedairline);
						 $airlines = explode (':', $setting->airlines);

                         foreach($airlines as $al) { 
                      $al = OperationsData::getAirlineByCode($al);
					  
                         if (in_array($al->code, $seltal)) { $seltd = 'selected'; }
                             else {
$seltd = '';
}
                      
                        ?>
                       				      <option value="<?php echo $al->code ?>" <?php echo $seltd ?>><?php echo $al->code.' - '.$al->name ?></option>
<?php $seltd =''; } ?>
               </select>
<br />
<br />

<?php if($setting->allowprefac == '1') { ?>
<label for='prefac'>Aircraft types to use for assignments?</label><br />

<select name="prefac[]" multiple >
              <?php 
                         $seltac = explode (':', $setting->prefac);
						 $aircraft = AutoAssignData::getAircraftforPilot(Auth::$userinfo->pilotid);

                         foreach($aircraft as $ac) { 
					  
                         if (in_array($ac->icao, $seltac)) { $selta = 'selected'; }
                      
                        ?>
                       				      <option value="<?php echo $ac->icao ?>" <?php echo $selta ?>><?php echo $ac->name ?></option>
<?php $selta =''; } ?>
               </select>
<br />
<br />
<?php } ?>

<?php if($setting->tohubonly != '1')
	{ ?>
<label for='prefdepicao'>Prefered Departure Airport</label><br />

<select id='prefdepicao' name='prefdepicao'>
<?php if($airports)
if($setting->prefdepicao)
{
$seltap = explode (':', $setting->prefdepicao);
}
else
{
$seltap = array(Auth::$userinfo->hub);
}
foreach($airports as $apt)
{
	if (in_array($apt->depicao, $seltap)) { $seltp = 'selected'; }
	?>
<option value="<?php echo $apt->depicao ?>" <?php echo $seltp ?>><?php echo $apt->depicao.' - '.$apt->name; ?></option>
<?php $seltp = ''; } ?>
</select>
<br />
<br />
<?php } ?>

<input type='submit' value='Save Settings' />
</form>

<br /><br />
<form action='<?php echo SITE_URL ?>/index.php/AutoAssign/defaultsettings'>
    <input type="submit" value="Reset to Default">
</form>