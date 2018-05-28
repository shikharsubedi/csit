<div class="section">
    <h4>Add New Faculty</h4>
    <div class="content">
        <form name="add_form" method="post" enctype="multipart/form-data">
            <table width="100%" class="form-table">
                <tbody>

                    <tr valign='top'>
                        <th scope="row"><label for="name">Name <span class="asterisk">*</span> </label></th>
                        <td>
                            <input type="text" name="name" id="name" value="" class="required regular-text"/>
                        </td>
                    </tr>
                    
                    <tr valign='top'>
                        <th scope="row"><label for="email">Email </label></th>
                        <td>
                            <input type="email" name="email" id="email" value="" class="regular-text"/>
                        </td>
                    </tr>

                    <tr valign='top'>
                        <th scope="row"><label for="content">Content <span class="asterisk">*</span> </label></th>
                        <td>
                            <select name="content">
                                <option value="">none</option>
                                <?php if ($content): ?>
                                    <?php foreach ($content as $c) { ?>
                                        <option value="<?php echo $c->id() ?>"><?php echo $c->getTitle() ?></option>
                                    <?php } ?>
                                <?php endif; ?>
                            </select>
                        </td>
                    </tr>

                    <tr valign='top'>
                        <th scope="row"><label for="description">Description <span class="asterisk">*</span> </label></th>

                        <td>
                            <textarea  name="description"class="editor" id="description"></textarea>
                        </td>
                    </tr>


                    <tr valign='top'>
                        <th scope="row"><label>Is Active? </label></th>
                        <td>
                            <input type="radio" name="isActive" id="isActive" value="1"  checked="checked"/>
                            Yes&nbsp;&nbsp;
                            <input type="radio" name="isActive" id="isActive" value="0" />
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

<script type="text/javascript">

    $(function () {

        $('.editor').each(function (i) {
            var id = $(this).attr('id');
            CKEDITOR.replace(id);
        });

        for (instance in CKEDITOR.instances) {
            CKEDITOR.instances[instance].on('blur', function () {
                this.updateElement();
            });
        }


    })
            ;
</script>