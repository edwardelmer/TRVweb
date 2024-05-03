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

              <h4 class="text-dark mb-5">Log in to Crew Center</h4>
              <form action="<?php echo url('/login');?>" method="post">
                <div class="row">
                  <div class="form-group col-md-12 mb-4">
                    <input type="text" name="email" class="form-control" placeholder="Email">
                  </div>
                  <div class="form-group col-md-12 ">
                    <input type="password" name="password" class="form-control" placeholder="Password">
                  </div>
                  <div class="col-md-12">
                    <div class="d-flex my-2 justify-content-between">
                      <div class="d-inline-block mr-3">
                        <label class="control control-checkbox">
                          <input type="checkbox" class="checkbox" style="display: inline-block;"> Remember me
                          <div class="control-indicator"></div>
                        </label>

                      </div>
                      <p><a href="<?php echo url('login/forgotpassword'); ?>">Forgot my password</a></p>
                    </div>
                   <input type="hidden" name="redir" value="index.php/profile" />
                        <input type="hidden" name="action" value="login" />
                        <input type="submit" class="btn btn-primary btn-block btn-flat" name="submit" value="Log In" />
                    <br/>
					<p>Don't have an account yet ?
                      <a href="<?php echo SITE_URL?>/index.php/registration" class="text-center">Sign Up</a>
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
          
        </p>
      </div>
    </div>
    </div>
	</body>