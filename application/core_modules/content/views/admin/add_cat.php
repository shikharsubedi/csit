<div class="section">
	<h4>Add a Category</h4>
    <div class="content">
    	<form name="add_cat" action="" method="post">
            <table class="form-table" width="100%" cellpadding="5">
              <tr valign="top">
                <th><label for="cat_name">Category Name: <span class="asterisk">*</span></label></th>
                <td><input type="text" name="cat_name" id="cat_name" value="<?php echo set_value('cat_name');?>" size="25" class="required"></td>
              </tr>
              <tr valign="top">
                <th><label for="parent_cat">Parent category:</label></th>
                <td><select name="parent_cat" id="parent_cat">
                    <option value="0">None</option>
                   <?php
					$_parent_id = NULL;
					if($parent = set_value('parent_cat'))
						$_parent_id = $parent;
					echo categorySelectTree($_parent_id);	
                ?>
                  </select></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td align="left"><input type="submit" value="Add Category" class="button"/></td>
              </tr>
            </table>
          </form>
    </div>
</div>