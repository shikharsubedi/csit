<div class="section">
  <h4>Add Download Category
  </h4>
  
<div class="content"><form method="post" action="" name="frm_ad_news" id="frm_ad_news" enctype="multipart/form-data">
        <table class="form-table">
            <tr valign="top">
                <th scope="row"><label for="content_title">Name <span class="asterisk">*</span> </label></th>
                <td><input name="category_title" id="category_title" type="text" size="100" value="<?php echo set_value('category_title') ?>"  autocomplete="off" class="regular-text required" /></td>
            </tr>
        
            <tr valign='top'>
                <th scope="row"><label>Published </label></th>
                <td>
                	<input type="radio" name="published" id="published-yes" value="<?php echo STATUS_ACTIVE; ?>"  checked="checked"/>
            		Yes&nbsp;&nbsp;
            		<input type="radio" name="published" id="published-no" value="<?php echo STATUS_INACTIVE; ?>" />
            		No
                </td>
            </tr>
        </table>
        <p class="submit">
      <input type="submit" name="btn_submit" id="btn_submit" class="button-primary button" value="Save">
    </p>
    </form></div>
</div>
