<div class="section">
    <h4>Edit Group</h4>

    <div class="content">
    <form method="post" action="" name="frm_user" id="frm_user" enctype="multipart/form-data">
        <table width="500" border="0" class="form-table">
        
            <tr valign='top'>
                <td width="150"><label>Name <span class="asterisk">*</span> </label></td>
                <td><input name="name" id="name" type="text"  value="<?php echo $slider->getName(); ?>"  class="regular-text required"/></td>
            </tr>
            <?php /*?>
            
            <tr valign='top'>
                <td width="150"><label>Max. Image Height <span class="asterisk">*</span></label></td>
                <td><input name="height" id="height" type="text"  value="<?php echo $slider->getHeight(); ?>"  class="required regular-text"/></td>
            </tr>
       
            
            <tr valign='top'>
                <td width="150"><label>Max. Image Width <span class="asterisk">*</span></label></td>
                <td><input name="width" id="width" type="text"  value="<?php echo $slider->getwidth(); ?>"  class="required regular-text"/></td>
            </tr>
            <?php */?>
            <tr>
                <td>&nbsp;</td>
                <td><input name="btn_submit" id="btn_submit" type="submit" value="save" class="button"/></td>
            </tr>
        </table>
    </form>
    </div>
</div>