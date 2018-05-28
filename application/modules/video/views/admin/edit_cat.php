<div class="section">
    <h4>Edit Video Category</h4>

    <div class="content">
        <form name="add_form" method="post" enctype="multipart/form-data">
            <table width="100%" class="form-table">
                <tbody>

                    <tr valign='top'>
                        <th scope="row"><label for="title">Title </label></th>
                        <td>

                            <input type="text" name="title" id="title" value="<?php echo $cat->getTitle(); ?>" class="regular-text"/>

                        </td>
                    </tr>


                    <tr valign='top'>
                        <th scope="row"><label>Is Active? </label></th>
                        <td>
                            <input type="radio" name="isActive" id="isActive" value="active"  <?php if($cat->getStatus()==1){?>checked="checked" <?php } ?>/>
                            Yes&nbsp;&nbsp;
                            <input type="radio" name="isActive" id="isActive" value="inactive" <?php if($cat->getStatus()==0){?>checked="checked" <?php } ?>/>
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

