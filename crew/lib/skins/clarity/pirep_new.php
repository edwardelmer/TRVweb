<?php if(!defined('IN_PHPVMS') && IN_PHPVMS !== true) { die(); } ?>

 <div class="content">							<div class="row">
								<div class="col-lg-6">
									<div class="card card-default">
										<div class="card-header card-header-border-bottom">
											<h2>File a Flight Report</h2>
										</div>
										<div class="card-body">
										<?php
if(isset($message))
	echo '<div id="error">'.$message.'</div>';
?>
											<form action="<?php echo url('/pireps/mine');?>" method="post">

												<div class="form-group">
													<label for="exampleFormControlInput1">Pilot</label>
													<span class="mt-2 d-block"><?php echo Auth::$pilot->firstname . ' ' . Auth::$pilot->lastname;?></span>
												</div>
												<div class="form-group">
													<label for="exampleFormControlSelect12">Select Airline</label>
													<select class="form-control" name="code" id="code">
														<?php
		foreach($airline_list as $airline) {
			$sel = ($_POST['code'] == $airline->code || $bid->code == $airline->code)?'selected':'';
			echo '<option value="'.$airline->code.'" '.$sel.'>'.$airline->code.' - '.$airline->name.'</option>';
		}
		?>
													</select>
												</div>
												<div class="form-group">
													<label for="exampleFormControlInput1">Enter Flight Number</label>
													<input type="password" class="form-control" name="flightnum" value="<?php if(isset($bid->flightnum)) { echo $bid->flightnum; }?><?php if(isset($_POST['flightnum'])) { echo $_POST['flightnum'];} ?>">
												</div>
												<div class="form-group">
													<label for="exampleFormControlSelect12">Select Departure Airport</label>
													<select class="form-control" id="depicao" name="depicao">
													<?php
			foreach($airport_list as $airport) {
				$sel = ($_POST['depicao'] == $airport->icao || $bid->depicao == $airport->icao)?'selected':'';
				echo '<option value="'.$airport->icao.'" '.$sel.'>'.$airport->icao . ' - '.$airport->name .'</option>';
			}
			?>
													</select>
												</div>
												<div class="form-group">
													<label for="exampleFormControlSelect12">Select Arrival Airport</label>
													<select class="form-control" id="arricao" name="arricao">
												<?php
			foreach($airport_list as $airport) {
				$sel = ($_POST['arricao'] == $airport->icao || $bid->arricao == $airport->icao)?'selected':'';
				echo '<option value="'.$airport->icao.'" '.$sel.'>'.$airport->icao . ' - '.$airport->name .'</option>';
			}
			?>
													</select>
												</div>
													<div class="form-group">
													<label for="exampleFormControlSelect12">Select Aircraft</label>
													<select class="form-control" name="aircraft" id="aircraft">
												<?php
		
		foreach($aircraft_list as $aircraft)
		{
			$sel = ($_POST['aircraft'] == $aircraft->id || $bid->registration == $aircraft->registration)?'selected':'';	
			echo '<option value="'.$aircraft->id.'" '.$sel.'>'.$aircraft->name.' - '.$aircraft->registration.'</option>';
		}
		?>
													</select>
												</div>
												
												<?php
	// List all of the custom PIREP fields
	if(!$pirepfields) $pirepfields = array();
	foreach($pirepfields as $field)
	{
	?>
		<dt><?php echo $field->title ?></dt>
		<dd>
		<?php
		
		// Determine field by the type
		
		if($field->type == '' || $field->type == 'text') {
		?>
			<input type="text" name="<?php echo $field->name ?>" value="<?php echo $_POST[$field->name] ?>" />
		<?php
		}  elseif($field->type == 'textarea') {
			echo '<textarea name="'.$field->name.'">'.$field->values.'</textarea>';
		} elseif($field->type == 'dropdown') {
			$values = explode(',', $field->options);
			
			echo '<select name="'.$field->name.'">';
			foreach($values as $value) {
				$value = trim($value);
				echo '<option value="'.$value.'">'.$value.'</option>';
			}
			echo '</select>';		
		}
		?>
		
		</dd>
	<?php
	}
	?>
	
												<div class="form-group">
													<label for="exampleFormControlInput1">Fuel Used</label>
													<input type="password" class="form-control" name="fuelused" value="<?php echo $_POST['fuelused']; ?>" />
													<span class="mt-2 d-block">This is the fuel used on this flight in <?php echo Config::Get('LIQUID_UNIT_NAMES', Config::Get('LiquidUnit'))?></span>
												</div>
												<div class="form-group">
													<label for="exampleFormControlInput1">Flight Time</label>
													<input type="password" class="form-control" name="flighttime" value="<?php echo $_POST['flighttime'] ?>" />
													<span class="mt-2 d-block">Enter as hours - "5.30" is five hours and thirty minutes</span>
												</div>
												<div class="form-group">
													<label for="exampleFormControlTextarea1">Route</label>
													<textarea class="form-control" id="exampleFormControlTextarea1" name="route" style="width: 100%"><?php echo (!isset($_POST['route'])) ? $bid->route : $_POST['route']; ?></textarea>
													<span class="mt-2 d-block">Enter the route flown, or default will be from the schedule</span>
												</div>
												<div class="form-group">
													<label for="exampleFormControlTextarea1">Comments</label>
													<textarea class="form-control" id="exampleFormControlTextarea1" name="comment" style="width: 100%"><?php echo $_POST['comment'] ?></textarea>
												</div>
												
												<div class="form-footer pt-4 pt-5 mt-4 border-top">
												<?php $bidid = ( isset($bid) )? $bid->bidid:$_POST['bid']; ?>
												<input type="hidden" name="bid" value="<?php echo $bidid ?>" />
												<input type="submit" name="submit_pirep" class="btn btn-primary btn-default" value="File Flight Report" />
												</div>
											</form>
										</div>
									</div>

</div>
