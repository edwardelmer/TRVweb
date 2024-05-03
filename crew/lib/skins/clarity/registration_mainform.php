  <?php if(!defined('IN_PHPVMS') && IN_PHPVMS !== true) { die(); } ?>
    <body class="" id="body">
  <div class="container d-flex flex-column justify-content-between vh-100">
      <div class="row justify-content-center mt-5">
        <div class="col-xl-5 col-lg-6 col-md-10">
          <div class="card">
            <div class="card-header bg-primary">
              <div class="app-brand">
                <a href="/index.html">
                 <img src="<?php echo SITE_URL?>/lib/skins/clarity/assets/img/icon.png">
                  <span class="brand-name">Crew Center</span>
                </a>
              </div>
            </div>
  <div class="card-body p-5">
                  <h4 class="text-dark mb-5">Sign Up</h4>
                  <form method="post" action="<?php echo url('/registration');?>">
                    <div class="row">
                      <div class="form-group col-md-12 mb-4">
                        <input type="text" class="form-control input-lg" name="firstname" placeholder="First Name" value="<?php echo Vars::POST('firstname');?>" >
						<?php
			if($firstname_error == true)
				echo '<p class="error">Please enter your first name</p>';
		?>
                      </div>
					  <div class="form-group col-md-12 mb-4">
                        <input type="text" class="form-control input-lg" name="lastname" placeholder="Last Name" value="<?php echo Vars::POST('lastname');?>" >
						<?php
			if($lastname_error == true)
				echo '<p class="error">Please enter your last name</p>';
		?>
                      </div>
                      <div class="form-group col-md-12 mb-4">
                        <input type="email" class="form-control input-lg" name="email" value="<?php echo Vars::POST('email');?>"  placeholder="Email" >
						<?php
			if($email_error == true)
				echo '<p class="error">Please enter your email address</p>';
		?>
                      </div>
					   <div class="form-group col-md-12 ">
                        <input type="password" class="form-control input-lg" id="password" name="password1" placeholder="Password">
                      </div>
                      <div class="form-group col-md-12 ">
                        <input type="password" class="form-control input-lg" name="password2" placeholder="Confirm Password">
						<?php
			if($password_error != '')
				echo '<p class="error">'.$password_error.'</p>';
		?>
                      </div>
					    <div class="form-group col-md-12 mb-4">
													<select class="form-control" name="location" placeholder="Location">
														<?php
			foreach($country_list as $countryCode=>$countryName) {
				if(Vars::POST('location') == $countryCode) {
				    $sel = 'selected="selected"';
				} else {
				    $sel = '';
				}

				echo '<option value="'.$countryCode.'" '.$sel.'>'.$countryName.'</option>';
			}
		?>
		</select>
		<?php
			if($location_error == true) {
                echo '<p class="error">Please enter your location</p>';
			}
		?>
												</div>
					  <div class="form-group col-md-12 mb-4">
													<select class="form-control" name="code" id="code" placeholder="Select Airline">
														<?php
		foreach($airline_list as $airline) {
			echo '<option value="'.$airline->code.'">'.$airline->code.' - '.$airline->name.'</option>';
		}
		?>
													</select>
												</div>
												<div class="form-group col-md-12 mb-4">
													<select class="form-control" name="hub" id="hub" placeholder="Select Hub">
														<?php
		foreach($hub_list as $hub) {
			echo '<option value="'.$hub->icao.'">'.$hub->icao.' - ' . $hub->name .'</option>';
		}
		?>
													</select>
												</div>
												
												<?php

	//Put this in a seperate template. Shows the Custom Fields for registration
	Template::Show('registration_customfields.php');

	?>
                     
                      <div class="col-md-12">
                        <div class="d-inline-block mr-3">

                           
                            <?php if(isset($captcha_error)){echo '<p class="error">'.$captcha_error.'</p>';} ?>
            <div class="g-recaptcha" data-sitekey="<?php echo $sitekey;?>"></div>
            <script type="text/javascript" src="https://www.google.com/recaptcha/api.js?hl=<?php echo $lang;?>">
            </script>


                        </div>
                        <button type="submit" name="submit" value="Register!" class="btn btn-lg btn-primary btn-block mb-4">Register</button>
                        <p>Already have an account?
                          <a class="text-blue" href="<?php echo SITE_URL?>/index.php/login">Sign in</a>
                        </p>
                      </div>
                    </div>
                  </form>

                </div>
              </div>
            </div>
          </div>
          <div class="copyright pl-0">
                <p class="text-center">Copyright &copy; <?php echo date('Y') ?> <?php echo SITE_NAME; ?> | Developed by <a href="https://creationweb.uk">Creation Web</a></p>
          </div>
        </div>
		
	</body>