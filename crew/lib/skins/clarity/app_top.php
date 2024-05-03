<?php if(!defined('IN_PHPVMS') && IN_PHPVMS !== true) { die(); } ?>
<?php
# Bit Hacky, but this will allow universal redirection to the login page if not logged in
if (!isset($_SERVER['REQUEST_URI']) || ltrim($_SERVER['REQUEST_URI'],'/') !== SITE_URL.'/index.php/login') {
	if(!Auth::LoggedIn()) {
		header('Location:'.SITE_URL.'/index.php/login');
	}
}
?>
 <div class="wrapper">
   

            <!--
          ====================================
          ——— LEFT SIDEBAR WITH FOOTER
          =====================================
        -->
        <aside class="left-sidebar bg-sidebar">
          <div id="sidebar" class="sidebar sidebar-with-footer">
            <!-- Aplication Brand -->
            <div class="app-brand">
              <a href="<?php echo SITE_URL?>" title="Crew Center">
               <img src="<?php echo SITE_URL?>/lib/skins/clarity/assets/img/icon.png">
                <span class="brand-name text-truncate">Operational Center</span>
              </a>
            </div>
            <!-- begin sidebar scrollbar -->
            <div class="sidebar-scrollbar">

              <!-- sidebar menu -->
              <ul class="nav sidebar-inner" id="sidebar-menu">
                

                
                  <li  class="active" >
                    <a class="sidenav-item-link"  href="<?php echo SITE_URL?>" data-target="#dashboard"
                      aria-expanded="false" aria-controls="dashboard">
                      <i class="mdi mdi-desktop-mac-dashboard"></i>
                      <span class="nav-text">Dashboard</span>
                    </a>
                   
                  </li>
                

                

                
                  <li  class="has-sub" >
                    <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#app"
                      aria-expanded="false" aria-controls="app">
                      <i class="mdi mdi-pencil-box-multiple"></i>
                      <span class="nav-text">Dispatch</span> <b class="caret"></b>
                    </a>
                    <ul  class="collapse"  id="app"
                      data-parent="#sidebar-menu">
                      <div class="sub-menu">
                        
                        
                          
                            <li >
                              <a class="sidenav-item-link" href="<?php echo url('/pireps/filepirep'); ?>">
                                <span class="nav-text">File manual report</span>
                                
                              </a>
                            </li>
                          
                        

                        
                        
                          
                            <li >
                              <a class="sidenav-item-link" href="<?php echo url('/schedules/bids'); ?>">
                                <span class="nav-text">Booked flights</span>
                                
                              </a>
                            </li>
                          
                        

                        
                        
                          
                            <li >
                              <a class="sidenav-item-link" href="<?php echo url('/schedules'); ?>">
                                <span class="nav-text">Book a flight</span>
                                
                              </a>
                            </li>
                          
                        

                        
                        
                          
                            <li >
                              <a class="sidenav-item-link" href="<?php echo url('/pireps/mine'); ?>">
                                <span class="nav-text">Previous flights</span>
                                
                              </a>
                            </li>
                          
                        

                        
                      </div>
                    </ul>
                  </li>
                

                

                
                   <li >
                    <a class="sidenav-item-link"  href="<?php echo url('/acars'); ?>" data-target="#flighttrack"
                      aria-expanded="false" aria-controls="flighttrack">
                      <i class="mdi mdi-airplane-landing"></i>
                      <span class="nav-text">Flight Tracker</span>
                    </a>
                   
                  </li>
				   <li >
                    <a class="sidenav-item-link"  href="<?php echo url('/pilots'); ?>" data-target="#flighttrack"
                      aria-expanded="false" aria-controls="flighttrack">
                      <i class="mdi mdi-airport"></i>
                      <span class="nav-text">View Hubs</span>
                    </a>
                   
                  </li>
				  
				   <li >
                    <a class="sidenav-item-link"  href="<?php echo url('/Mail'); ?>" data-target="#flighttrack"
                      aria-expanded="false" aria-controls="flighttrack">
                      <i class="mdi mdi-email"></i>
                      <span class="nav-text">Mail</span>
                    </a>
                   
                  </li>

                 <li >
                    <a class="sidenav-item-link"  href="<?php echo url('/downloads'); ?>" data-target="#downloads"
                      aria-expanded="false" aria-controls="downloads">
                      <i class="mdi mdi-cloud-download"></i>
                      <span class="nav-text">Downloads</span>
                    </a>
                   
                  </li>
				  
			<li >
                    <a class="sidenav-item-link"  href="YOUR SITE URL HERE" data-target="#backtosite"
                      aria-expanded="false" aria-controls="downloads">
                      <i class="mdi mdi-backburger"></i>
                      <span class="nav-text">Back to main site</span>
                    </a>
                   
                  </li>

