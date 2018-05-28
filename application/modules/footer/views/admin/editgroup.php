<div class="section">
	<h4>Add Footer Group</h4>
    <div class="content">
    	<form name="add_group" id="add_group" method="post" action="">
        	<table class="form-table">
            	<tr>
                	<th scope="row"><label for="group_name">Name : </label></th>
                    <td><input type="text" name="group_name" value="<?php echo $group->getName();?>" id="group_name" class="regular-text required"></td>
                </tr>
			<tr valign='top'>
                <th scope="row"><label for="type">Is Active? </label></th>
                <td>
            		<input type="checkbox" name="is_active" <?php if ($group->getStatus()) echo ' checked="checked"'?>/>
                </td>
            </tr>
                <tr>
                	<td colspan="2"><input type="submit" value="Save" class="button" /></td>
                </tr>
            </table>
        </form>
    </div>
    </div>