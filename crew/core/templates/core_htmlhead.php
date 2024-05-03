<?php if(!defined('IN_PHPVMS') && IN_PHPVMS !== true) { die(); } ?>
<?php
/**
 * 	STOP! HAMMER TIME!
 *
 * ====> READ THIS !!!!!
 *
 * I really really, REALLY suggest you don't edit this file.
 * Why? This is the "main header" file where I put changes for updates.
 * And you don't want to have to manually go through and figure those out.
 *
 * That equals headache for you, and headache for me to figure out what went wrong.
 *
 * BUT BUT WAIT, you say... I want to include more javascript, css, etc...!
 * Well - in your skin's header.php file, this file is included as:
 *
 * Template::Show('core_htmlhead.php');
 *
 * Just add your stuff under that line there. That way, it's in the proper
 * spot, and this file stays intact for the system (and me) to be able to
 * make clean updates whenever needed. Less bugs = happy users (and happy me)
 *
 * THANKS!
 */
?>
<script type="text/javascript">
var baseurl = "<?php echo SITE_URL;?>";
</script>

<link rel="stylesheet" media="all" type="text/css" href="//crew.theredsvirtual.com/lib/css/phpvms.css" />
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo Config::Get('PAGE_ENCODING');?>" />

<!-- <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> -->
<script src="https://code.jquery.com/jquery-2.1.1.min.js" integrity="sha256-h0cGsrExGgcZtSZ/fRz4AwV+Nn6Urh/3v3jFRQ0w9dQ=" crossorigin="anonymous"></script>
<!-- <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script> -->
<script
  src="https://code.jquery.com/ui/1.11.2/jquery-ui.min.js"
  integrity="sha256-erF9fIMASEVmAWGdOmQi615Bmx0L/vWNixxTNDXS4FQ="
  crossorigin="anonymous"></script>
  <!-- <script src="http://malsup.github.com/jquery.form.js"></script> -->
<!--
 * Add Google Maps API key to next line. https://developers.google.com/maps/documentation/javascript/get-api-key 
 -->
<script type="text/javascript" src="//maps.googleapis.com/maps/api/js?key=YOUR_API_KEY_HERE"></script>

<script type="text/javascript" src="<?php echo fileurl('lib/js/jquery.form.js');?>"></script>
<script type="text/javascript" src="<?php echo fileurl('lib/js/phpvms.js');?>"></script>

<script async src="https://www.googletagmanager.com/gtag/js?id=G-5HTJ3RVFR3"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-5HTJ3RVFR3');
</script>
<script>
(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-TVZWT22');
</script>



<!-- Favicon -->
<link rel="icon" type="image/png" sizes="192x192"  href="/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
<link rel="manifest" href="/manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">

<?php
echo $MODULE_HEAD_INC;
