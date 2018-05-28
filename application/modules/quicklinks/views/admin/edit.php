<?php 
//// if ($quicklinks->getLink() == NULL)
//                                $selected = $quicklinks->getContent()->id();
//                            \Doctrine\Common\Util\Debug::dump($selected); exit; ?>
<div class="section">
    <h4>Edit quicklink</h4>

    <div class="content">
        <form method="post" action="" name="Quicklinks" id="Quicklinks" enctype="multipart/form-data">
            <table width="500" border="0" class="form-table">
                <tr valign='top'>
                    <th scope="row"><label>Link Label <span class="asterisk">*</span> </label></th>
                    <td><input name="link_label" id="link_label" type="text"  value="<?php echo $quicklinks->getTitle(); ?>"  class="regular-text required"/></td>
                </tr>

                <tr valign='top'>
                    <th scope="row"><label for="type">Link type </label></th>
                    <td>
                        <input type="radio" name="type" id="type-ext" value="external" checked="checked"/ />
                               External URL&nbsp;&nbsp;
                               <input type="radio" name="type" id="type-int" value="internal"<?php if ($quicklinks->getType() == 'internal') echo ' checked="checked"'; ?>/>
                        Internal Page
                    </td>
                </tr>
                <?php
                $display_url = '';
                if ($quicklinks->getType() == 'internal')
                    $display_url = ' style="display:none;"';
//                ?>
                <tr valign='top' id="url-page"<?php echo $display_url; ?>>
                    <th scope="row"><label for="target_url">URL <span class="asterisk">*</span></label></th>
                    <td><input name="target_url" id="target_url" type="text"  value="<?php echo $quicklinks->getLink(); ?>"  class="regular-text required" /></td>
                </tr>


                <?php
                $display_page = '';
                if ($quicklinks->getType() == 'external')
                    $display_page = ' style="display:none;"';
                ?>
                <tr valign="top" id="page-select"<?php echo $display_page; ?>>
                    <th scope="row"><label for="target_page">Page to link<span class="asterisk">*</span></label></th>
                    <td>
                        <select name="target_page" id="target_page" class="required">
                            <option value="0">None</option>
                            <?php
                            $selected = NULL;

                            if ($quicklinks->getLink() == NULL)
                                $selected = $quicklinks->getContent()->id();
                            echo contentSelectTree($selected);
                            ?>
                        </select><small> ( The subpages of this page will be displayed in our product section.) </small>
                    </td>
                </tr>


                <tr valign='top'>
                    <th scope="row"><label for="isActive">Is Active </label></th>
                    <td>
                        <input type="radio" name="isActive" id="isActive" value="<?php echo STATUS_ACTIVE ?>" <?php if(($quicklinks->getStatus()) == STATUS_ACTIVE) echo "checked"; ?>/>
                        Yes&nbsp;&nbsp;
                        <input type="radio" name="isActive" id="isActive" value="<?php echo STATUS_INACTIVE ?>" <?php if(($quicklinks->getStatus()) != STATUS_ACTIVE) echo "checked"; ?>/>
                            
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