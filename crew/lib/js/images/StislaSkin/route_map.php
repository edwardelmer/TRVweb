<div id="routemap" style="width: 100%; height: 500px; position: relative; overflow: hidden;"></div>

<?php
/**
 * 
 * This is the new Google Maps v3 code. Be careful of changing
 * things here, only do something if you know what you're doing.
 * 	          
 * These are some options for the map, you can change here.
 * 
 * This map is used for schedules and PIREPS
 * 
 * By default, the zoom level and center are ignored, and the map 
 * will try to fit the all the flights in. If you want to manually set
 * the zoom level and center, set "autozoom" to false.
 * 
 * If you want to adjust the size of the map - Look at the above
 * "routemap" div with the CSS width/height parameters. You can 
 * easily adjust it from there.
 * 
 * And for reference, you want to tinker:
 * https://code.google.com/apis/maps/documentation/v3/basics.html
 */
 
if(isset($pirep))
	$mapdata = $pirep;
if(isset($schedule))
	$mapdata = $schedule;
if(isset($bid))
	$mapdata = $bid;
?>
<?php
/*	This is a small template for information about a navpoint popup 
	
	Variables available:
	
	<%=nav.title%>
	<%=nav.name%>
	<%=nav.freq%>
	<%=nav.lat%>
	<%=nav.lng%>
	<%=nav.type%>	2=NDB 3=VOR 4=DME 5=FIX 6=TRACK
 */
?>
<script type="text/html" id="navpoint_bubble">
	<span style="font-size: 10px; text-align:left; width: 100%" align="left">
	<strong>Name: </strong><%=nav.title%> (<%=nav.name%>)<br />
	<strong>Type: </strong>
	<?php	/* Show the type of point */ ?>
	<% if(nav.type == 2) { %> NDB <% } %>
	<% if(nav.type == 3) { %> VOR <% } %>
	<% if(nav.type == 4) { %> DME <% } %>
	<% if(nav.type == 5) { %> FIX <% } %>
	<% if(nav.type == 6) { %> TRACK <% } %>
	<br />
	<?php	/* Only show frequency if it's not a 0*/ ?>
	<% if(nav.freq != 0) { %>
	<strong>Frequency: </strong><%=nav.freq%>
	<% } %>
	</span>
</script>

<?php
/*	Below here is all the javascript for the map. Be careful of what you
	modify!! */
?>
<script src="<?php echo SITE_URL?>/lib/js/base_map.js"></script>
<script type="text/javascript">

// Write the PIREP data out into JSON
// The big reason being we don't need to have PHP writing JS - yuck
const flight = JSON.parse('<?php echo json_encode($mapdata); ?>');
console.log(flight);

const map = createMap({
	render_elem: 'routemap',
	provider: '<?php echo Config::Get("MAP_TYPE"); ?>',
});

const depCoords = L.latLng(flight.deplat, flight.deplng);
selDepMarker = L.marker(depCoords, {
	icon: MapFeatures.icons.departure,
}).bindPopup(flight.depname).addTo(map);

const arrCoords = L.latLng(flight.arrlat, flight.arrlng);
selArrMarker = L.marker(arrCoords, {
	icon: MapFeatures.icons.arrival,
}).bindPopup(flight.arrname).addTo(map);

let points = [];
points.push(depCoords);

// rendering for if there's smartcars data
if(flight.rawdata instanceof Object 
	&& flight.rawdata.points !== undefined
	&& Array.isArray(flight.rawdata.points)
) {
	$.each(flight.rawdata.points, function(i, nav) {
		if(nav.lat === undefined || nav.lng === undefined) {
			return;
		}

		points.push(L.latLng(nav.lat, nav.lng));
	});
} else {
	$.each(flight.route_details, function(i, nav) {
		const loc = L.latLng(nav.lat, nav.lng);
		const icon = (nav.type === 3) ? MapFeatures.icons.vor : MapFeatures.icons.fix;
		points.push(loc);

		const marker = L.marker(loc, {
				icon: icon,
				title: nav.title,
			})
			.bindPopup(tmpl("navpoint_bubble", { nav: nav }))
			.addTo(map);
	});
}

points.push(arrCoords);

const selPointsLayer = L.geodesic([points], {
	weight: 2,
	opacity: 1.0,
	color: '#49ABEF',
	steps: 10
}).addTo(map);

map.fitBounds(selPointsLayer.getBounds());
</script>