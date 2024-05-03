<style>
#airportInfo{
  	background-color: #15315E;
  	color: #fff !important;
  	text-transform: uppercase;
  	text-align: center;
	border-bottom: 5px solid rgba(0, 0, 0, 0.05);
}
#airportInfo h5{
	font-size:15px;
	background:rgba(255, 255, 255, 0.05);
	padding:20px 5px;
	margin:2px;
}
#airportInfo table{
	margin:0px;
	padding:5px;
}

#mapfooter{
	background-color: #15315E;
	color: #fff !important;
	text-transform:uppercase;
	padding:10px;
}
#mapfooter a{
	color:#FFF;
	border-top:1px solid rgba(255, 255, 255, 0.3);
}
</style>

<script type="text/javascript">
var myMarkers = new Array();

$.getJSON( "<?php echo actionurl("Destinations/getAirports"); ?>", function( data ) {

  var items = [];
  $.each( data, function( key, val ) {
   
    	var icontype = "default";
    if(val.hub == 1){
    	var icontype = "hub";
    	 $("#info_icao").html(val.icao);
	 $("#info_name").html(val.name);
	 $("#info_country").html(val.country);
    }
    addMarker(val.lat, val.lng,icontype, val);
  });

});


function addMarker(lat, lng, icontype, info){
	
	if(icontype == "default"){
		var image = "<?php echo fileurl('lib/images/mapassets/airport_icon.png'); ?>";
	}else if(icontype == "hub"){
		var image = "<?php echo fileurl('lib/images/mapassets/hub_icon.png'); ?>";
	}
	
	var marker = new google.maps.Marker({
	      position: CreateLatLngObject(lat, lng),
	      map: map,
	      icon: image
	  });
	google.maps.event.addListener(marker, 'mouseover', function() {
	    $("#info_icao").html(info.icao);
	    $("#info_name").html(info.name);
	    $("#info_country").html(info.country);
	});
  
	myMarkers.push(marker);
}

function CreateLatLngObject(Latitude, Longitude) {
        var latlng = new google.maps.LatLng(parseFloat(Latitude), parseFloat(Longitude));
        return latlng;
}

var _styles = [{"featureType":"all","elementType":"labels","stylers":[{"visibility":"on"}]},{"featureType":"administrative","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"landscape","elementType":"all","stylers":[{"color":"#2c5ca5"}]},{"featureType":"poi","elementType":"all","stylers":[{"color":"#2c5ca5"}]},{"featureType":"road","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"all","stylers":[{"color":"#193a70"},{"visibility":"on"}]}]

var acars_map_defaults = {
	    mapTypeControl: false,
	    mapTypeControlOptions: {
	        style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
	        position: google.maps.ControlPosition.BOTTOM_CENTER
	    },
	    zoomControl: true,
	    zoomControlOptions: {
	        style: google.maps.ZoomControlStyle.SMALL,
	        position: google.maps.ControlPosition.TOP_RIGHT
	    },
	    scaleControl: false,
	    streetViewControl: false,
    
	autozoom: true,
	zoom: 2,
	center: new google.maps.LatLng("<?php echo Config::Get('MAP_CENTER_LAT'); ?>", "<?php echo Config::Get('MAP_CENTER_LNG'); ?>"),
	mapTypeId: google.maps.MapTypeId.ROADMAP,
	refreshTime: 10000,
	styles:_styles
};

</script>
<h3>Destinations</h3>
<div class="mapcenter" align="center">
	<div id="airportInfo">
		<table width="100%" style="text-align:center;">
			<tr>
				<td width="10%">
					
					<h5 id="info_icao"></h5>
				</td>
				<td width"60%">
					
					<h5 id="info_name"></h5>
				</td>
				<td width="30%">
				
					<h5 id="info_country"></h5>
				</td>
				
			</tr>
		</table>
	</div>
	<div id="acarsmap" style="width:100%; height: 400px"></div>
	<div id="mapfooter">
	   	<img src="<?php echo fileurl('lib/images/mapassets/hub_icon.png'); ?>" /> - HUB <img src="<?php echo fileurl('lib/images/mapassets/airport_icon.png'); ?>" /> - DESTINATION <br />
	   	<a href="//zumeweb.com">Developed By Zumeweb</a>
	</div>
	
</div>

<script type="text/javascript" src="<?php echo fileurl('/lib/js/base_map.js');?>"></script>