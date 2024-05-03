<?php if(!defined('IN_PHPVMS') && IN_PHPVMS !== true) { die(); } ?>
<section class="content">

					<div class="row">
								<div class="col-12">
                  <!-- Recent Order Table -->
                  <div class="card card-table-border-none" id="recent-orders">
                    <div class="card-header justify-content-between">
                      <h2>My Flight Bids</h2>

                    </div>
					
                    <div class="card-body pt-0 pb-5">
					<?php
if(!$bids)
{
	echo '<p align="center">You have not bid on any flights</p>';
	return;
}
?>
                      <table class="table card-table table-responsive table-responsive-large" style="width:100%">
                        <thead>
                          <tr>
                            <th>Flight Number</th>
							<th>Route</th>
							<th>Aircraft</th>
							<th>Departure Time</th>
							<th>Arrival Time</th>
							<th>Distance</th>
							<th>Options</th>
                          </tr>
                        </thead>
                        <tbody>
						<?php
foreach($bids as $bid)
{
?>
                         <tr id="bid<?php echo $bid->bidid ?>">
                            <td class="d-none d-lg-table-cell"><?php echo $bid->code . $bid->flightnum; ?></td>
	<td><?php echo $bid->depicao; ?> to <?php echo $bid->arricao; ?></td>
	<td><?php echo $bid->aircraft; ?> (<?php echo $bid->registration?>)</td>
	<td><?php echo $bid->deptime;?></td>
	<td><?php echo $bid->arrtime;?></td>
	<td><?php echo $bid->distance;?></td>

		
	</td>
                            <td class="text-right">
                              <div class="dropdown show d-inline-block widget-dropdown">
                                <a class="dropdown-toggle icon-burger-mini" href="" role="button" id="dropdown-recent-order1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"></a>
                                <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-recent-order1">
                                  <li class="dropdown-item">
                                    <a href="<?php echo url('/pireps/filepirep/'.$bid->bidid);?>">File PIREP</a>
                                  </li>
                                  <li class="dropdown-item">
                                    <a id="<?php echo $bid->bidid; ?>" class="deleteitem" href="<?php echo url('/schedules/removebid');?>">Remove Bid *</a>
                                  </li>
								  <li class="dropdown-item">
                                    <a href="<?php echo url('/schedules/brief/'.$bid->id);?>">Pilot Brief</a>
                                  </li>
								  <li class="dropdown-item">
                                   <a href="<?php echo url('/schedules/boardingpass/'.$bid->id);?>" />Boarding Pass</a>
                                  </li>
                                </ul>
                              </div>
                            </td>
                          </tr>
                         <?php
}
?>
                        </tbody>
                      </table>

                    </div>
                  </div>
				  </div>
				  </div>
				  </section>

