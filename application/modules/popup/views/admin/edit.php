<div class="section">
  <h4>Edit Popup
  </h4>
  
<div class="content">
	<form method="post" action="" name="frm_edit_news" id="frm_edit_news" enctype="multipart/form-data">
        <table class="form-table">
            <tr valign="top">
                <th scope="row"><label for="content_title">Title <span class="asterisk">*</span> </label></th>
                <td><input name="content_title" id="content_title" type="text" size="100" value="<?php echo $popup->getTitle(); ?>"  autocomplete="off" class="regular-text required" /></td>
            </tr>
            
            <tr valign='top'>
                <th scope='row'><label>Published </label></th>
                <td>
                	<input type="radio" name="published" id="published-yes" value="Y" <?php if($popup->getStatus()=='active') echo'checked="checked"'; ?>/>
            		Yes&nbsp;&nbsp;
            		<input type="radio" name="published" id="published-no" value="N" <?php if($popup->getStatus()!='active') echo'checked="checked"'; ?>/>
            		No
                </td>
            </tr>
            
            <tr valign="top">
                <th scope="row"><label for="content_body">Content body<span class="asterisk">*</span> </label></th>
                <td><?php echo $ckeditor;?></td>
            </tr>
        </table>
        <p class="submit">
       
      <input type="submit" name="btn_submit" id="btn_submit" class="button-primary button" value="Save Content">
    </p>
    </form>
</div>
</div>