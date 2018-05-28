<div class="section">
    <h4>Edit Testimonial</h4>

    <div class="content">
        <form method="post" action="" name="frm_user" id="frm_user" enctype="multipart/form-data">
            <table width="500" border="0" class="form-table">
                <tr valign='top'>
                    <td width="150"><label>Name<span class="asterisk">*</span> </label></td>
                    <td><input name="name" id="name" type="text"  value="<?php echo $testimonial->getName(); ?>"  class="regular-text required"/></td>
                </tr>

                <tr valign='top'>
                    <td width="150"><label>Message<span class="asterisk">*</span></label></td>
                    <td><textarea name="message" class="required" rows="5" cols="40"><?php echo $testimonial->getBody(); ?></textarea></td>
                </tr>
                
                <tr>
                    <th scope="row"><label for="image">Image</label></th>
                    <td><img src="<?php echo base_url().'assets/upload/images/testimonial/thumbs/'.$testimonial->getImage(); ?>"><input type="file" name="image" >&nbsp;&nbsp;<small>(176X140px resolution)</small></td>
                </tr>

                <tr valign='top'>
                    <td><label>Is Active </label></td>
                    <td>
                        <input type="radio" name="isActive" id="isActive" value="<?php echo '1' ?>" <?php if ($testimonial->getStatus() == '1') { ?> checked="checked" <?php } ?> />
                        Yes&nbsp;&nbsp;
                        <input type="radio" name="isActive" id="isActive" value="<?php echo '0' ?>" <?php if ($testimonial->getStatus() == '0') { ?> checked="checked" <?php } ?>/>
                        No
                    </td>
                </tr>

                <tr valign='top'>
                    <td><label>Show At Front </label></td>
                    <td>
                        <input type="radio" name="showFront" id="isActive" value="<?php echo '1' ?>" <?php if ($testimonial->getShowfront() == '1') { ?> checked="checked" <?php } ?>  />
                        Yes&nbsp;&nbsp;
                        <input type="radio" name="showFront" id="isActive" value="<?php echo '0' ?>" <?php if ($testimonial->getShowfront() == '0') { ?> checked="checked" <?php } ?> />
                        No
                    </td>
                </tr>



                <tr>
                    <td>&nbsp;</td>
                    <td><input name="btn_submit" id="btn_submit" type="submit" value="save" class="button"/></td>
                </tr>
            </table>
        </form>
    </div>
</div>