<?php if(!defined('IN_PHPVMS') && IN_PHPVMS !== true) { die(); } ?>
<section class="content">
<?php
if(!$schedule_list)
{
	echo '<p align="center">No routes have been found!</p>';
	return;
}
?>
<div class="row">
								<div class="col-12">
                  <!-- Recent Order Table -->
                  <div class="card card-table-border-none" id="recent-orders">
                    <div class="card-header justify-content-between">
                      <h2>Search Results</h2>

                    </div>
  <div class="card-body pt-0 pb-5">
                      <table class="table card-table table-responsive table-responsive-large" style="width:100%">
                        <thead>
                          <tr>
                            <th>Flight Number</th>
                            <th>Dep/Arr</th>
                            <th class="d-none d-lg-table-cell">Aircraft</th>
                            <th class="d-none d-lg-table-cell">Week Rota</th>
                            <th>Options</th>
                          </tr>
                        </thead>
                        <tbody>
						<?php foreach($schedule_list as $schedule) { ?>
                          <tr>
                            <td ><?php echo $schedule->code . $schedule->flightnum?></td>
                            <td >
                              <a class="text-dark" href=""> <?php echo '('.$schedule->depicao.' - '.$schedule->arricao.')'?></a>
                            </td>
                            <td class="d-none d-lg-table-cell"><?php echo $schedule->aircraft; ?></td>
                            <td >
                              <span class="badge badge-success"><?php echo Util::GetDaysCompact($schedule->daysofweek); ?></span>
							  <?php echo ($schedule->route=='') ? '' : '<strong>Route: </strong>'.$schedule->route.'<br />' ?>

                            </td>
                            <td class="text-right">
                              <div class="dropdown show d-inline-block widget-dropdown">
                                <a class="dropdown-toggle icon-burger-mini" href="" role="button" id="dropdown-recent-order1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"></a>
                                <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-recent-order1">
                                  <li class="dropdown-item">
                                    <a href="<?php echo url('/schedules/details/'.$schedule->id);?>">View Details</a>
                                  </li>
                                  <li class="dropdown-item">
                                    <a href="<?php echo url('/schedules/brief/'.$schedule->id);?>">Pilot Brief</a>
                                  </li>
<?php 
		# Don't allow overlapping bids and a bid exists
		if(Config::Get('DISABLE_SCHED_ON_BID') == true && $schedule->bidid != 0) {
		?>
		<li class="dropdown-item">
			<a id="<?php echo $schedule->id; ?>" class="addbid" 
				href="<?php echo actionurl('/schedules/addbid/?id='.$schedule->id);?>">Add to Bid</a>
				</li>
		<?php
		} else {
			if(Auth::LoggedIn()) {
			 ?>
			 <li class="dropdown-item">
				<a id="<?php echo $schedule->id; ?>" class="addbid" 
					href="<?php echo url('/schedules/addbid');?>">Add to Bid</a>
					</li>
			<?php			 
			}
		}		
		?>
                                  </li>
                                </ul>
                              </div>
                            </td>
                          </tr>
<?php
 /* END OF ONE TABLE ROW */
}
?>
                        </tbody>
                      </table>
					  </div>
					  </div>
					  </div>
					  </div>
					  </section>

