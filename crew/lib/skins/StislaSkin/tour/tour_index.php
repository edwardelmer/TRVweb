<?php if(!defined('IN_PHPVMS') && IN_PHPVMS !== true) { die(); } ?>

<div class="section-header">
	<h1>Tours</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?php echo SITE_URL; ?>">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="javascript::">Flight Operation</a></div>
        <div class="breadcrumb-item"><a href="javascript::">Tours & Events</a></div>
        <div class="breadcrumb-item">Tours</div>
    </div>
</div>



<div class="row">
    <?php
        $count = 0;
        if(!$tours) 
        {
            echo '<div class="col-md-12"><div class="alert alert-primary"><div class="alert-title">No Downloads!</div>No downloads have been added yet.</div></div>';
            } else {
            foreach($tours as $tour) 
            {
                $count++;
                echo '

                <div class="col-12 col-md-4 col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div style="margin-bottom: 8px;" class="chocolat-parent">
                                <a href="'.$tour->image.'" class="chocolat-image" title="'.$tour->title.'">
                                    <div data-crop-image="285">
                                        <img class="img-fluid" src="'.$tour->image.'" alt="'.$tour->title.'">
                                    </div>
                                </a>
                            </div>
                            <center><a href="'.url('tour/details').'/'.$tour->id.'" text-decoration:underline align="center"><b>View Details</b></a></center>
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


