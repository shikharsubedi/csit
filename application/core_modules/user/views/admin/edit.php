<div class="section">
    <h4>Edit User</h4>
    
    <div class="content">
    	<form method="post" action="" name="frm_user" id="frm_user">
        <table class="form-table">
            <tr valign="top">
                <th scope="row"><label>Username <span class="asterisk">*</span> </label></th>
                <td><input name="username" id="username" type="text"  value="<?php echo $user->getUsername(); ?>"  autocomplete="off" readonly="readonly"/></td>
            </tr>
            <tr valign="top">
                <th scope="row"><label>First Name <span class="asterisk">*</span> </label></th>
                <td><input name="first_name" id="first_name" type="text"  value="<?php echo $user->getFirstname(); ?>"   class="required" autocomplete="off"/></td>
            </tr>
            <tr valign="top">
                <th scope="row"><label>Middle Name  </label></th>
                <td><input name="middle_name" id="middle_name" type="text"  value="<?php echo $user->getMiddlename(); ?>"  autocomplete="off"/></td>
            </tr>
            <tr valign="top">
                <th scope="row"><label>Last Name <span class="asterisk">*</span> </label></th>
                <td><input name="last_name" id="last_name" type="text"  value="<?php echo $user->getLastname(); ?>"   class="required" autocomplete="off"/></td>
            </tr>
            <?php /* ?>
            <tr valign="top">
                <th scope="row"><label>Designation </label></th>
                <td><input name="designation" id="designation" type="text"  value="<?php echo $user->getDesignation(); ?>"  class="required" autocomplete="off"/></td>
            </tr>
            <?php */ ?>
            <tr valign="top">
                <th scope="row"><label>Email <span class="asterisk">*</span> </label></th>
                <td><input name="email" id="email" type="text"  value="<?php echo $user->getEmail(); ?>"  class="required" autocomplete="off"/></td>
            </tr>
            <tr valign="top">
                <th scope="row"><label>Phone </label></th>
                <td><input name="phone" id="phone" type="text"  value="<?php echo $user->getPhone(); ?>" class="text" /></td>
            </tr>
            <tr valign="top">
                <th scope="row"><label>Is Active </label></th>
                <td>
                	<input type="radio" name="isActive" id="isActive" value=0 checked="chedked" />
            		No&nbsp;&nbsp;
                	<input type="radio" name="isActive" id="isActive" value=1  <?php if($user->getStatus() == 'active') echo 'checked="checked"';?>/>
            		Yes
            		
                </td>
            </tr>
            <tr valign="top">
            	<th scope="row"><label>Group <span class="asterisk">*</span></label></th>
            	<td>
                	<?php
                        foreach($groups as $g)
							if($g->id() != ROLE_SUPER_ADMIN && $g->id() != ROLE_UNASSIGNED){
								$checked = (in_array($g->id(),$usergroups)) ? " checked='checked'":"";
								echo "<input type='checkbox' name='groups[]' value='".$g->id()."'$checked />".$g->getName()."&nbsp;&nbsp;&nbsp;";
							}
						?>
                </td>
            </tr>
            <tr>
                <th scope="row">&nbsp;</td>
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