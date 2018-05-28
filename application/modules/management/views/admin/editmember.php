<div class="section">
	<h4>Edit Team Member Details</h4>
    <div class="content">
    <?php if ($member):?>
    <form name="add-member" method="post" action="" enctype="multipart/form-data">
    	<table class="form-table">
        	<tr>
            	<th scope="row"><label for="name">Name : </label></th>
                <td><input type="text" name="name" class="required regular-text" value="<?php echo $member->getName()?>"/></td>
            </tr>
            <tr>
            	<th scope="row"><label for="position">Position : </label></th>
                <td><input type="text" name="position" class="required regular-text" value="<?php echo $member->getPosition()?>"></td>
            </tr>
            
            <tr>
            	<th scope="row"><label for="experience">Experience : </label></th>
                <td><input type="text" name="experience" class="regular-text" value="<?php echo $member->getExperience()?>"></td>
            </tr>
            
           <tr>
            	<th scope="row"><label for="position">Specification : </label></th>
                <td><textarea  name="specification"class="editor" id="specification"><?php echo $member->getDescription()?></textarea></td>
            </tr> 
            
            <tr>
            	<th scope="row"><label for="is_active">Is Active</label></th>
                <td><input type="checkbox" name="is_active" <?php if ($member->getStatus()) echo ' checked="checked"'?>/></td>
            </tr>
            
			<?php // if (strtolower($tname)=='management' or strtolower($tname)=='management team'): ; else:?>
            <?php if ($member->getImage()): ?>
            <tr>
            	<th scope="row"><label for="image">Image</label></th>
                <td><img src="<?php echo base_url()?>assets/upload/images/members/thumbs/<?php echo $member->getImage()?>" style="max-width: 400px;"/></td>
            </tr>
            <?php endif; ?>
            <tr>
            	<th scope="row"><label for="image">Upload Image</label></th>
                <td><input type="file" name="image" />&nbsp;&nbsp;<small>(176X140px resolution, previous image will be replaced)</small></td>
            </tr>
            
            
            <?php // endif;?>
            <tr>
            	<td colspan="2"><input type="submit" value="Save" class="button" /></td>
            </tr>
        </table>
    </form>
    <?php else:
		echo 'Member with this ID is not found.'; 
	endif;?>
    
    </div>
</div>

<script type="text/javascript">

$(function() {
	
	$('.editor').each(function(i){
		var id = $(this).attr('id');
		CKEDITOR.replace(id);
	});
	
	for(instance in CKEDITOR.instances) {
		CKEDITOR.instances[instance].on('blur',function(){
			this.updateElement();
		});
	}
	
	
})
;
</script>