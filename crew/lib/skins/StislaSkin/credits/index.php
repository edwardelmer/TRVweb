<?php if(!defined('IN_PHPVMS') && IN_PHPVMS !== true) { die(); } ?>
<div class="section-header">
	<h1>Credits</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?php echo SITE_URL; ?>">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="javascript::">Resources & Support</a></div>
        <div class="breadcrumb-item"><a href="javascript::">Company</a></div>
        <div class="breadcrumb-item">Credits</div>
    </div>
</div>


<div class="row">
    <div class="col-md-12">
        <div class="card">
			
			<div class="card-body">
                <table class="table table-hover" border="1px">
                    <tbody>
                        <?php
                            foreach($credits as $credit)
                            {
                                echo '<tr>';
                                if($credit->image != '')
                                {echo '<td align="center"><img src="'.$credit->image.'" alt="'.$credit->name.'" style="max-height: 100px; max-width: 200px;" /></td>';}
                                else
                                {echo '<td>&nbsp;</td>';}
                                if($credit->link != '')
                                {echo '<td align="center"><a href="'.$credit->link.'" target="_blank">'.$credit->name.' website</a></td>';}
                                else
                                {echo '<td>'.$credit->name.'</td>';}
                                echo '<td width="50%">'.$credit->description.'</td>';
                                echo '</tr>';
                                
                                
                                
                            }
                        ?>
                    </tbody>
                </table>
              
			</div>
		</div>

        </div>
</div>

