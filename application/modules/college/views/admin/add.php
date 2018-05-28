<div class="section">
    <h4>Add New University</h4>
    <div class="content">
        <form name="add_form" method="post" enctype="multipart/form-data">
            <table width="100%" class="form-table">
                <tbody>

                    <tr valign='top'>
                        <th scope="row"><label for="name">Name <span class="asterisk">*</span> </label></th>
                        <td>

                            <input type="text" name="name" id="name" value="<?php echo set_value("name") ?>" class="required regular-text"/>

                        </td>
                    </tr>


                    <tr valign='top'>
                        <th scope="row"><label>Is Active? </label></th>
                        <td>
                            <input type="radio" name="status" id="status" value="1"  checked="checked"/>
                            Yes&nbsp;&nbsp;
                            <input type="radio" name="status" id="status" value="0" />
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

