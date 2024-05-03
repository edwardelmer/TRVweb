<h3>Hubs</h3>
<br />
<center>
<?php
if(PilotGroups::group_has_perm(Auth::$usergroups, EDIT_FLEET))
{
?>
<a href="<?php echo SITE_URL?>/admin/index.php/Hub_admin">Hubs Main</a><br />
<a href="<?php echo SITE_URL?>/admin/index.php/Hub_admin/new_hub">Add new Hub</a><br />
<?php
}
?>
</center>
<br />