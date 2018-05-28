<div class="section">
    <h4>Edit Faqs</h4>
    <div class="content">
        <form name="add_form" method="post" enctype="multipart/form-data">
            <table width="100%" class="form-table">
                <tbody>

                    <tr valign='top' >
                        <th scope="row"><label for="question">Question <span class="asterisk">*</span> </label></th>
                        <td>


                            <input type="text" name="question" id="question" value="<?php echo $faqs->getQuestion() ?>" class="required regular-text"/>

                        </td>
                    </tr>

                <script type='text/javascript' src='<?php echo base_url() ?>/assets/js/ckeditor/ckeditor.js'></script>
                <script>CKEDITOR.config.width = 771;
                    CKEDITOR.config.height = 300;
                    CKEDITOR.config.toolbar = 'F1soft';</script> 
                <tr valign='top' >
                    <th scope="row"><label for="answer">Answer <span class="asterisk">*</span> </label></th>
                    <td>


                        <textarea name="answer" id="hasEditor_1" class="required  regular-text"><?php echo $faqs->getAnswer() ?></textarea>
                        <script>ck = document.getElementById('hasEditor_1');
                            editor = CKEDITOR.replace(ck);</script>


                    </td>
                </tr>


                <tr valign='top'>
                    <th scope="row"><label>Is Active? </label></th>
                    <td>
                        <input type="radio" name="isActive" id="isActive" value="1"  <?php if ($faqs->getStatus() == '1') { ?>checked="checked" <?php } ?>/>
                        Yes&nbsp;&nbsp;
                        <input type="radio" name="isActive" id="isActive" value="0" <?php if ($faqs->getStatus() == '0') { ?>checked="checked" <?php } ?>/>
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
    $(function () {
        $('.trafterthis').after('<tr valign="top"><th scope="row"><label>Change ' + $(".trafterthis").attr("filelabel") + '</label></th><td><input type="file" name="' + $(".trafterthis").attr("filename") + '" class="regular-text"/></td></tr>');
    })
</script>
