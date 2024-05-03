
<?php if(!defined('IN_PHPVMS') && IN_PHPVMS !== true) { die(); } ?>
<div class="section-header">
	<h1><?php echo SITE_NAME;?> Staff Team</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?php echo SITE_URL; ?>">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="javascript::">Resources & Support</a></div>
        <div class="breadcrumb-item"><a href="javascript::">Company</a></div>
        <div class="breadcrumb-item">Staff</div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card card-primary">
            
            <div class="card-body">
                <img align=center" src="<?php echo SITE_URL?>/lib/images/reds/company.png" alt="Company Structure" width="1000" >
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
			<div class="card-body">
                <table class="table table-hover">
                    <?php
                    if(!$stafflevels)
                    {
                    echo 'There is no staff!';
                    $stafflevels = array();
                    }
                    foreach($stafflevels as $level)
                    {
                    ?>
                    <thead>
                        <tr align="float-center">
                            <th colspan="3"><h5><?php echo $level->name;?></h5></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $allstaff = vStaffListData::GetAllStaffInCat($level->id);
                            if(!$allstaff)
                            {
                            $allstaff = array();
                            echo '<tr class="row0"><td align="center" colspan="3">No Staff Members</td></tr>';
                            }
                            foreach($allstaff as $staff)
                            {
                        ?>
                    	<tr width="100" align="center">
                    	<td width="30" ><?php echo $staff->title;?></td>
                        <td width="30" ><?php if($staff->pilotid == 0)
                        					{
                                            	echo 'VACANT';
                                            }
                                            else
                                            {
                                            	echo '<a href="'.url('vStaff/view/'.$staff->id).'">'.$staff->firstname.' '.$staff->lastname.'</a>';
                                            }
                                            ?></td>
                        <td width="40" ><?php echo $staff->email;?></td>
                    	</tr>
                    
                    	<?php
                        }
                        ?>
                    <?php
                    }
                    ?>
                    </tbody>
                </table>
                
            </div>
        </div>
    </div>
</div>

<?php
if(!$online_staff)
{
        echo 'No Staff Members Are Online!';
        return;
   
}
foreach($online_staff as $staff)
{
?>
<p><a href="<?php echo url('/profile/view/'.$staff->pilotid);?>"><?php echo PilotData::GetPilotCode($staff->code, $staff->pilotid). ' ' .$staff->firstname . ' ' . $staff->lastname?></a></p>
<?php
}
?>

