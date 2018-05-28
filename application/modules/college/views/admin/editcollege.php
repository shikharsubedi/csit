<div class="section">
    <h4>Edit College</h4>
    <div class="content">
        <form name="add_form" method="post" enctype="multipart/form-data">
            <table width="100%" class="form-table">
                <tbody>

                    <tr valign='top'>
                        <th scope="row"><label for="name">Name <span class="asterisk">*</span> </label></th>
                        <td>

                            <input type="text" name="name" id="name" value="<?php echo $college->getName() ?>" class="required regular-text"/>

                        </td>
                    </tr>
                    <tr valign='top'>
                        <th scope="row"><label for="university">University <span class="asterisk">*</span> </label></th>
                        <td>

                           <select name="university" class="">
                               <option value="">--Select--</option>
                               <?php 
                               foreach($university as $u){
                                ?>
                                <option value="<?php echo $u->id()?>" <?php if($u->id() == $college->getUniversity()->id()){ echo 'selected="selected"';}?>><?php echo $u->getName()?></option>
                                <?php
                               }
                               ?>
                           </select>

                        </td>
                    </tr>
                     <tr valign='top'>
                        <th scope="row"><label for="address">Address <span class="asterisk">*</span> </label></th>
                        <td>

                            <input type="text" name="address" id="address" value="<?php echo $college->getAddress() ?>" class=" regular-text"/>

                        </td>
                    </tr>

                    <tr valign='top'>
                        <th scope="row"><label for="url">Url <span class="asterisk">*</span> </label></th>
                        <td>

                            <input type="text" name="url" id="url" value="<?php echo $college->getUrl() ?>" class=" regular-text"/>

                        </td>
                    </tr>

                    <tr valign='top'>
                        <th scope="row"><label for="email">Email <span class="asterisk">*</span> </label></th>
                        <td>

                            <input type="text" name="email" id="email" value="<?php echo $college->getEmail() ?>" class=" regular-text"/>

                        </td>
                    </tr>
                    <tr valign='top'>
                        <th scope="row"><label for="contact">Contact <span class="asterisk">*</span> </label></th>
                        <td>

                            <input type="text" name="contact" id="contact" value="<?php echo $college->getContact() ?>" class=" regular-text"/>

                        </td>
                    </tr>
                    <tr valign='top'>
                        <th scope="row"><label for="description">Description <span class="asterisk">*</span> </label></th>
                        <td>

                           <?php echo $ckeditor; ?>

                        </td>
                    </tr>
                    <?php 
                    if($college->getImage() !=''){
                        ?>
                        <tr valign='top'>
                            <th scope="row"><label for="image">Image <span class="asterisk">*</span> </label></th>
                            <td>

                                <img src="<?php echo base_url().'assets/upload/college/'.$college->getImage()?>?>">

                            </td>
                        </tr>
                        <tr valign='top'>
                            <th scope="row"><label for="image">Change Image </label></th>
                            <td>

                               <input type="file" name="image" id="image"  class=" regular-text"/>

                            </td>
                        </tr>
                        <?php
                    }else{
                        ?>
                        <tr valign='top'>
                            <th scope="row"><label for="image">Image <span class="asterisk">*</span> </label></th>
                            <td>

                                <input type="file" name="image" id="image"  class=" regular-text"/>

                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                    
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

