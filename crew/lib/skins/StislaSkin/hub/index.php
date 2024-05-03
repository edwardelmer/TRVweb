<?php if(!defined('IN_PHPVMS') && IN_PHPVMS !== true) { die(); } ?>
<?php
    //simpilotgroup addon module for phpVMS virtual airline system
    //
    //simpilotgroup addon modules are licenced under the following license:
    //Creative Commons Attribution Non-commercial Share Alike (by-nc-sa)
    //To view full icense text visit https://creativecommons.org/licenses/by-nc-sa/3.0/
    //
    //@author David Clark (simpilot)
    //@copyright Copyright (c) 2009-2010, David Clark
    //@license https://creativecommons.org/licenses/by-nc-sa/3.0/
?>

<div class="section-header">
	<h1>Hub Data</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?php echo SITE_URL; ?>">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="javascript::">Flight Operation</a></div>
        <div class="breadcrumb-item">Hub Data</div>
    </div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="col-md-12">
            <div class="widget">
    			<div class="widget-simple themed-background-dark">
    				<h4 class="widget-content widget-content-light themed-color-default">Hubs</h4>
    	        </div>
        	    <div class="widget-extra">
                    <?php
                    if(!$hubs)
                    	{
                    		echo "You have not added any Hubs yet.";
                    	}
                    ?>
                    
                    <table width="100%" border="0">
                    <tr>
                    	<th>Airport ICAO</th>
                        <th>Airport Name</th>
                        <th>View Details</th>
                    </tr>
                    <?php
                    foreach($hubs as $hub)
                    {
                    ?>
                    <tr>
                    	<td><?php echo $hub->icao;?></td>
                        <td><?php echo $hub->name;?></td>
                        <td><a href="<?php echo SITE_URL;?>/index.php/Hub/HubView/<?php echo $hub->icao;?>"><span class="btn">View Details</span></a></td>
                    </tr>
                    <?php
                    }
                    ?>
                    </table>
                    <!--Do not remove the copyright -->
                    <p>&copy; 2014 Strider V1.4.</p>
                </div>
            </div>
        </div>
    </div>
</div>
