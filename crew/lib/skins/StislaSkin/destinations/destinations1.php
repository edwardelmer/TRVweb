<style>
    /* Style the tab */
.tab {
  overflow: hidden;
  border: 1px solid #ccc;
  background-color: #f1f1f1;
}

/* Style the buttons that are used to open the tab content */
.tab button {
  background-color: inherit;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  transition: 0.3s;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
  background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
  display: none;
  padding: 6px 12px;
  border: 1px solid #ccc;
  border-top: none;
}
</style>
<script type="text/javascript">
    function openAirline(evt, airlineName) {
  // Declare all variables
  var i, tabcontent, tablinks;

  // Get all elements with class="tabcontent" and hide them
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }

  // Get all elements with class="tablinks" and remove the class "active"
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }

  // Show the current tab, and add an "active" class to the button that opened the tab
  document.getElementById(airlineName).style.display = "block";
  evt.currentTarget.className += " active";
}
</script>

<div class="section-header">
	<h1>Hub</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?php echo SITE_URL; ?>">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="javascript::">Pilot Administration</a></div>
        <div class="breadcrumb-item">Hubs</div>
    </div>
</div>
    <div class="tab">
        <?php
        $airline = 'IDX';
        $bases = DestinationsData::getairlinebase($airline);
        foreach ($bases as $base) 
            { ?> 
            <button class="tablinks" onclick="openAirline(event, '<?php echo "$base->hubicao"; ?>')"><?php echo "$base->hubicao"; ?></button>
            <?php 
            }
        ?>
    </div>
    
    
    
    
    

<script src="<?php echo SITE_URL?>/lib/js/base_map.js"></script>
<script type="text/javascript">
	const map = createMap ({
		render_elem: 'hubmap',
		provider: '<?php echo Config::Get("MAP_TYPE"); ?>',
		zoom: 14,
		center: L.latLng("<?php echo $name->lat; ?>", "<?php echo $name->lng; ?>")
	});

	L.marker(["<?php echo $name->lat; ?>", "<?php echo $name->lng; ?>"]).addTo(map)
</script>