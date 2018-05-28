<div class="section">
    <h4>Add New Faqs</h4>
    <div class="content">
        <form name="add_form" method="post" enctype="multipart/form-data">
            <table width="100%" class="form-table">
                <tbody>
                    <?php
                    if (!$failed) {
                        ?>
                        <tr valign="top">
                            <th scope="row"><label for="question">Question <span class="asterisk">*</span> </label></th>
                            <td>
                                <input type="text" name="question[]" id="question" value="<?php echo set_value("question[]") ?>" class="required regular-text"/>
                            </td>
                        </tr>
                        <tr valign="top">
                            <th scope="row"><label for="answer">Answer <span class="asterisk">*</span> </label></th>
                            <td>
                                <textarea name="answer[]" id="hasEditor_0" class="required regular-text"><?php echo set_value("answer[]") ?></textarea>
                            </td>
                        </tr>
                        <tr valign='top'>
                            <th scope="row"><label>Is Active? </label></th>
                            <td>
                                <input type="radio" name="isActive" id="isActive" value="1"  checked="checked" />
                                Yes&nbsp;&nbsp;
                                <input type="radio" name="isActive" id="isActive" value="0"/>
                                No
                            </td>
                        </tr>
                        <?php
                    } else {
                        foreach ($questions as $key => $value) {
                            ?>
                            <tr valign="top">
                                <td colspan="2"><hr/></td>
                            </tr>
                            <tr valign="top">
                                <th scope="row"><label for="question">Question <span class="asterisk">*</span> </label></th>
                                <td>
                                    <input type="text" name="question[<?php echo $key; ?>]" id="question" value="<?php echo $value ?>" class="required regular-text"/>
                                </td>
                            </tr>
                            <tr valign="top">
                                <th scope="row"><label for="answer">Answer <span class="asterisk">*</span> </label></th>
                                <td>
                                    <textarea name="answer[<?php echo $key; ?>]" id="hasEditor_<?php echo $key; ?>" class="required  regular-text"><?php echo $answers[$key] ?></textarea>


                                </td>
                            </tr>                            
                            <?php
                        }
                    }
                    ?>

                    <tr id="before">
                        <th>&nbsp;</th>
                        <td>
                            <input name="btn_submit" id="btn_submit" type="submit" value="Save" class="btn_save button"/>
                            <input id="btn_more" type="button" value="Add More FAQs" class="button"/>
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>
</div>




<script type='text/javascript' src='<?php echo base_url() ?>assets/js/ckeditor/ckeditor.js'></script>
<script>




    CKEDITOR.config.width = 771;
    CKEDITOR.config.height = 300;
    CKEDITOR.config.toolbar = 'F1soft';
<?php
if (!$answers) {
    ?>
        el = document.getElementById('hasEditor_0');
        editor = CKEDITOR.replace(el);
    <?php
    $GLOBALS["id"] = 1;
    ?>

    <?php
} else {
    foreach ($answers as $key => $value) {
        $GLOBALS["id"] = $key;
        ?>
            el = document.getElementById('hasEditor_<?php echo $GLOBALS["id"]; ?>');
            editor = CKEDITOR.replace(el);

        <?php
    }
    ?>

    <?php
}
?>

    var inc = <?php echo $GLOBALS["id"]; ?> + 1;



//    displays more faq views when clicked "Add More FAQs" button.
//    "btn_more" is the id of the button.
//    "before" is the id of "tr" 
    $(function () {


        $('#btn_more').click(function () {
            $('#before').before('<tr valign="top"><td colspan="2"><hr/></td></tr><tr valign="top"><th scope="row"><label for="question">Question <span class="asterisk">*</span> </label></th><td><input type="text" name="question[]" id="question" value="" class="required regular-text"></td></tr><tr valign="top"><th scope="row"><label for="answer">Answer <span class="asterisk">*</span> </label></th><td><textarea name="answer[]" id="hasEditor_' + inc + '" class="required  regular-text"></textarea></tr>');
            var el = document.getElementById('hasEditor_' + inc);
            if (el)
                editor = CKEDITOR.replace(el);
            inc++;
        });



    });

</script>
