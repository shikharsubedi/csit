<div class="section controls">
<a href="<?php echo admin_url('user/add')?>" class="control-button"><span class="ui-icon ui-icon-plusthick"></span><span class="icontext">Add a User</span></a>

<a href="<?php echo admin_url('user/addgroup')?>" class="control-button"><span class="ui-icon ui-icon-plusthick"></span><span class="icontext">Add a Group</span></a>


<div class="clear"></div>
</div>
<div class="section tabs">
    <ul>
		<li><a href="#tabs-user">Users</a></li>
		<li><a href="#tabs-group">Groups</a></li>
	</ul>
	<div id="tabs-user">
		<table class="data" cellpadding="0" cellspacing="0">
    <thead>
      <th width="2%">Sn</th>
      <th width="22%">Full Name</th>
      <th width="18%">Username</th>
      <th>UserType</th>
      <th width="3%">Status</th>
      <th width="13%">Action</th>
    </thead>
    <tbody>
    <?php
	$sn = 1;
    foreach($users as $u)
	{
	?>
    <tr class="<?php if($sn%2==0) echo 'odd'; else echo 'even';?>">
      <td class="table_check"><?php echo $sn++;?></td>
      <td><?php echo $u->getFirstname()." ".$u->getMiddlename()." ".$u->getLastname();?></td>
      <td><?php echo $u->getUsername();?></td>
      <td>
      <ul>
      	<?php
        	foreach($u->getGroups() as $g)
				echo "<li>".$g->getName()."</li>";
		?>
        </ul>
      </td>
      <td>
	  	<?php echo ucfirst($u->getStatus())?></td>
      <td>
        <div class="action-controls">
            <?php if($u->id() != 1):?>
            <a href="<?php echo admin_url('user/edit/'.$u->id())?>" class="action-button" title="Edit User"><span class="ui-icon ui-icon-pencil"></span></a>
            <a href="<?php echo admin_url('user/delete/'.$u->id());?>" class="action-button del-user" title="Delete User"><span class="ui-icon ui-icon-trash"></span></a>
            <?php endif;?>
            <div class="clear"></div>
         </div>
     	</td>
    </tr>
    <?php	
	//$sn++;
	}
	?>
    </tbody>
  </table>
	</div>
	<div id="tabs-group">
		<table class="data" cellpadding="0" cellspacing="0">
    <thead>
      <th width="2%">Sn</th>
      <th width="55%">Group Name</th>
      <th>Status</th>
      <th >Action</th>
    </thead>
    <tbody>
    <?php
	$sn = 1;
    foreach($groups as $u)
	{
		$class = ($sn %2 == 0 ) ? "even":"odd";
	?>
    <tr class="<?php echo $class;?>">
      <td class="table_check"><?php echo $sn++;?></td>
      <td><?php echo $u->getName();?></td>
      <td><?php echo ucfirst($u->getStatus())?></td></td>
      <td>
      	<div class="action-controls">
            <?php if($u->id() != 1):?>
            <a href="<?php echo admin_url('user/editgroup/'.$u->id())?>" class="action-button" title="Edit Group"><span class="ui-icon ui-icon-pencil"></span></a>
            <a href="<?php echo admin_url('user/editgrouppermissions/'.$u->id())?>" class="action-button" title="Edit Permission"><span class="ui-icon ui-icon-locked"></span></a>
            <?php endif;?>
            
            
            <?php if($u->id() != 1 && $u->id() != 2):?>
            <a href="<?php echo admin_url('user/deletegroup/'.$u->id());?>" class="action-button" title="Delete Group"><span class="ui-icon ui-icon-trash"></span></a>
            <?php endif;?>
            <div class="clear"></div>
         </div>
     	</td>
    </tr>
    <?php	
	}
	?>
    </tbody>
  </table>
	</div>
</div>
<script type="text/javascript">
$(function(){
	$('.del-user').click(function(){
		var really = confirm('Do you really want to delete this user?');
		if(!really)
			return false;
	});
})/**/
</script>

