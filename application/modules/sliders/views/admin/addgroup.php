<div class="section">
    <h4>Edit Group</h4>

    <div class="content">
    <form method="post" action="" name="frm_user" id="frm_user" enctype="multipart/form-data">
        <table width="500" border="0" class="form-table">
            <tr valign='top'>
                <td width="150"><label>Name <span class="asterisk">*</span> </label></td>
                <td><input name="name" id="name" type="text"  value="<?php echo set_value('name'); ?>"  class="regular-text required"/></td>
            </tr>
           
            <tr valign='top'>
                <td width="150"><label>Max. Image Height <span class="asterisk">*</span></label></td>
                <td><input name="height" id="height" type="text"  value="<?php echo set_value('height'); ?>"  class="required regular-text"/></td>
            </tr>
            
            <tr valign='top'>
                <td width="150"><label>Max. Image Width <span class="asterisk">*</span></label></td>
                <td><input name="width" id="width" type="text"  value="<?php echo set_value('width'); ?>"  class="required regular-text"/></td>
            </tr>
          
            <tr>
                <td>&nbsp;</td>
                <td><input name="btn_submit" id="btn_submit" type="submit" value="save" class="button"/></td>
            </tr>
        </table>
    </form>
    </div>
</div>