<?php if(!defined('IN_PHPVMS') && IN_PHPVMS !== true) { die(); } ?>
<h3>Custom Fields</h3>
<?php
if(!$allfields)
{
	echo '<p>You have not added any custom fields</p><br />';
	return;
}
?>

<table id="tabledlist" class="table">
<thead>
	<tr>
		<th>Field Name</th>
		<th>Default Value</th>
		<th>Type</th>
		<th>Options</th>
	</tr>
</thead>
<tbody>
<?php
foreach($allfields as $field)
{
?>
<tr id="row<?php echo $field->fieldid;?>">
	<td align="center"><?php echo $field->title;?></td>
	<td align="center"><?php echo $field->value;?></td>
	<td align="center"><?php echo $field->type;?></td>
	<td align="center" nowrap width="1%">
		<a class="btn btn-info" href="<?php echo SITE_URL?>/admin/index.php/settings/editfield?id=<?php echo $field->fieldid;?>">Edit</a>
			
		<button href="<?php echo SITE_URL?>/admin/action.php/settings/customfields" 
				action="deletefield" id="<?php echo $field->fieldid;?>" class="deleteitem button btn btn-danger">
			Delete</button>
	</td>
</tr>
<?php
}
?>
</tbody>
</table>