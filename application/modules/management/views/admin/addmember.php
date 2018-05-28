<div class="section">
	<h4>Add a new Team Member</h4>
    <div class="content">
    <form name="add-member" method="post" action="" enctype="multipart/form-data">
    	<table class="form-table">
        	<tr>
            	<th scope="row"><label for="name">Name : </label></th>
                <td><input type="text" name="name" class="required regular-text"></td>
            </tr>
            <tr>
            	<th scope="row"><label for="position">Position : </label></th>
                <td><input type="text" name="position" class="required regular-text"></td>
            </tr>
            <tr>
            	<th scope="row"><label for="experience">Experience : </label></th>
                <td><input type="text" name="experience" class="regular-text"></td>
            </tr>
             <tr>
            	<th scope="row"><label for="position">Specification : </label></th>
                <td><textarea class="editor" id="specification"  name="specification" ></textarea></td>
            </tr>
            
           
            
            <tr>
            	<th scope="row"><label for="is_active">Is Active</label></th>
                <td><input type="checkbox" name="is_active" ></td>
            </tr>
            
            <?php // if (strtolower($tname)=='management' or strtolower($tname)=='management team'): ; else:?>
			<tr>
            	<th scope="row"><label for="image">Image</label></th>
                <td><input type="file" name="image" >&nbsp;&nbsp;<small>(176X140px resolution)</small></td>
            </tr>
            <?php // endif;?>
            <tr>
            	<td colspan="2"><input type="submit" value="Add" class="button" /></td>
            </tr>
        </table>
    </form>
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