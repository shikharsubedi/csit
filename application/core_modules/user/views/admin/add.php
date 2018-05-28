<div class="section">
    <h4>Add User</h4>
    
    <div class="content">
    	<form method="post" action="" name="frm_user" id="frm_user">
        <table class="form-table">
            <tr valign="top">
                <th scope="row"><label>Username <span class="asterisk">*</span> </label></th>
                <td><input name="username" id="username" class="regular-text required" type="text"  value="<?php echo set_value('username'); ?>"  autocomplete="off" /></td>
            </tr>
            <tr valign="top">
                <th scope="row"><label>First Name <span class="asterisk">*</span> </label></th>
                <td><input name="first_name" id="first_name" type="text"  value="<?php echo set_value('first_name'); ?>"   class="regular-text required" autocomplete="off"/></td>
            </tr>
            <tr valign="top">
                <th scope="row"><label>Middle Name  </label></td>
                <td><input name="middle_name" id="middle_name" type="text" class="regular-text"  value="<?php echo set_value('middle_name'); ?>"  autocomplete="off"/></td>
            </tr>
            <tr valign="top">
                <th scope="row"><label>Last Name <span class="asterisk">*</span> </label></th>
                <td><input name="last_name" id="last_name" type="text"  value="<?php echo set_value('last_name'); ?>"   class="regular-text required" autocomplete="off"/></td>
            </tr>
            <?php /* ?>
            <tr valign="top">
                <th scope="row"><label>Designation <span class="asterisk">*</span></label></th>
                <td><input name="designation" id="designation" type="text"  value="<?php echo set_value('designation'); ?>"  class="regular-text required" autocomplete="off"/></td>
            </tr>
            <?php */ ?>
            <tr valign="top">
                <th scope="row"><label>Email <span class="asterisk">*</span> </label></th>
                <td><input name="email" id="email" type="text"  value="<?php echo set_value('email'); ?>"  class="regular-text required email" autocomplete="off"/></td>
            </tr>
            <tr valign="top">
                <th scope="row"><label>Phone </label></td>
                <td><input name="phone" id="phone" type="text"  value="<?php echo set_value('phone'); ?>" class="regular-text " /></td>
            </tr>
           <tr valign="top">
                <th scope="row"><label>Is Active </label></th>
                <td>
                	<input type="radio" name="isActive" id="isActive" value=1  checked="checked"/>
            		Yes&nbsp;&nbsp;
            		<input type="radio" name="isActive" id="isActive" value=0 />
            		No
                </td>
            </tr>
            <tr valign="top">
            	<th scope="row"><label>Group <span class="asterisk">*</span></label></th>
            	<td>
                	    <?php
                        foreach($groups as $g)
							if($g->id() != ROLE_SUPER_ADMIN)
								echo "<input type='checkbox' name='groups[]' value='".$g->id()."' />".$g->getName()."&nbsp;&nbsp;&nbsp;";
						?>
                </td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td><input name="btn_submit" id="btn_submit" type="submit" value="save" class="button"/></td>
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
<script type="text/javascript">
$(function(){
	//if(formValidator)
		//$('checkbox[name*="group"]').rules("add",{required:true});
})
</script>