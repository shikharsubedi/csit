<div class="section">
    <div class="response info">Please enter youtube video code properly.</div>
    <h4>Add a Video</h4>
    <div class="content">
        <?php
        if (isset($upload_error)) {
            echo $upload_error;
        }
        ?>
        <form name="add-album" method="post" enctype="multipart/form-data">
            <table width="100%" class="form-table">
                <tbody>

                    <tr valign="top">
                        <th width="11%" scope="row"><label for="title">Title <span class="asterisk">*</span></label></th>
                        <td width="56%"><input type="text" name="title" id="title" class="required regular-text" value="<?php echo $video->getTitle() ?>"/></td>
                    </tr>
                    <tr valign="top">
                        <th width="11%" scope="row"><label for="yCode">Youtube Video Code <span class="asterisk">*</span></label></th>
                        <td width="56%"><input type="text" name="yCode" id="yCode" class="required regular-text" value="<?php echo $video->getYlink() ?>" /></td>
                    </tr>
                    <tr valign='top' id="status">
                        <th scope="row"><label>Is Active? </label></th>
                        <td>
                            <input type="radio" name="isActive" id="isActive" value="1"  <?php if($video->getStatus()=='1'){ ?>checked="checked"<?php } ?>/>
                            Yes&nbsp;&nbsp;
                            <input type="radio" name="isActive" id="isActive" value="0" <?php if($video->getStatus()=='0'){ ?>checked="checked"<?php } ?>/>
                            No
                        </td>
                    </tr>

                    <tr>
                        <td>&nbsp;</td>
                        <td><input name="btn_submit" id="btn_submit" type="submit" value="Save" class="btn_save button"/></td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>
</div>
<!--<script>

    $('#add_subtopic').click(function () {
        $('#status').before('<tr valign="top"><th scope="row"><label >&nbsp;</label></th><td><input type="text" name="sub_title[]" id="sub_title" value="" class="required regular-text" placeholder="Title"/></td><td><input type="text" name="sub_value[]" id="sub_value" value="" class="required regular-text" placeholder="Value"/>&nbsp;<a class="rem_result"> - Remove</a></td></tr>');
    });

    $('.rem_result').live('click', function () {
        $(this).closest('tr').remove();
    });
</script>-->


<!--<script type="text/javascript">

    $(function () {
        $('input[name=type]').bind('change', function () {
            var val = $(this).val();
            if (val == 'yt_code') {
                $('#ytcode').show();
                $('#ycode').addClass('required');
                $('#yturl').hide();
                $('#yurl').removeClass('required');
            }
            if (val == 'yt_link') {
                $('#yturl').show();
                $('#yurl').addClass('required');
                $('#ytcode').hide();
                $('#ycode').removeClass('required');
            }
        });


    })


</script>-->

