<h3>Automatic Flight Assignment Settings</h3>

<form method='post' action='<?php echo SITE_URL ?>/admin/index.php/AutoAssign/savesettings'>

<label for='enabled'>Enable Automatic Flight Assignments?</label><br />

<select name='enabled' id='enabled'>
<?php 
if($setting->enabled == '0')
{
$sel1 = 'selected';
}
elseif($setting->enabled == '1')
{
$sel2 = 'selected';
}
elseif($setting->enabled == '2')
{
$sel3 = 'selected';
}
?>
<option value='0' <?php echo $sel1 ?>>Disabled for ALL Pilots</option>
<option value='1'<?php echo $sel2 ?>>Enabled for ALL Pilots</option>
<option value='2' <?php echo $sel3 ?>>Let pilots decide individually</option>
</select>
<br />
<br />

<label for='defaultstate'>If the above option is set to "Let pilots decide individually" should the initial Status of the module be "Enabled" or "Disabled"?</label>
<br />

<select name='defaultstate' id='defaultstate'>
<?php 
if($setting->defaultstate == '0')
{
$sel4 = 'selected';
}
elseif($setting->defaultstate == '1')
{
$sel5 = 'selected';
}
?>

<option value='0' <?php echo $sel4 ?>>Disabled</option>
<option value='1' <?php echo $sel5 ?>>Enabled</option>
</select>
<br />
<br />

<label for="assignmode">Assignment Mode (If set to "Pilot Controlled" the settings below will be used as default but can be changed by each pilot individually according to his preferences! However settings marked with <strong>**</strong> can never be changed by the Pilot!)</label><br />

<select id="assignmode" name="assignmode">
<?php 
if($setting->assignmode == '0')
{
$sel6 = 'selected';
}
elseif($setting->assignmode == '1')
{
$sel7 = 'selected';
}
?>
<option value='0' <?php echo $sel6 ?>>Admin Controlled</option>
<option value='1' <?php echo $sel7 ?>>Pilot Controlled</option>
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



<label for='useranklimit'><strong>**</strong> Aircraft rank limits active! (Pilots get flights assigned where aircraft type meets their rank limit only!) </label><br />

<select id='useranklimit' name='useranklimit'>
<?php if($setting->useranklimit == '1') { $sel13 = 'selected'; } elseif($setting->useranklimit == '0') { $sel14 = 'selected'; } ?>
<option value="1" <?php echo $sel13 ?>>Yes</option>
<option value="0" <?php echo $sel14 ?>>No</option>
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


<label for='tohubonly'><strong>**</strong> Flight assignments from/to pilot's hub only?</label><br />

<select id='tohubonly' name='tohubonly'>
<?php if($setting->tohubonly == '1') { $sel16 = 'selected'; } elseif($setting->tohubonly == '0') { $sel17 = 'selected'; } ?>
<option value="1" <?php echo $sel16 ?>>Yes</option>
<option value="0" <?php echo $sel17 ?>>No</option>
</select>
<br />
<br />


<label for='onlyonce'><strong>**</strong> Each flight can only be assigned to 1 pilot at any given time?</label><br />

<select id='onlyonce' name='onlyonce'>
<?php if($setting->onlyonce == '1') { $sel18 = 'selected'; } elseif($setting->onlyonce == '0') { $sel19 = 'selected'; } ?>
<option value="1" <?php echo $sel18 ?>>Yes</option>
<option value="0" <?php echo $sel19 ?>>No</option>
</select>
<br />
<br />


<label for='sendemail'>Send E-Mail to pilots whenever new assignments are created?</label><br />

<select id='sendemail' name='sendemail'>
<?php if($setting->sendemail == '1') { $sel20 = 'selected'; } elseif($setting->sendemail == '0') { $sel21 = 'selected'; } ?>
<option value="1" <?php echo $sel20 ?>>Yes</option>
<option value="0" <?php echo $sel21 ?>>No</option>
</select>
<br />
<br />


<label for='allowprefac'><strong>**</strong> Allow pilots to select their prefered aircraft types?</label><br />

<select id='allowprefac' name='allowprefac'>
<?php if($setting->allowprefac == '1') { $sel22 = 'selected'; } elseif($setting->allowprefac == '0') { $sel23 = 'selected'; } ?>
<option value="1" <?php echo $sel22 ?>>Yes</option>
<option value="0" <?php echo $sel23 ?>>No</option>
</select>
<br />
<br />


<label for='pilotreject'><strong>**</strong> Allow pilots to reject assigned flights?</label><br />

<select id='pilotreject' name='pilotreject'>
<?php if($setting->pilotreject == '1') { $sel24 = 'selected'; } elseif($setting->pilotreject == '0') { $sel25 = 'selected'; } ?>
<option value="1" <?php echo $sel24 ?>>Yes</option>
<option value="0" <?php echo $sel25 ?>>No</option>
</select>
<br />
<br />


<label for='pilinstacreate'><strong>**</strong> Allow pilots to instantly create new assignments at any time?</label><br />

<select id='pilinstacreate' name='pilinstacreate'>
<?php if($setting->pilinstacreate == '1') { $sel26 = 'selected'; } elseif($setting->pilinstacreate == '0') { $sel27 = 'selected'; } ?>
<option value="1" <?php echo $sel26 ?>>Yes</option>
<option value="0" <?php echo $sel27 ?>>No</option>
</select>
<br />
<br />


<label for='airlines'><strong>**</strong> Airlines to use for assignments?</label><br />

<select name="airlines[]" multiple >
              <?php 
                         $seltal = explode(':', $setting->airlines);

                         foreach($airlines as $al) { 
                      
                         if (in_array($al->code, $seltal)) { $seltd = 'selected'; }
                      
                        ?>
                       				      <option value="<?php echo $al->code ?>" <?php echo $seltd ?>><?php echo $al->code.' - '.$al->name ?></option>
<?php $seltd =''; } ?>
               </select>
<br />
<br />


<input type='submit' value='Save Settings' />

</form>