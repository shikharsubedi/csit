<div class="section">
  <h4>Edit Category</h4>
  <div class="content">
  	<form name="edit_cat" action="" method="post">
  <table class="form-table">
  	  <tr valign="top">
        <th scope="row"><label for="cat_name">Category name:</label></th>
        <td><input type="text" name="cat_name" id="cat_name" value="<?php echo $category->getTerm()->getName();?>" size="25" class="required"></td>
      </tr>
      
      <tr valign="top">
        <th scope="row"><label for="parent_cat">Parent category:</label></th>
        <td>
        	<select name="parent_cat" id="parent_cat">
            	<option value="0">None</option>
                <?php //foreach($categories->result() as $c){
					$_parent_id = NULL;
					if($parent = $category->getParent())
						$_parent_id = $parent->id();
					echo categorySelectTree($_parent_id);	
                //}?>
            </select>
        </td>
      </tr>
      <tr>
      	<td>&nbsp;</td>
        <td align="left"><input type="submit" value="Update Category" class="button"/></td>
      </tr>
  </table>
  </form>
 </div>
 </div>
