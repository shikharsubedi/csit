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
                        <td width="56%"><input type="text" name="title" id="title" class="required regular-text" /></td>
                    </tr>
                    <tr valign="top">
                        <th width="11%" scope="row"><label for="yCode">Youtube Video Code <span class="asterisk">*</span></label></th>
                        <td width="56%"><input type="text" name="yCode" id="yCode" class="required regular-text" /></td>
                        <td><br/><small> Example-<br/> <i>Media URL:&nbsp;&nbsp;&nbsp;</i>www.youtube.com/v/<b><span class="asterisk">AkmAvG0bTh4</span></b> OR youtube.com/watch?v=<b><span class="asterisk">AkmAvG0bTh4</span></b><br/>
                                <i>Youtube Video CODE:</i></small>&nbsp;&nbsp;&nbsp;<b><span class="asterisk">AkmAvG0bTh4</span></b></small>
                        </td>
                    </tr>

<!--                    <tr valign='top'>
                        <th scope="row"><label for="type">URL Type <span class="asterisk">*</span> </label></th>
                        <td>

                            <input type="radio" name="type" value="yt_code" checked="checked">&nbsp; Youtube Code&nbsp;&nbsp;&nbsp;&nbsp;

                            <input type="radio" name="type" value="yt_link">&nbsp; Youtube Link&nbsp;&nbsp;&nbsp;&nbsp;

                        </td>
                    </tr>-->





<!--                    <tr valign="top" id="ytcode">
                        <th scope="row">
                            <label for="image">Video CODE <span class="asterisk">*</span></label><br/>
                        </th>
                        <td>
                            <input type="text" name="media_link" class=" regular-text" value=""  title="YouTube video code (ID)" id="ycode"/> <br/><small> Example-<br/> <i>Media URL:&nbsp;&nbsp;&nbsp;</i>www.youtube.com/v/<b><span class="asterisk">AkmAvG0bTh4</span></b> OR youtube.com/watch?v=<b><span class="asterisk">AkmAvG0bTh4</span></b><br/>
                                <i>Media CODE:</i></small>&nbsp;&nbsp;&nbsp;<b><span class="asterisk">AkmAvG0bTh4</span></b></small>
                        </td>
                    </tr>

                    <tr valign='top' id="yturl" style="display: none;">
                        <th scope="row"><label for="url">Youtube URL <span class="asterisk">*</span></label></th>
                        <td>

                            <input type="text" name="url"  value="<?php //echo set_value("url")      ?>" class=" regular-text" id="yurl"/>

                        </td>
                    </tr>-->



<!--                    <tr valign='top'>
                        <th scope="row"><label for="image">Image   </label></th>
                        <td>

                            <input type="file" name="image" id="image" value="<?php //echo set_value("image")      ?>" class=" regular-text"/>

                        </td>
                    </tr>-->

<!--                    <tr valign='top'>
                        <th scope="row"><label for="subtopic">Sub Topic<span class="asterisk">*</span> </label></th>
                        <td>

                            <input type="text" name="sub_title[]" id="sub_title" value="<?php //echo set_value("sub_title")      ?>" class="required regular-text" placeholder="Title"/></td>
                        <td width="33%">

                            <input type="text" name="sub_value[]" id="sub_value" value="<?php //echo set_value("sub_value")      ?>" class="required regular-text" placeholder="Value"/>

                            &nbsp; <a id="add_subtopic">+ More</a>

                        </td>
                    </tr>-->
                    <tr valign='top' id="status">
                        <th scope="row"><label>Is Active? </label></th>
                        <td>
                            <input type="radio" name="isActive" id="isActive" value="<?php echo STATUS_ACTIVE ?>"  checked="checked"/>
                            Yes&nbsp;&nbsp;
                            <input type="radio" name="isActive" id="isActive" value="<?php echo STATUS_INACTIVE ?>" />
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
<script>

    $('#add_subtopic').click(function () {
        $('#status').before('<tr valign="top"><th scope="row"><label >&nbsp;</label></th><td><input type="text" name="sub_title[]" id="sub_title" value="" class="required regular-text" placeholder="Title"/></td><td><input type="text" name="sub_value[]" id="sub_value" value="" class="required regular-text" placeholder="Value"/>&nbsp;<a class="rem_result"> - Remove</a></td></tr>');
    });

    $('.rem_result').live('click', function () {
        $(this).closest('tr').remove();
    });
</script>


<script type="text/javascript">

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


</script>

