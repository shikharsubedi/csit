<div class="section">
  <h4><span class="ui-icon ui-icon-pencil"></span>Edit Profile</h4>
  <div class="content">
  	<form name="myform" id="myform" method="post"    action="" >
    <table class="form-table">
      <tr valign="top">
        <th scope="row"><label>Username <span class="asterisk">*</span></label></th>
        <td><input name="username" id="username" type="text"  value="<?php echo Current_User::user()->getUsername();?>"  readonly="readonly"/></td>
      </tr>
      <tr valign="top">
        <th scope="row"><label>First Name <span class="asterisk">*</span></label></th>
        <td><input name="first_name" id="first_name" type="text"  value="<?php echo Current_User::user()->getFirstname();?>" class="regular-text required" autocomplete="off"/></td>
      </tr>
      <tr valign="top">
        <th scope="row"><label>Middle Name</label></th>
        <td><input name="middle_name" id="middle_name" type="text"  value="<?php echo Current_User::user()->getMiddlename();?>" class="regular-text " autocomplete="off"/></td>
      </tr>
      <tr valign="top">
        <th scope="row"><label>Last Name <span class="asterisk">*</span></label></th>
        <td><input name="last_name" id="last_name" type="text"  value="<?php echo Current_User::user()->getLastname();?>" class="regular-text required"  autocomplete="off"/></td>
      </tr>
      <?php /* ?>
      <tr valign="top">
        <th scope="row"><label>Designation</label></th>
        <td><input name="designation" id="designation" type="text"  value="<?php echo Current_User::user()->getDesignation();?>" class="regular-text " autocomplete="off"/>
        </td>
      </tr><?php */ ?>
      <tr valign="top">
        <th scope="row"><label>Email <span class="asterisk">*</span></label></th>
        <td><input name="email" id="email" type="text"  value="<?php echo Current_User::user()->getEmail();?>" class="required email regular-text" autocomplete="off"  /></td>
      </tr>
      <tr valign="top">
        <th scope="row"><label>Phone</label></th>
        <td><input name="phone" id="phone" type="text"  value="<?php echo Current_User::user()->getPhone();?>" class="regular-text" /></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><input type="submit" name="submit" value="Submit" class="button"></td>
      </tr>
    </table>
  </form>
  </div>
</div>