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
    <div class="col-md-12">
        <div class="card">
			
			<div class="card-body">
                <?php
                    if(!$tours) {
                        echo '<div class="alert alert-danger"><div class="alert-title">Oops</div>No Tours Available</div>';
                    } else {
                ?>
                <table class="table table-hover">
                    
                    <tbody>
                        <?php
                            foreach($tours as $tour)
                            {
                                if($tour->active == '0') {
                                    continue;
                                }

                                 $flights = unserialize($tour->flights);
                            echo '<tr>';
                            echo '<td width="60%">';
                            if($tour->image == '')
                            {echo '<center><h6>'.$tour->title.' No Image Available</h6></center>';}
                            else
                            {echo '<center><img src="'.$tour->image.'" alt="'.$tour->title.'" style="max-width:200px;" /></center>';}
                            
                            echo '</td><td>';
                            echo '<a href="'.url('tour/details').'/'.$tour->id.'" text-decoration:underline;"><b>View Details</b></a>';
                            
                            echo '</td>';
                            echo '<td>';
                            echo '</tr>';
                        }
                        echo '</table>';
                        }
                            
                        ?>
                    </tbody>
                </table>
              
			</div>
		</div>

        </div>
</div>

<div class="row">
    <?php
        if(!$allcategories) {
            echo '<div class="col-md-12"><div class="alert alert-primary"><div class="alert-title">No Downloads!</div>No downloads have been added yet.</div></div>';
        } else {
            foreach($tours as $tour) {
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
                <a href="'.url('tour/details').'/'.$tour->id.'" text-decoration:underline;"><b>View Details</b></a>
            </div>
        </div>
    </div>';
    }}
    ?>
</div>

