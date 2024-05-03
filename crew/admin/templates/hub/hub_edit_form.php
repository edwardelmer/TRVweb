<?php


$this->show('hub/hub_header.tpl');
?>


<h4>Edit Hub</h4>
<hr />
<form name="eventform" action="<?php echo SITE_URL; ?>/admin/index.php/Hub_admin" method="post" enctype="multipart/form-data">
<table width="80%">
        
            <tr>
                <td>Hub ICAO</td>
                <td><input type="text" name="hubicao"
                           <?php echo 'value="'.$hubs->hubicao.'"'; ?>
                           ></td>
            </tr>
            <tr>
                <td>Airport Name</td>
                <td><input type="text"  name="hubname"
                           <?php echo 'value="'.$hubs->hubname.'"'; ?>
                           ></td>
            </tr>

            <tr>
                <td>Latitude</td>
                <td><input type="text" name="lat"
                           <?php echo 'value="'.$hubs->lat.'"'; ?>
                           ></td>
            </tr>
            <tr>
                <td>Longtitude</td>
                <td><input type="text" name="lng"
                           <?php echo 'value="'.$hubs->lng.'"'; ?>
                           ></td>
            </tr>
            <tr>
                <td>Pilot ID</td>
                <td><input type="text" name="pilotid"
                           <?php echo 'value="'.$hubs->pilotid.'"'; ?>
                           ></td>
            </tr>
            <tr>
                <td>Manager</td>
                <td><input type="text" name="manager"
                           <?php echo 'value="'.$hubs->manager.'"'; ?>
                           ></td>
            </tr>
                        <tr>
                <td>Image</td>
                <td><input type="text" name="image"
                           <?php echo 'value="'.$hubs->image.'"'; ?>
                           ></td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="hidden" name="hubid" value="<?php echo $hubs->hubid; ?>" />
                    <input type="hidden" name="action" value="save_edit_hub" />
                    <input type="submit" value="Edit Hub"></td>
            </tr>
   
    </table>     </form>