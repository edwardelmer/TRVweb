<?php if(!defined('IN_PHPVMS') && IN_PHPVMS !== true) { die(); } ?>
<section class="content">
<div class="row">
								<div class="col-12">
                  <!-- Recent Order Table -->
                  <div class="card card-table-border-none" id="recent-orders">
                    <div class="card-header justify-content-between">
                      <h2>PIREPs List</h2>
					  <p><?php if(isset($descrip)) { echo $descrip; }?></p>
<?php
if(!$pirep_list) {
	echo '<p>No reports have been found</p>';
	return;
}
?>
                    </div>
                    <div class="card-body pt-0 pb-5">
                      <table class="table card-table table-responsive table-responsive-large" style="width:100%">
                        <thead>
                          <tr>
                            <th>Flight Number</th>
							<th>Departure</th>
							<th>Arrival</th>
							<th>Aircraft</th>
							<th>Flight Time</th>
							<th>Submitted</th>
							<th>Status</th>
								<?php
	// Only show this column if they're logged in, and the pilot viewing is the
	//	owner/submitter of the PIREPs
	if(Auth::LoggedIn() && Auth::$pilot->pilotid == $pilot->pilotid) {
		echo '<th>Options</th>';
	}
	?>
                          </tr>
                        </thead>
                        <tbody>
						<?php
foreach($pirep_list as $pirep) {
?>
                          <tr>
                            	<td>
		<a href="<?php echo url('/pireps/view/'.$pirep->pirepid);?>"><?php echo $pirep->code . $pirep->flightnum; ?></a>
	</td>
	<td><?php echo $pirep->depicao; ?></td>
	<td><?php echo $pirep->arricao; ?></td>
	<td><?php echo $pirep->aircraft . " ($pirep->registration)"; ?></td>
	<td><?php echo $pirep->flighttime; ?></td>
	<td><?php echo date(DATE_FORMAT, $pirep->submitdate); ?></td>
	<td>
	<span class="badge badge-success">
		<?php
		
		if($pirep->accepted == PIREP_ACCEPTED) {
            echo '<span class="label label-success">Accepted</span>';
		} elseif($pirep->accepted == PIREP_REJECTED) {
            echo '<span class="label label-danger">Rejected</span>';
		} elseif($pirep->accepted == PIREP_PENDING) {
            echo '<span class="label label-primary">Approval Pending</span>';
		} elseif($pirep->accepted == PIREP_INPROGRESS) {
            echo '<span class="label label-primary">Flight in Progress</span>';
		}
			
		
		?>
								<?php
	// Only show this column if they're logged in, and the pilot viewing is the
	//	owner/submitter of the PIREPs
	if(Auth::LoggedIn() && Auth::$pilot->pilotid == $pirep->pilotid) {
		?>
		</span>
                            <td class="text-right">
                              <div class="dropdown show d-inline-block widget-dropdown">
                                <a class="dropdown-toggle icon-burger-mini" href="" role="button" id="dropdown-recent-order1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"></a>
                                <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-recent-order1">
                                  <li class="dropdown-item">
                                   <a href="<?php echo url('/pireps/addcomment?id='.$pirep->pirepid);?>">Add Comment</a>
                                  </li>
                                  <li class="dropdown-item">
                                  <a href="<?php echo url('/pireps/editpirep?id='.$pirep->pirepid);?>">Edit PIREP</a>
                                  </li>
								  	<?php
	}
	?>
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

