<div class="section">
    <h4>Edit User Group "<?php echo $group->getName()?>"</h4>
    <div class="content">
    	<form method="post" action="" name="groups" id="groups" >   
        <table class="form-table">
       		<tr valign="top">
                <th scope="row"><label for="admin_name">Group Name <span class="asterisk">*</span><span class="fielddesc">The group name</span></label></th>
                <td><input name="group_name" id="group_name" type="text" size="50" value="<?php echo $group->getName();?>"  autocomplete="off" class="regular-text required" /></td>
            </tr>
            <tr valign="top">
                <th scope="row"><label>Status</label></th>
                <td>
                <input type="radio" name="isActive" id="isActive" value=1  checked="checked"/>
            		Active&nbsp;&nbsp;
            		<input type="radio" name="isActive" id="isActive" value=0<?php if($group->getStatus() =='inactive') echo ' checked="checked" ';?> />
            		Inactive
            </tr>
            <tr>
                <td><label>&nbsp;</label></td>
                <td><input type="submit" name="Submit" value="Save Group" class="button" ></td>
            </tr>
            <tr>
            	<td colspan="2">
                	<small>Fields marked with (*) are mandatory.</small>
                </td>
            </tr>
        </table>
    </form>
    </div>
</div>