<?php if(!defined('IN_PHPVMS') && IN_PHPVMS !== true) { die(); } ?>

<div class="section-header">
	<h1>Career</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?php echo SITE_URL; ?>">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="javascript::">Pilot Administration</a></div>
        <div class="breadcrumb-item"><a href="javascript::">Informations</a></div>
        <div class="breadcrumb-item">Career</div>
    </div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="card">
            <div class="card-header section-title mt-0">
                <h4>Pilot Ranks</h4>
            </div>
            <div class="card-body">
				<table class="table">
					<thead>
						<tr align="center">
							<th scope="row">Rank Title</th>
							<th scope="row">Hours Requirement</th>
							<th scope="row">Exam Requirement</th>
							<th scope="row">Pay Rate/Hour</th>
							<th scope="row">Rank Image</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($ranks as $rank) { ?>
						<tr align="center">
							<td><?php echo $rank->rank; ?></td>
							<td><?php echo $rank->minhours; ?></td>
							<td><?php echo $rank->eksam; ?></td>
							<td>$<?php echo $rank->payrate; ?>/hr</td>
							<td><img src="<?php echo $rank->rankimage; ?>" title="<?php echo $rank->rank; ?>" /></td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>

		<div class="card">
            <div class="card-header section-title mt-0">
                <h4>Awards</h4>
            </div>
            
			
			<div class="row">
                <?php
                    $count = 0;
                    if(!$generaward) 
                    {
                        echo '<div class="col-md-12"><div class="alert alert-primary"><div class="alert-title">We have no awards!</div>No worries, we already ordered the shiny badges for you.</div></div>';
                        } else {
                        foreach($generaward as $gen) 
                        {
                            $count++;
                            echo '
            
                            <div class="col-12 col-md-3 col-lg-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div style="margin-bottom: 4px;" class="chocolat-parent">
                                            <center><a href="'.$gen->image.'" class="chocolat-image" title="'.$gen->name .' - '. $gen->descrip.'">
                                                <div data-crop-image="165">
                                                    <img class="img-fluid" src="'.$gen->image.'" alt="'.$event->title.'">
                                                </div>
                                            </a></center>
                                        </div>
                                    <center><b>'.$gen->name.'</b></center>
                                    </div>
                                </div>
                            </div>';
                            if ($count == 4) 
                                { 
                                $count = 0;
                                echo "</br>";
                                }
                        }
                    }
                ?>
            </div>
		</div>
	</div>
</div>