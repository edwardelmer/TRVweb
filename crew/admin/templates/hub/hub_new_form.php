<?php

$this->show('hub/hub_header.php');

/*if(isset($hub))
{echo '<div id="error">All fields must be filled out</div>'; }*/
?>

<h4>Add a hub</h4>

<table width="80%">
        <form name="eventform" action="<?php echo SITE_URL; ?>/admin/index.php/Hub_admin" method="post" enctype="multipart/form-data">
            <tr>
                <td>Hub ICAO</td>
                <td><input type="text" name="hubicao"<?php
                                if(isset($hub))
                                {echo 'value="'.$hub['hubicao'].'"';}
                           ?> />
                           </td>
            </tr>
            <tr>
                <td>Airport</td>
                <td>
                <select name="hubname" id="hubname">
                
               
		<?php
		foreach($hubs as $airport)
		{
			echo '<option value="'.$airport->name.'">'.$airport->name.'</option>';
		}
        
		?>
		</select>
                </td>
            </tr>
                        <tr>
                <td>Image</td>
                <td><input type="text" name="image"
                           <?php
                                if(isset($hub))
                                {echo 'value="'.$hub['image'].'"';}
                           ?>/>
                           </td>
            </tr>
            <tr>
                <td>Latitude</td>
                <td><input type="text" name="lat"
                           
                                value="<?php echo $hub['lat'];?>"
                           >
                           </td>
            </tr>
            <tr>
                <td>Longtitude</td>
                <td><input type="text" name="lng"
                           
                                value="<?php echo $hub['lng'];?>"
                           >
                           </td>
            </tr>
            <tr>
                <td>Pilot ID</td>
                <td><input type="text" name="pilotid"
                           
                                value="<?php echo $hub['pilotid'];?>"
                           >
                           </td>
            </tr>
            <tr>
                <td>Manager</td>
                <td><input type="text" name="manager"
                           
                                value="<?php echo $hub['manager'];?>"
                           >
                           </td>
            </tr>
            <tr>
                <td colspan="2"><input type="hidden" name="action" value="save_new_hub" /><input type="submit" value="Save New Hub"></td>
            </tr>
        </form>
    </table>

