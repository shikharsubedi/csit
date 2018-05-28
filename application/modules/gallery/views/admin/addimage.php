<div class="section">
	<h4>Add an Image [<?php echo $albumname ?>]</h4>
    <div class="content">
    <form name="add-album" method="post" enctype="multipart/form-data">
    	<table width="100%" class="form-table">
        	<tbody>
                
                <tr valign="top">
                	<th scope="row">
                    	<label for="image">Images <span class="asterisk">*</span></label><br/>
                        <span><a href="javascript:;" id="more-img">Add more</a></span>
                    </th>
                    <td id="more-file">
                    	<input type="file" name="image[]" class=" regular-text" />
                        <input type="file" name="image[]" class=" regular-text" />
                        <input type="file" name="image[]" class=" regular-text" />
                        <input type="file" name="image[]" class=" regular-text" />
                        <input type="file" name="image[]" class=" regular-text" />
                        <input type="file" name="image[]" class=" regular-text" />
                    </td>
                </tr>
                
                <tr>
                    <td>&nbsp;</td>
                    <td><input name="btn_submit" id="btn_submit" type="submit" value="Save" class="button"/></td>
                </tr>
            </tbody>
        </table>
        </form>
    </div>
</div>
<script>
$(function () {
	$('#more-img').bind('click',function() {
		$('#more-file').append('<input type="file" name="image[]" class=" regular-text"/>&nbsp;');
	});
});

</script>