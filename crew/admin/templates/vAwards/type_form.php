<?php if(!defined('IN_PHPVMS') && IN_PHPVMS !== true) { die(); } ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<h3><?php echo $title?></h3>
<form id="form" action="<?php echo SITE_URL?>/admin/action.php/vAwardsAdmin/allawardtypes" method="post">
<dl>
	<dt>Add Award Category</dt>
	<dd><input name="typ_name" class="form-control" type="text" value="<?php echo $type->typ_name;?>" /></dd>
	
	<dt></dt>
	<dd><input type="hidden" name="typ_id" value="<?php echo $type->typ_id;?>" />
		<input type="hidden" name="action" value="<?php echo $action;?>">
		<input type="submit" name="submit" class="btn btn-success" value="<?php echo $title;?>" /></dd>
		
</dl>
</form>