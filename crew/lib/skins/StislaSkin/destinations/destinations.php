<div class="section-header">
	<h1>Hub</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?php echo SITE_URL; ?>">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="javascript::">Pilot Administration</a></div>
        <div class="breadcrumb-item">Hubs</div>
    </div>
</div>


<div class="card">
    <?php
    $destinations = DestinationsData::getdestinations();
    foreach ($destinations as $destination) {
        echo "Airline : $destination->code";
    }
    ?>
</div>


