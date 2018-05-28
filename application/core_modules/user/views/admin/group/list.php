<div id="tabledata" class="section">
	<h2 class="ico_group">User Groups</h2>
    <table id="table">
        <thead>
            <tr>
                <th>SN</th>
                <th>Group Name</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
			<?php 
			$sn = 0;
           foreach($groups->result() as $g){
                $sn++;			
            ?>
            <tr class="<?php if($sn%2==0) echo 'odd'; else echo 'even';?>">
                <td><?php echo $sn;?></td>
                <td class="table_date"><?php echo $g->group_name;?></td>
                <td><input type="checkbox" class="noborder" name="chkbox" value="<?php echo $g->group_id;?>" <?php if($g->is_active == 'Y') {?>checked="checked" <?php }?> onclick="active(this.checked, this.value)"/></td>
                <td><a href="<?php echo admin_url('group/edit/'.$g->group_id)?>"><img src="<?php echo base_url()?>assets/img/edit.png" alt="accepted"/></a>&nbsp;<a href="<?php echo admin_url('permission/group/'.$g->group_id)?>" title="Manage Permission"><img src="<?php echo base_url()?>assets/images/permission.png" alt="Permission" /></a></td>
            </tr>
            <?php }?>
        </tbody>
    </table>
</div>