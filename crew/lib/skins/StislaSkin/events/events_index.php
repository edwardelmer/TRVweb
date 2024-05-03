<?php if(!defined('IN_PHPVMS') && IN_PHPVMS !== true) { die(); } ?>
<div class="section-header">
	<h1>Events</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?php echo SITE_URL; ?>">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="javascript::">Flight Operations</a></div>
        <div class="breadcrumb-item">Events</div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
			<div class="card-header">
				<h4>Upcoming Events</h4>
			</div>
			
			<div class="row">
                <?php
                    $count = 0;
                    if(!$events) 
                    {
                        echo '<div class="col-md-12"><div class="alert alert-primary"><div class="alert-title">Stay Tune !</div>We are preparing the event for you.</div></div>';
                        } else {
                        foreach($events as $event)
                        if($event->active == '2') {
                                    continue;
                                }
                        {
                            $count++;
                            echo '
            
                            <div class="col-12 col-md-4 col-lg-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div style="margin-bottom: 8px;" class="chocolat-parent">
                                            <a href="'.$event->image.'" class="chocolat-image" title="'.$event->title.'">
                                                <div data-crop-image="165">
                                                    <img class="img-fluid" src="'.$event->image.'" alt="'.$event->title.'">
                                                </div>
                                            </a>
                                        </div>
                                        <center><h6><b>'.$event->title.'</b></a></h6></center>
                                        <center><a href="'.SITE_URL.'/index.php/events/get_event?id='.$event->id.'" text-decoration:underline; ><b>Details/Sign Up</b></a></center>
                                    </div>
                                </div>
                            </div>';
                            if ($count == 3) 
                                { 
                                $count = 0;
                                echo "</br>";
                                }
                        }
                    }
                ?>
            </div>
		</div>

        <div class="card">
			<div class="card-header">
				<h4>Past Events</h4>
			</div>
			
			<div class="row">
                <?php
                    $count = 0;
                    if(!$history) 
                    {
                        echo '<div class="col-md-12"><div class="alert alert-primary"><div class="alert-title">No Past Event!</div>This must be the time we just started the airline.</div></div>';
                        } else {
                        foreach(array_slice($history,0,9) as $event) 
                        {
                            $count++;
                            echo '
            
                            <div class="col-12 col-md-4 col-lg-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div style="margin-bottom: 8px;" class="chocolat-parent">
                                            <a href="'.$event->image.'" class="chocolat-image" title="'.$event->title.'">
                                                <div data-crop-image="165">
                                                    <img class="img-fluid" src="'.$event->image.'" alt="'.$event->title.'">
                                                </div>
                                            </a>
                                        </div>
                                        <center><h6><a href="'.SITE_URL.'/index.php/events/get_past_event?id='.$event->id.'" text-decoration:underline; ><b>'.$event->title.'</b></a></h6></center>
                                    </div>
                                </div>
                            </div>';
                            if ($count == 3) 
                                { 
                                $count = 0;
                                echo "</br>";
                                }
                        }
                    }
                ?>
            </div>
		</div>
<!--
        <div class="text-center">
			<a href="<?php echo url('/events/get_rankings'); ?>" class="btn btn-primary" name="submit">Show Pilot Rankings For Events</a>
		</div>
    </div>-->
</div>