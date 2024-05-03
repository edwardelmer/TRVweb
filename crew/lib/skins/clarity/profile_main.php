	<?php if(!defined('IN_PHPVMS') && IN_PHPVMS !== true) { die(); } ?>
	<div class="content">
	


<div class="alert alert-dark alert-highlighted" role="alert">
												<h5> <i class="mdi mdi-apple-icloud"></i> Current Location METAR</h5>

                <?php $last_location = PIREPData::getLastReports(Auth::$userinfo->pilotid, 1, PIREP_ACCEPTED);

	if(!$last_location) {

		echo '';

	} else { ?>

		<p style="font-size:12px">Your current airport METAR: <i><?php echo file_get_contents("https://wx.ivao.aero/metar.php?id=$last_location->arricao"); ?> - <a href="https://easyworldairlines.com/phpvms/index.php/instantweather">Decode Metar</a></i></p>

	<?php

	} ?>
											</div>			  
	<div class="row">
								<div class="col-md-6 col-lg-6 col-xl-3">
									<div class="card widget-block p-4 rounded bg-primary border">
										<div class="card-block">
											<i class="mdi mdi-account-outline mr-4 text-white"></i>
											<h4 class="text-white my-2"><?php echo StatsData::PilotCount(); ?></h4>
											<p>Total Pilots</p>
										</div>
									</div>
								</div>
								<div class="col-md-6 col-lg-6 col-xl-3">
									<div class="card widget-block p-4 rounded bg-warning border">
										<div class="card-block">
											<i class="mdi mdi-account-group mr-4 text-white"></i>
											<h4 class="text-white my-2"><?php echo StatsData::TotalPaxCarried (); ?></h4>
											<p>Passengers Carried</p>
										</div>
									</div>
								</div>
								<div class="col-md-6 col-lg-6 col-xl-3">
									<div class="card widget-block p-4 rounded bg-danger border">
										<div class="card-block">
											<i class="mdi mdi-airport  mr-4 text-white"></i>
											<h4 class="text-white my-2"><?php echo StatsData::TotalMilesFlown(); ?> nm</h4>
											<p>Distance Flown</p>
										</div>
									</div>
								</div>
								<div class="col-md-6 col-lg-6 col-xl-3">
									<div class="card widget-block p-4 rounded bg-success border">
										<div class="card-block">
											<i class="mdi mdi-airplane t mr-4 text-white"></i>
											<h4 class="text-white my-2"><?php echo StatsData::TotalAircraftInFleet () ; ?></h4>
											<p>Aircraft in fleet</p>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
							<div class="col-xl-8">
								<div class="card card-default" id="activity-user">
								<div class="card-header">
											<h2>Latest News</h2>
										</div>
									<div class="card-body pt-0 pb-5">
														
														<div class="media-body">
														
															<?php MainController::Run('News', 'ShowNewsFront', 2); ?>
														</div>
													</div>
								</div>
							</div>
							<div class="col-xl-4">
								<div class="card card-default" id="activity-user">
									<div class="card-header">
											<h2>Your stats</h2>
										</div>
										<div class="card-body text-center">
											<img class="rounded-circle d-flex mx-auto" src="<?php echo SITE_URL?>/lib/skins/clarity/assets/img/user/u6.png" alt="user image">
											<h4 class="py-2 text-dark"><?php echo Auth::$userinfo->firstname.' '.Auth::$userinfo->lastname; ?></h4>
											<p><?php echo $pilotcode; ?></p>
											<a class="btn btn-primary btn-pill btn-lg my-4" href="#"><?php echo $userinfo->rank;?></a>
										</div>
										<div class="d-flex justify-content-between px-5 pb-4">
											<div class="text-center pb-4">
												<h6 class="text-dark pb-2"><?php echo $userinfo->totalhours; ?></h6>
												<p>Total hours</p>
											</div>
											<div class="text-center pb-4">
												<h6 class="text-dark pb-2"><?php echo $userinfo->totalflights?></h6>
												<p>Total flights</p>
											</div>
											<div class="text-center pb-4">
												<h6 class="text-dark pb-2"><?php echo FinanceData::FormatMoney($userinfo->totalpay) ?></h6>
												<p>Bank Balance</p>
											</div>
								</div>
							</div>
						</div>
						
						<div class="col-lg-6">
									<div class="card card-default">
										<div class="card-header card-header-border-bottom">
											<h2>Current Flights</h2>
										</div>
										<div class="card-body slim-scroll">
											<div class="list-group">
											 <?php

$results = ACARSData::GetACARSData();

if(is_array ($results) || $results instanceof Countable) {

if (count($results) > 0)



foreach($results as $flight)

 {



	 ?>
												<a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
													<div class="d-flex w-100 justify-content-between">
														<h5 class="mb-1"><img src="<?php echo SITE_URL?>/lib/skins/clarity/assets/img/paypal.png" width="70" height="25"></h5>
														<small><?php echo $flight->depicao;?> - <?php echo $flight->arricao;?></small>
													</div>
													<p class="mb-1"><?php echo $flight->flightnum;?></p>
													<small><?php if($flight->phasedetail

!= 'Paused') { echo $flight->phasedetail; }

else { echo "Cruise"; }?></small>

 <?php		
		 }
	 } else { ?> 
<div class="alert alert-info" role="alert">
												<strong>Oh snap!</strong> No Pilots Currently Flying.
											</div>
	 <?php
	 }
	 ?>
												</a>
											</div>
										</div>
									</div>
								</div>
								
							<div class="col-lg-6">
									<div class="card card-default" data-scroll-height="500">
										<div class="card-header justify-content-between align-items-center card-header-border-bottom">
											<h2>Latest Pilots</h2>

										</div>
										<div class="card-body slim-scroll">
										
										<?php MainController::Run('Pilots', 'RecentFrontPage', 5); ?>

										</div>
										<div class="mt-3"></div>
									</div>
								</div>
							</div>