<div class="section">
	<h4>Edit Album [<?php echo $album->getName()?>]</h4>
    <div class="content">
    	<form name="edit-album" id="form-edit-album" enctype="multipart/form-data" method="post">
        	<table width="100%" class="form-table">
            	<tr valign="top">
                	<th scope="row"><label for="album_name">Album Name <span class="asterisk">*</span></label></th>
                    <td><input type="text" name="album_name" value="<?php echo $album->getName()?>" class="required regular-text" /></td>
                </tr>
                
                  
                <tr valign="top">
                	<th scope="row"><label for="description">Description <span class="asterisk">*</span></label></th>
                    <td><textarea name="description" id="description" class="required regular-text" cols="40" rows="8"><?php echo $album->getDescription()?></textarea></td>
                </tr>
                <tr valign='top'>
                <td><label>Published </label></td>
                <td>
                	<input type="radio" name="active" id="published-yes" value="Y"  checked="checked"/>
            		Yes&nbsp;&nbsp;
            		<input type="radio" name="active" id="published-no" value="N" <?php if ($album->getStatus() == STATUS_INACTIVE) echo ' checked="checked" '; ?> />
            		No
                </td>
            </tr>
                <tr>
                	<th><label>Images</label></th>
                	<td>
                    	<div class="album-container">
                        	<?php foreach($images as $i):?>
                            	<div class="album_image">
                                	<div class="remove" title="Remove this image" id="rem_<?php echo $i->id()?>" ></div>
                                	<img src="<?php echo base_url().'assets/upload/images/album/thumbs/'.$i->getName()?>" />
                                    Caption : <input type="text" name="caption[<?php echo $i->id()?>]" class="regular-text" value="<?php echo $i->getCaption()?>" /><br/>
                                    Show in website : <input type="checkbox" name="isactive[<?php echo $i->id()?>]"<?php if($i->getStatus() == STATUS_ACTIVE) echo 'checked="checked"'?> /><br/>
                                    Cover Image for this album 
                                    <input type="radio" name="cover_image" value=" <?php echo $i->id(); ?>" <?php if($album->getCoverImage() == $i) echo 'checked="checked"'?> />
                                    <div class="clear"></div>
                                </div>
                            <?php endforeach;?>
                            
                        </div>
                    </td>
                </tr>
               
                <tr>
                    <td>&nbsp;</td>
                    <td>
                        <a href="<?php echo admin_url('gallery/addimage/'.$album->id()); ?>" class="button">Add More Image</a>
                    </td>
                </tr>
                
                <tr>
                    <td>&nbsp;</td>
                    <td>
                    	<input name="btn_submit" id="btn_submit" type="submit" value="Save" class="button" />
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<script type="text/javascript">
$(function(){
	$('.remove').click(function(){
		var really = confirm("Do you really want to remove this image?");
		if(really)
		{
			if($(this).parent('.album_image').find('input[name=cover_image]').is(':checked'))
			{
				$('#form-edit-album').append('<input type="hidden" name="remove-image[]" value="'+$(this).attr("id").split('_')[1]+'" />');
				$(this).parents('.album_image').hide().remove();
				$('input[name=cover_image]:first').attr('checked',true);
			}
			else
			{
				$('#form-edit-album').append('<input type="hidden" name="remove-image[]" value="'+$(this).attr("id").split('_')[1]+'" />');
				$(this).parents('.album_image').hide().remove();
			}
		}else return false;
	});
})
</script>