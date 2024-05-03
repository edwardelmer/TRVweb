<?php if(!$mail){
 echo '<div class="alert alert-success alert-highlighted" role="alert">Sorry, You have no mail :( </div>';
 }
 else {
	 foreach($mail as $data) {
 ?>
	 <?php $user = PilotData::GetPilotData($data->who_from);?>
	 <a href="<?php echo SITE_URL?>/index.php/Mail/item/<?php echo $data->thread_id;?>">
 <li class="dropdown-header">
                        <img src="<?php echo SITE_URL?>/lib/skins/clarity/assets/img/user/user.png" class="img-circle" alt="User Image" />
                        <div class="d-inline-block">
                        	<?php echo $user->firstname.' '.$user->lastname;?> <small class="pt-1" style="font-size:10px"> <small><i class="fa fa-clock-o"></i> <?php echo date(DATE_FORMAT.' H:i', strtotime($data->date)); ?></small>
							<?php echo $data->subject; ?>

                        </div>
                      </li>
					  </a>
					  
					  <?php
}

}
?>