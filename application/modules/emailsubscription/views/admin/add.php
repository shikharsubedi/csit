<div class="section">
    <h4>Add Email</h4>

    <div class="content">
        <form method="post" action="" name="frm_user" id="frm_user" enctype="multipart/form-data">
            <table width="500" border="0" class="form-table">
                <tr valign='top'>
                    <th scope="row"><label>Email <span class="asterisk">*</span> </label></th>
                    <td><input name="email" id="email" type="text"  value=""  class="regular-text required"/></td>
                </tr>
                <tr valign='top'>
                    <th scope="row"><label for="isActive">Is Active </label></th>
                    <td>
                        <input type="radio" name="status" id="isActive" value="<?php echo STATUS_ACTIVE ?>"  checked="checked"/>
                        Yes&nbsp;&nbsp;
                        <input type="radio" name="status" id="isActive" value="<?php echo STATUS_INACTIVE ?>" />
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