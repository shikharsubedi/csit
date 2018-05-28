<div class="section">
	<h4>Edit Footer Link</h4>
    <div class="content">
    <?php if ($footer):?>
<form method="post" action="" name="frm_user" id="frm_user" enctype="multipart/form-data">
	<table class="form-table">
        	<tr valign='top'>
                <th scope="row"><label>Link Label <span class="asterisk">*</span> </label></th>
                <td><input name="link_label" id="link_label" type="text"  value="<?php echo $footer->getTitle()?>"  class="regular-text required"/></td>
            </tr>
            
            <tr valign='top'>
                <th scope="row"><label for="type">Link type </label></th>
                <td>
            		<input type="radio" name="type" id="type-ext" value="external" <?php if ($footer->getType()=='external') echo 'checked="checked"'?> />
            		External URL&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="radio" name="type" id="type-int" value="internal" <?php if ($footer->getType()=='internal') echo 'checked="checked"'?> >
            		Internal Page
                </td>
            </tr>
            
             <?php
				$display_url = '';
            	if($footer->getType() == 'internal')
					$display_url = ' style="display:none;"';
			?>
             <tr valign='top' id="url-page"<?php echo $display_url;?>>
                <th scope="row"><label for="target_url">URL <span class="asterisk">*</span></label></th>
                <td><input name="target_url" id="target_url" type="text"  value="<?php if ($footer->getType() == 'external') echo $footer->getUrl()?>"  class="regular-text" /></td>
            </tr>
            
            
            <?php
				$display_page = '';
				if($footer->getType() == 'external')
					$display_page = ' style="display:none;"';
			?>
            <tr valign="top" id="page-select"<?php echo $display_page;?>>
                <th scope="row"><label for="target_page">Page to link<span class="asterisk">*</span></label></th>
                <td>
                <select name="target_page" id="target_page" class="">
                    	<option value="0">None</option>
                        <?php
							$selected = NULL;
							
							if(is_numeric($footer->getUrl()))
								$selected = $footer->getUrl();
                        	echo pageSelectTree($selected);
						?>
                    </select><small> ( The subpages of this page will be displayed in our product section.) </small>
                </td>
            </tr>
             <tr valign='top'>
                <th scope="row"><label for="is_active">Is Active? </label></th>
                <td>
                	<input type="checkbox" name="is_active" <?php if ($footer->getStatus()) echo ' checked="checked"'?>/>
                </td>
            </tr>
            
            <tr>
                <td>&nbsp;</td>
                <td><input name="btn_submit" id="btn_submit" type="submit" value="save" class="button"/></td>
            </tr>
        </table>
</form>
    
    <?php else:
		echo 'Footer with this ID is not found.'; 
	endif;?>
    
    </div>
</div>

<script type="text/javascript">

$(function(){

if ($('input[name=type]').val()=='internal') $('#target_url').removeClass('required');
if ($('input[name=type]').val()=='external') $('#target_page').removeClass('required');

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