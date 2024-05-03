<div class="col-12 col-md-6 col-lg-12">
    <?php
    if(!$allawardtpes) 
    {
        echo '<div class="col-12"><div class="alert alert-primary"><div class="alert-title">No Awards Categories!</div>No awards categories have been added yet.</div></div>';
    } else 
        {
            foreach($allawardtpes as $type) 
                { ?>
            <!-- <div class="card-header">
                <h6><?php echo $type->typ_name;?></h6>
            </div> -->
            <div class="card-body">
                <div class="row">
                <?php
                    # This loops through every award available in the category
                    $allissuedawards = vAwardsData::GetAllIssuedAward($pilotid, $type->typ_id );
    
                    if(!$allissuedawards) {
                        echo 'No Awards Yet';
                        $allissuedawards = array();
                    }
                    
                    foreach($allissuedawards as $award) {
                        $dwCount = (is_array($allissuedawards) ? count($allissuedawards) : 0);
                            ?>
                                <div class="card">
                                    <div style="margin-bottom: 8px;" class="chocolat-parent" align="left">
                                        <a href="<?php echo $award->awd_image; ?>" class="chocolat-image" title="<?php echo $award->awd_name; ?> issued on - <?php echo date(DATE_FORMAT, $award->grt_dategrant);?> - <?php echo $award->awd_desc; ?>">
                                            <div data-crop-image="150">
                                                <img class="img-fluid" width="150" src="<?php echo $award->awd_image; ?>" alt="<?php echo $award->awd_name; ?>">
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            
                            
                            <?php 
                                    if($dwCount > 1) {
                                        echo '<hr/>';
                                    }
                                }
                            ?>
                </div>
            </div>
                    
                            <?php 
                } 
        } ?>
</div>
