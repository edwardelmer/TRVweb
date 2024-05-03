<?php if(!defined('IN_PHPVMS') && IN_PHPVMS !== true) { die(); } ?>
<script type="text/javascript">
var baseurl="<?php echo SITE_URL;?>";
var airport_lookup = "<?php echo Config::Get('AIRPORT_LOOKUP_SERVER'); ?>";
var phpvms_api_server = "<?php echo Config::Get('PHPVMS_API_SERVER'); ?>";
</script>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php echo fileurl('lib/js/jqModal.js'); ?>"></script>
<script type="text/javascript" src="<?php echo fileurl('lib/js/jquery.form.js'); ?>"></script>
<script type="text/javascript" src="<?php echo fileurl('lib/js/jquery.bigiframe.js'); ?>"></script>
<script type="text/javascript" src="<?php echo fileurl('lib/js/jquery.metadata.js'); ?>"></script>
<script type="text/javascript" src="<?php echo fileurl('lib/js/ckeditor/ckeditor.js'); ?>"></script>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
<script type="text/javascript" src="<?php echo SITE_URL?>/admin/lib/phpvmsadmin.js"></script

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>


<!-- Leaflet -->
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
   integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
   crossorigin=""/>
        
        <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
   integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
   crossorigin=""></script>
        
        <script src="<?php echo SITE_URL?>/lib/js/leaflet/leaflet-providers.js"></script>
        <script src="<?php echo SITE_URL?>/lib/js/leaflet/Leaflet.Geodesic.js"></script>

<link rel="alternate" type="application/rss+xml" title="RSS" href="<?php echo SITE_URL?>/lib/rss/latestpireps.rss">
<?php 
if(isset($MODULE_HEAD_INC))
	echo $MODULE_HEAD_INC;
?>