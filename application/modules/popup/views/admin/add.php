<div class="section">
  <h4>Add Popup
  </h4>
  
<div class="content"><form method="post" action="" name="frm_ad_news" id="frm_ad_news" enctype="multipart/form-data">
        <table class="form-table">
            <tr valign="top">
                <th scope="row"><label for="content_title">Title <span class="asterisk">*</span> </label></th>
                <td><input name="content_title" id="content_title" type="text" size="100" value="<?php echo set_value('content_title') ?>"  class="regular-text required" /></td>
            </tr>
            
            <tr valign='top'>
                <th scope='row'><label>Published </label></th>
                <td>
                	<input type="radio" name="published" id="published-yes" value="Y"  checked="checked"/>
            		Yes&nbsp;&nbsp;
            		<input type="radio" name="published" id="published-no" value="N" />
            		No
                </td>
            </tr>
            
            <tr valign="top">
                <th scope="row"><label for="content_body">Popup body<span class="asterisk">*</span> </label></th>
                <td><?php echo $ckeditor;?></td>
            </tr>
        </table>
        <p class="submit">
      <input type="submit" name="btn_submit" id="btn_submit" class="button-primary button" value="Save Content">
    </p>
    </form></div>
</div>