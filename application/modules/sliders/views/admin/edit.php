<div class="response info" >Please use an image exactly <?php echo $slider->getGroup()->getWidth() . "px X " . $slider->getGroup()->getHeight() . "px"; ?> to fit in the front end.</div>
<div class="section">
    <h4>Edit Slider Image</h4>

    <div class="content">
        <form method="post" action="" name="frm_user" id="frm_user" enctype="multipart/form-data">
            <table width="500" border="0" class="form-table">
                <tr valign='top'>
                    <td width="150"><label>Image name <span class="asterisk">*</span> </label></td>
                    <td><input name="img_name" id="img_name" type="text"  value="<?php echo $slider->getName(); ?>"  autocomplete="off" class="regular-text required"/></td>
                </tr>

                <tr valign='top'>
                    <th scope="row"><label for="type">Link type </label></th>
                    <td>
                        <input type="radio" name="type" id="type-ext" value="external" checked="checked"/ />
                               External URL&nbsp;&nbsp;
                               <input type="radio" name="type" id="type-int" value="internal"<?php if ($slider->getLinkType() == 'internal') echo ' checked="checked"'; ?>/>
                        Internal Page
                    </td>
                </tr>
                <?php
                $display_url = '';
                if ($slider->getLinkType() == 'internal')
                    $display_url = ' style="display:none;"';
                ?>
                <tr valign='top' id="url-page"<?php echo $display_url; ?>>
                    <th scope="row"><label for="target_url">URL <span class="asterisk">*</span></label></th>
                    <td><input name="target_url" id="target_url" type="text"  value="<?php echo $slider->getURL(); ?>"  class="regular-text required" /></td>
                </tr>


                <?php
                $display_page = '';
                if ($slider->getLinkType() == 'external')
                    $display_page = ' style="display:none;"';
                ?>
                <tr valign="top" id="page-select"<?php echo $display_page; ?>>
                    <th scope="row"><label for="target_page">Page to link<span class="asterisk">*</span></label></th>
                    <td>
                        <select name="target_page" id="target_page" class="required">
                            <option value="0">None</option>
                            <?php
                            $selected = NULL;

                            if ($slider->getURL() == '#')
                                $selected = ($slider->getContent()) ? $slider->getContent()->id() : "";
                            echo contentSelectTree($selected);
                            ?>
                        </select><small> ( The subpages of this page will be displayed in our product section.) </small>
                    </td>
                </tr>

                <tr valign="top">
                    <th scope="row"><label for="first_content">Text 1</label></th>
                    <td><input name="first_content" id="img_name" type="text"  value="<?php echo $slider->getContent_a(); ?>"  class="regular-text"/></td>
                </tr>
                <?php /* ?>
                  <tr valign="top">
                  <th scope="row"><label for="second_content">Text 2</label></th>
                  <td><input name="second_content" id="img_name" type="text"  value="<?php echo $slider->getContent_b(); ?>"  class="regular-text"/></td>
                  </tr>
                  <tr valign="top">
                  <th scope="row"><label for="third_content">Text 3</label></th>
                  <td><input name="third_content" id="img_name" type="text"  value="<?php echo $slider->getContent_c(); ?>"  class="regular-text"/></td>
                  </tr>
                  <?php */ ?>
                <tr>
                <tr valign='top'>
                    <td><label>Image thumbnail</label></td>
                    <td>
                        <img src="<?php echo base_url() . "assets/upload/images/slider/" . $slider->getThumbnail(); ?>" />
                    </td>
                </tr>
                <tr valign='top'>
                    <td><label>Change File </label></td>
                    <td><input name="img_file" id="img_file" type="file"  value="<?php echo set_value('img_file'); ?>" autocomplete="off"/></td>
                </tr>

                <tr valign='top'>
                    <td><label>Open in new tab? </label></td>
                    <td>
                        <input type="radio" name="istab" value="Y" <?php if ($slider->getIsTab() == 'Y') { ?> checked="checked"<?php } ?> />
                        Yes&nbsp;&nbsp;
                        <input type="radio" name="istab" value="N" <?php if ($slider->getIsTab() == 'N' or $slider->getIsTab() == '') { ?> checked="checked"<?php } ?>  />
                        No
                    </td>
                </tr>

                <tr valign='top'>
                    <td><label>Is Active </label></td>
                    <td>
                        <input type="radio" name="isActive" id="isActive" value="<?php echo STATUS_ACTIVE ?>"  checked="checked"/>
                        Yes&nbsp;&nbsp;
                        <input type="radio" name="isActive" id="isActive" value="<?php echo STATUS_INACTIVE ?>" <?php if ($slider->getStatus() == STATUS_INACTIVE) echo " checked='checked'"; ?> />
                        No
                    </td>
                </tr>

                <tr>
                    <td>&nbsp;</td>
                    <td><input name="btn_submit" id="btn_submit" type="submit" value="Save" class="button"/></td>
                </tr>
            </table>
        </form>
    </div>
</div>
<script type="text/javascript">
    $(function () {
        $('input[name=type]').bind('change', function () {
            var val = $(this).val();

            if (val == 'external')
            {
                $('#url-page').show();
                $('#target_url').addClass('required');
                $('#page-select').hide();
                $('#target_page').removeClass('required');

            }
            if (val == 'internal')
            {
                $('#url-page').hide();
                $('#target_page').addClass('required');
                $('#page-select').show();
                $('#target_url').removeClass('required');
            }
        });
    })
</script>