<?php if(!defined('IN_PHPVMS') && IN_PHPVMS !== true) { die(); } ?>
<div class="content-wrapper">
        <div class="content">
                      <div class="card card-default">
										<div class="card-header card-header-border-bottom">
											<h2>Schedule Search</h2>
										</div>
										<div class="card-body">
										 <form id="form" action="<?php echo url('/schedules/view');?>" method="post">
											<ul class="nav nav-tabs" id="myTab" role="tablist">
												<li class="nav-item">
													<a class="nav-link active" id="icon-home-tab" data-toggle="tab" href="#icon-home" role="tab" aria-controls="icon-home" aria-selected="true">
														<i class="mdi mdi-airplane-takeoff mr-1"></i> Departure</a>
												</li>
												<li class="nav-item">
													<a class="nav-link" id="icon-profile-tab" data-toggle="tab" href="#icon-profile" role="tab" aria-controls="icon-profile"
													 aria-selected="false">
														<i class="mdi mdi-airplane-landing mr-1"></i> Arrival</a>
												</li>
												<li class="nav-item">
													<a class="nav-link" id="icon-contact-tab" data-toggle="tab" href="#icon-contact" role="tab" aria-controls="icon-contact"
													 aria-selected="false">
														<i class="mdi mdi-airplane mr-1"></i> Aircraft</a>
												</li>
												<li class="nav-item">
													<a class="nav-link" id="icon-contact-tab" data-toggle="tab" href="#icon-distance" role="tab" aria-controls="icon-contact"
													 aria-selected="false">
														<i class="mdi mdi-airport mr-1"></i> Distance</a>
												</li>
											</ul>
											<div class="tab-content" id="myTabContent2">
												<div class="tab-pane pt-3 fade show active" id="icon-home" role="tabpanel" aria-labelledby="icon-home-tab">
											 <p>Select your departure airport:</p>
                            <div class="form-group">
                                <select id="depicao" name="depicao" class="form-control">
                                <option value="">Select All</option>
                                <?php
								if(!$depairports) $depairports = array();
								foreach($depairports as $airport)
								{
									echo '<option value="'.$airport->icao.'">'.$airport->icao
											.' ('.$airport->name.')</option>';
								}
                                ?>

                                </select>
                            </div>
                            <input type="submit" name="submit" value="Search" class="btn btn-flat btn-primary" />
												</div>
												<div class="tab-pane pt-3 fade" id="icon-profile" role="tabpanel" aria-labelledby="icon-profile-tab">
													 <p>Select your arrival airport:</p>
                            <div class="form-group">
                                <select id="arricao" name="arricao" class="form-control">
                                <option value="">Select All</option>
                                <?php
								if(!$depairports) $depairports = array();
								foreach($depairports as $airport)
								{
									echo '<option value="'.$airport->icao.'">'.$airport->icao
											.' ('.$airport->name.')</option>';
								}
                                ?>

                                </select>
                            </div>
                            <input type="submit" name="submit" value="Search" class="btn btn-flat btn-primary" />
												</div>
												<div class="tab-pane pt-3 fade" id="icon-contact" role="tabpanel" aria-labelledby="icon-contact-tab">
													 <p>Select aircraft:</p>
                            <div class="form-group">
                                <select id="equipment" name="equipment" class="form-control">
                                <option value="">Select equipment</option>
                                <?php
								if(!$equipment) $equipment = array();
								foreach($equipment as $equip)
								{
									echo '<option value="'.$equip->name.'">'.$equip->name.'</option>';
								}
                                ?>
                                </select>
                            </div>
                            <input type="submit" name="submit" value="Search" class="btn btn-flat btn-primary" />
												</div>
												<div class="tab-pane pt-3 fade" id="icon-distance" role="tabpanel" aria-labelledby="icon-distance-tab">
													<p>Select Distance:</p>
                            <div class="form-group">
                                <select id="type" name="type" class="form-control">
                                    <option value="greater">Greater Than</option>
                                    <option value="less">Less Than</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="text" name="distance" value="" class="form-control" />
                            </div>
                            <input type="submit" name="submit" value="Search" class="btn btn-flat btn-primary" />
												</div>
											</div>
											<input type="hidden" name="action" value="findflight" />
									</div>
								</div>
								</div>
								</div>
