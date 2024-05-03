<?php if(!defined('IN_PHPVMS') && IN_PHPVMS !== true) { die(); } ?>
<?php

    #new script to trim the time format
    $newhours = Util::AddTime($pilot->totalhours, $pilot->transferhours);
    $hrs = intval($newhours);
    $min = round(($newhours - $hrs) * 100);
    
    if(!$pilot) {
        echo '
        <div class="section-header">
            <h1>Pilot Profile</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="<?php echo SITE_URL; ?>">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="javascript::">Flight Operations</a></div>
                <div class="breadcrumb-item">Pilot Profile</div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-primary">This pilot does not exist!</div>
            </div>
        </div>';
        return;
    }
?>
<style>
    .contact-item:first-child {
		border: none;
		padding-top: 0;
		margin-top: 0;
	}

	.contact-item {
		color: #5b636a;
		align-items: flex-start;
		flex-wrap: wrap;
		padding: 10px 0 10px 0;
		display: flex;
		justify-content: space-between;
		margin: auto;
		font-size: 13px;
		border-top: 1px solid #dee2e6;
	}

	.contact-item:last-child{
		padding-bottom: 0;
	}

	.align-right {
		text-align: left;
	}
	
	.align-left {
		text-align: left;
	}
</style>

<div class="section-header">
	<h1>Profile for <?php echo $pilot->firstname; ?></h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?php echo SITE_URL; ?>">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="javascript::">Flight Operations</a></div>
        <div class="breadcrumb-item"><?php echo $pilot->firstname; ?> Profile</div>
    </div>
</div>

<div class="row">
    <div class="col-12 col-md-12 col-lg-5">
        <div class="card profile-widget">
            <div class="profile-widget-header">
		<?php $publicCode = PilotData::getPilotCode($pilot->code, $pilot->pilotid); ?>
                <img alt="image" src="<?php echo PilotData::getPilotAvatar($publicCode); ?>" class="rounded-circle profile-widget-picture">
                <div class="profile-widget-items">
                    <div class="profile-widget-item">
                        <div class="profile-widget-item-label">Flights</div>
                        <div class="profile-widget-item-value"><?php echo $pilot->totalflights?></div>
                    </div>
                    <div class="profile-widget-item">
                        <div class="profile-widget-item-label">Miles</div>
                        <div class="profile-widget-item-value"><?php echo StatsData::TotalPilotMiles($pilot->pilotid); ?></div>
                    </div>
                    <div class="profile-widget-item">
                        <div class="profile-widget-item-label">Hours</div>
                        <div class="profile-widget-item-value"><?php echo $hrs.'h '.$min.'m';?></div>
                    </div>
                </div>
            </div>
            <div class="profile-widget-description">
                <div class="profile-widget-name"><?php echo $pilot->firstname . ' ' . $pilot->lastname?>
                    <div class="text-muted d-inline font-weight-normal"><div class="slash"></div> <?php echo $publicCode.' - '.$pilot->rank; ?></div>
                </div>
                <div class="contact-item" >
                    <h6>Location</h6>
                    <span class="float-right align-right">
                        <?php echo Countries::getCountryName($pilot->location);?>
                        <img style="margin-left: 7px;" src="<?php echo Countries::getCountryImage($pilot->location); ?>" alt="<?php echo Countries::getCountryName($pilot->location); ?>">
                    </span>
                </div>
                <div class="contact-item">
                    <h6>Rank</h6>
                    <span class="float-right align-right">
                        <img src="<?php echo $pilot->rankimage?>" class="mr-3" style="align-self: center;" height="40" alt="<?php echo $pilot->rank;?>" />
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-12 col-lg-7">
        <div class="card">
            <div class="card-header">
                <h4>Flights Map</h4>
            </div>
            <div class="card-body p-0">
                <?php
                    if(!$pireps) {
                        echo "
                        <div class='card-body'>
                            <div class='alert alert-primary mb-2' role='alert'>
                                <strong>Opss!</strong> ".$pilot->firstname." don't have any flights!
                            </div>
                        </div>
                        ";
                    } else {
                        require 'flown_routes_map.php';
                    }
                ?>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <div class="col-lg-12 alert alert-primary alert-title"><h4>Awards & Badges</h4></div>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php MainController::Run('vAwards', 'showPilotIssuedAwards', $userinfo->pilotid); ?>
                </div>
            </div>
        </div>
    </div>
</div>
