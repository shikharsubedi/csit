<div class="section">
    <h4>Edit Group Permissions for "<?php echo $group->getName();?>"</h4>
    <div class="content">
    <form name="edit-group-permissions" id="edit-group-permissions" method="post" action="">
   <table class="data" cellpadding="0" cellspacing="0">
    <thead>
      <th>Permission Name</th>
      <th>Permission Description</th>
      <th width="5%"><input type="checkbox" id="select-all" style="margin:0 0 0 0; padding:0 0 0 0;" /></th>
    </thead>
    <tbody>
    <?php
		$count = 1;
    	foreach($allpermissions as $p):
		$class = ($count > 0) ? "even":"odd";
		$count *= -1;
		$checked = (in_array($p->id(),$groupPermissions)) ? " checked":"";
	?>
    	<tr class="<?php echo $class;?>">
      <td><?php echo $p->getName();?></td>
      <td><?php echo $p->getDesc();?></td>
      <td><input class="permission" type="checkbox" name="permissions[]" value="<?php echo $p->id();?>"<?php echo $checked?> /></td>
     
    </tr>
    <?php
    	
		endforeach;
	?>
    </tbody>
  </table>
  	<input type="submit" name="submit" value="Save" class="button" />
  </form>
    </div>
</div>
<script type="text/javascript">
$(function(){
	$('#select-all').click(function(){
		$(this).closest('form').find('input.permission').attr('checked',$(this).is(':checked'));
	});
})
</script>