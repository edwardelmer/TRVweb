<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <title><?php echo SITE_NAME; ?> CrewCenter</title>
  <?php echo $page_htmlhead; ?>

  <!-- GOOGLE FONTS -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500|Poppins:400,500,600,700|Roboto:400,500" rel="stylesheet" />
  <link href="https://cdn.materialdesignicons.com/4.4.95/css/materialdesignicons.min.css" rel="stylesheet" />


  <!-- PLUGINS CSS STYLE -->
  <link href="<?php echo SITE_URL?>/lib/skins/clarity/assets/plugins/nprogress/nprogress.css" rel="stylesheet" />

  
  
  <!-- No Extra plugin used -->
  
  
  
  <link href="<?php echo SITE_URL?>/lib/skins/clarity/assets/plugins/jvectormap/jquery-jvectormap-2.0.3.css" rel="stylesheet" />
  
  
  
  <link href="<?php echo SITE_URL?>/lib/skins/clarity/assets/plugins/daterangepicker/daterangepicker.css" rel="stylesheet" />
  
  
  
  <link href="<?php echo SITE_URL?>/lib/skins/clarity/assets/plugins/toastr/toastr.min.css" rel="stylesheet" />
  
  

  <!-- SLEEK CSS -->
  <link id="sleek-css" rel="stylesheet" href="<?php echo SITE_URL?>/lib/skins/clarity/assets/css/clarity.css" />

  <!-- FAVICON -->
  <link href="<?php echo SITE_URL?>/lib/skins/clarity/assets/img/favicon.png" rel="shortcut icon" />

  

  <!--
    HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries
  -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <script src="<?php echo SITE_URL?>/lib/skins/clarity/assets/plugins/nprogress/nprogress.js"></script>
</head>


<body class="header-fixed sidebar-fixed sidebar-dark header-light" id="body">
  
         <?php echo $page_htmlreq; ?>
		<?php
		// var_dump($_SERVER['REQUEST_URI']);
		# Hide the header if the page is not the registration or login page
		# Bit hacky, don't like doing it this way
		if (!isset($_SERVER['REQUEST_URI']) || ltrim($_SERVER['REQUEST_URI'],'/') !== SITE_URL.'/index.php/login' || ltrim($_SERVER['REQUEST_URI'],'/') !== SITE_URL.'/index.php/registration') {
			if(Auth::LoggedIn()) {
				Template::Show('app_top.php');
			}
		}
		?>
        
        <div id="content">
            <?php echo $page_content; ?>
        </div>
        
		<?php
		# Hide the footer if the page is not the registration or login page
		# Bit hacky, don't like doing it this way
		if (!isset($_SERVER['REQUEST_URI']) || ltrim($_SERVER['REQUEST_URI'],'/') !== SITE_URL.'/index.php/login' || ltrim($_SERVER['REQUEST_URI'],'/') !== SITE_URL.'/index.php/registration') {
			if(Auth::LoggedIn()) {
				Template::Show('app_bottom.php');
			}
		}
		?>

<script src="<?php echo SITE_URL?>/lib/skins/clarity/assets/plugins/slimscrollbar/jquery.slimscroll.min.js"></script>
<script src="<?php echo SITE_URL?>/lib/skins/clarity/assets/plugins/jekyll-search.min.js"></script>



<script src="<?php echo SITE_URL?>/lib/skins/clarity/assets/plugins/charts/Chart.min.js"></script>
  


<script src="<?php echo SITE_URL?>/lib/skins/clarity/assets/plugins/jvectormap/jquery-jvectormap-2.0.3.min.js"></script>
<script src="<?php echo SITE_URL?>/lib/skins/clarity/assets/plugins/jvectormap/jquery-jvectormap-world-mill.js"></script>
  


<script src="<?php echo SITE_URL?>/lib/skins/clarity/assets/plugins/daterangepicker/moment.min.js"></script>
<script src="<?php echo SITE_URL?>/lib/skins/clarity/assets/plugins/daterangepicker/daterangepicker.js"></script>
<script>
  jQuery(document).ready(function() {
    jQuery('input[name="dateRange"]').daterangepicker({
    autoUpdateInput: false,
    singleDatePicker: true,
    locale: {
      cancelLabel: 'Clear'
    }
  });
    jQuery('input[name="dateRange"]').on('apply.daterangepicker', function (ev, picker) {
      jQuery(this).val(picker.startDate.format('MM/DD/YYYY'));
    });
    jQuery('input[name="dateRange"]').on('cancel.daterangepicker', function (ev, picker) {
      jQuery(this).val('');
    });
  });
</script>
  


<script src="<?php echo SITE_URL?>/lib/skins/clarity/assets/plugins/toastr/toastr.min.js"></script>



<script src="<?php echo SITE_URL?>/lib/skins/clarity/assets/js/sleek.bundle.js"></script>
</body>

</html>