<?php if(PilotGroups::group_has_perm(Auth::$usergroups, ACCESS_ADMIN)) { echo '
                    <li>
					<a class="sidenav-item-link"  href=" '.SITE_URL.'/admin" data-target="#admin"
                      aria-expanded="false" aria-controls="admin">
                      <i class="mdi mdi-cogs"></i>
                      <span class="nav-text">Administration Center</span>
                    </a>
                      
                    </li>
                    '; } ?>
                
              </ul>

            </div>

            <div class="sidebar-footer">
              <hr class="separator mb-0" />
              <div class="sidebar-footer-content">
                <h6 class="text-uppercase">
                  Flights Today <span class="float-right"><?php echo StatsData::TotalFlightsToday(); ?></span>
                </h6>
                <div class="progress progress-xs">
                  <div
                    class="progress-bar active"
                    style="width: 40%;"
                    role="progressbar"
                  ></div>
                </div>
                <h6 class="text-uppercase">
                  Total Flights <span class="float-right"><?php echo StatsData::TotalFlights(); ?></span>
                </h6>
                <div class="progress progress-xs">
                  <div
                    class="progress-bar progress-bar-warning"
                    style="width: 65%;"
                    role="progressbar"
                  ></div>
                </div>
              </div>
            </div>
          </div>
        </aside>


    <div class="page-wrapper">
                <!-- Header -->
          <header class="main-header " id="header">
            <nav class="navbar navbar-static-top navbar-expand-lg">
              <!-- Sidebar toggle button -->
              <button id="sidebar-toggler" class="sidebar-toggle">
                <span class="sr-only">Toggle navigation</span>
              </button>
              <!-- search form -->
              <div class="search-form d-none d-lg-inline-block">
               
              </div>
			  

              <div class="navbar-right ">
                <ul class="nav navbar-nav">
		
                 
                  <!-- User Account -->
                  <li class="dropdown user-menu">
                    <button href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                      <img src="<?php echo SITE_URL?>/lib/skins/clarity/assets/img/user/user.png" class="user-image" alt="User Image" />
                      <span class="d-none d-lg-inline-block"><?php echo Auth::$userinfo->firstname.' '.Auth::$userinfo->lastname; ?></span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-right">
                      <!-- User image -->
                      <li class="dropdown-header">
                        <img src="<?php echo SITE_URL?>/lib/skins/clarity/assets/img/user/user.png" class="img-circle" alt="User Image" />
                        <div class="d-inline-block">
                          <?php echo Auth::$userinfo->firstname.' '.Auth::$userinfo->lastname; ?> <small class="pt-1"><?php echo $pilotcode; ?></small>
                        </div>
                      </li>

                      <li>
                        <a href="<?php echo url('/profile/editprofile'); ?>">
                          <i class="mdi mdi-account"></i> Edit Profile
                        </a>
                      </li>
                      <li>
                     

                      <li class="dropdown-footer">
                        <a href="<?php echo url('/logout'); ?>"> <i class="mdi mdi-logout"></i> Log Out </a>
                      </li>
                    </ul>
                  </li>
				  
				  <li class="dropdown notifications-menu">
                    <button class="dropdown-toggle" data-toggle="dropdown">
                      <i class="mdi mdi-bell-outline"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-right">
                     <?php
    // Show the activity feed
    MainController::Run('Activity', 'Frontpage', 10);
?>

                    </ul>
                  </li>
				 
				
                  <li class="dropdown notifications-menu">
                    <button class="dropdown-toggle" data-toggle="dropdown">
                      <i class="mdi mdi-account-supervisor"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-right">
                      <li class="dropdown-header">Users Online</li>
					    <li>
					  <?php
                              $usersonline = StatsData::UsersOnline();
                              $guestsonline = StatsData::GuestsOnline();
                            ?>
                                <h5><?php
                                    $shown = array();
                                    foreach($usersonline as $pilot)
                                    {
                                    if(in_array($pilot->pilotid, $shown))
                                    continue;
                                    else
                                    $shown[] = $pilot->pilotid;
                                    echo " <a>";
                                    echo '<img src="'.SITE_URL.'/lib/skins/clarity/assets/img/online.png" alt="avatar" style="width: 10px;" /> &nbsp; ';
                                    echo $pilot->firstname.' '.$pilot->lastname.'';
                                    echo "</a>";
                                    }
                                    ?>
									</li>
                     
                      <li class="dropdown-footer">
                        <a class="text-center"><?php echo count($guestsonline);?> Guests Online.</a>
                      </li>
                    </ul>
                  </li>
				  
				  <li class="dropdown notifications-menu">
                    <button class="dropdown-toggle" data-toggle="dropdown"> 
                      <?php MainController::Run('Mail', 'checkmail'); ?>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-right">
					<li class="dropdown-header">New Messages</li>
					
					<?php MainController::Run('Mail', 'GetNotificationMail', 5);?>
					
					
                    </ul>
                  </li>
				 
				  
                </ul>
              </div>
            </nav>


          </header>
		   <div class="content-wrapper">