<?php if(!defined('IN_PHPVMS') && IN_PHPVMS !== true) { die(); } ?>
<?php

foreach($pilots as $pilot)
{
?>
<!-- <p><a href="<?php echo url('/profile/view/'.$pilot->pilotid);?>"><?php echo PilotData::GetPilotCode($pilot->code, $pilot->pilotid). ' ' .$pilot->firstname . ' ' . $pilot->lastname?></a></p> -->
<div class="media py-3 align-items-center justify-content-between">
												<div class="d-flex rounded-circle align-items-center justify-content-center mr-3 media-icon iconbox-45 bg-primary text-white">
													<img class="img-circle img-bordered-sm" src="<?php echo SITE_URL?>/lib/skins/clarity/assets/img/paypal.png" alt="user image" width="80" height="25">
												</div>
												<div class="media-body pr-3 ">
													<a class="mt-0 mb-1 font-size-15 text-dark" href="#"><a href="<?php echo url('/profile/view/'.$pilot->pilotid);?>">
													<p><?php echo PilotData::GetPilotCode($pilot->code, $pilot->pilotid).' '.$pilot->firstname.' '.$pilot->lastname ?>
       </p> </a>
												</div>
												<span class=" font-size-12 d-inline-block"><i class="mdi mdi-clock-outline"></i> <?php echo $pilot->joindate; ?>
											</div>
<?php
}
?>