<div class="section controls">
<a href="<?php echo admin_url('user/profile/edit/'.Current_User::user()->id())?>" class="control-button"><span class="ui-icon ui-icon-pencil"></span><span class="icontext">Edit Profile</span></a>

<a href="<?php echo admin_url('user/profile/changepwd')?>" class="control-button"><span class="ui-icon ui-icon-wrench"></span><span class="icontext">Change Password</span></a>


<div class="clear"></div>
</div>

<div class="section">
    <h4>
    <span class="ui-icon ui-icon-person"></span>
    	My Profile
    </h4>
    <div class="content">
    <table class="form-table">
        <tr>
            <td width="80"><label>Username</label></td>
            <td>:</td>
            <td> <?php echo Current_User::user()->getUsername();?></td>
        </tr>
        <tr>
            <td><label>First Name</label></td>
            <td>:</td>
            <td><?php echo Current_User::user()->getFirstname();?></td>
        </tr>
    <?php
    if(Current_User::user()->getMiddlename()!=''){
    ?>
        <tr>
            <td><label>Middle Name</label></td>
            <td>:</td>
            <td><?php echo Current_User::user()->getMiddlename();?></td>
        </tr>
    <?php
    }
    ?>
        <tr>
            <td><label>Last Name</label></td>
            <td>:</td>
            <td> <?php echo Current_User::user()->getLastname();?></td>
        </tr>
        <?php /* ?>
        <tr>
            <td><label>Designation</label></td>
            <td>:</td>
            <td> <?php echo Current_User::user()->getDesignation();?> </td>
        </tr>
        <?php */ ?>
        <tr>
            <td> <label>Email</label></td>
            <td>:</td>
            <td> <?php echo Current_User::user()->getEmail();?></td>
        </tr>
        <tr>
            <td><label>Phone</label></td>
            <td>:</td>
            <td><?php echo Current_User::user()->getPhone();?></td>
        </tr>
    </table>
    </div>
</div>
