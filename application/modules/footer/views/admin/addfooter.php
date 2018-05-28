<div class="section">
	<h4>Add New Footer Link</h4>
    <div class="content">
    <form name="add-member" method="post" action="" enctype="multipart/form-data">
    	<table class="form-table">
        	<tr valign='top'>
                <th scope="row"><label>Link Label <span class="asterisk">*</span> </label></th>
                <td><input name="link_label" id="link_label" type="text"  value="<?php echo set_value('link_label'); ?>"  class="regular-text required"/></td>
            </tr>
            
            <tr valign='top'>
                <th scope="row"><label for="type">Link type </label></th>
                <td>
            		<input type="radio" name="type" id="type-ext" value="external" checked="checked"/ />
            		External URL&nbsp;&nbsp;
                    <input type="radio" name="type" id="type-int" value="internal"  >
            		Internal Page
                </td>
            </tr>
            
             <tr valign='top' id="url-page">
                <th scope="row"><label for="target_url">URL</label></th>
                <td><input name="target_url" id="target_url" type="text"  value="<?php echo set_value('target_url'); ?>"  class="regular-text required" /></td>
            </tr>
            
            <tr valign="top" id="page-select" style="display:none;">
                <th scope="row"><label for="target_page">Page to link <span class="asterisk">*</span></label></th>
                <td>
                <select name="target_page" id="target_page" class="required">
                    	<option value="0">None</option>
                        <?php
                        	echo pageSelectTree();
						?>
                    </select>
                </td>
            </tr>
             <tr valign='top'>
                <tr valign='top'>
                <th scope="row"><label for="type">Is Active? </label></th>
                <td>
            		<input type="checkbox" name="is_active" checked="checked"/>
                </td>
            </tr>
            
            
            <tr>
                <td>&nbsp;</td>
                <td><input name="btn_submit" id="btn_submit" type="submit" value="save" class="button"/></td>
            </tr>
        </table>
    </form>
    </div>
</div>
<script type="text/javascript">
$(function(){
	$('input[name=type]').bind('change',function(){
		var val = $(this).val();
		
		if(val == 'external')
		{
			$('#url-page').show();
			$('#target_url').addClass('required');
			$('#page-select').hide();
			$('#target_page').removeClass('required');
			
		}
		if(val == 'internal')
		{
			$('#url-page').hide();
			$('#target_page').addClass('required');
			$('#page-select').show();
			$('#target_url').removeClass('required');
		}
	});
})
</script>