<div class="section">
    <h4>Edit Slider Image</h4>

    <div class="content">
    <form method="post" action="" name="frm_user" id="frm_user" enctype="multipart/form-data">
        <table width="500" border="0" class="form-table">
            <tr valign='top'>
                <td width="150"><label>Image name <span class="asterisk">*</span> </label></td>
                <td><input name="img_name" id="img_name" type="text"  value="<?php echo $slider->getName(); ?>"  autocomplete="off" class="regular-text required"/></td>
            </tr>
            
             
            <tr valign='top'>
            	<td><label>Image thumbnail</label></td>
                <td>
                	<img src="<?php echo base_url()."assets/upload/images/slider/".$slider->getThumbnail();?>" />
                </td>
            </tr>
            <tr valign='top'>
                <td><label>Change Image </label></td>
                <td><input name="img_file" id="img_file" type="file"  value="<?php echo set_value('img_file'); ?>" autocomplete="off"/></td>
            </tr>
           
             <tr valign='top'>
                    <th scope="row"><label for="type">Link type </label></th>
                    <td>
                        <input type="radio" name="type" id="type-ext" value="external" checked="checked"/ />
                               External URL&nbsp;&nbsp;
                               <input type="radio" name="type" id="type-int" value="internal"<?php if ($slider->getType() == 'internal') echo ' checked="checked"'; ?>/>
                        Internal Page
                    </td>
                </tr>
            <?php 
                        $url = $slider->getLink();
                       
                        if ($slider->getType() == 'internal') {

                            $page = $this->doctrine->em->find('content\models\Content', $url);

                            // if (!$page) {
                            //     $url = '#';
                            // } else {
                            //     $url = site_url('content/' . $page->getSlug());
                            //     unset($page);
                            // }
                            ?>
                            <tr valign="top" id="page-select">
                                <th scope="row"><label for="target_page">Page to link <span class="asterisk">*</span></label></th>
                                <td>
                                    <select name="target_page" id="target_page" class="required">
                                        <option value="0">None</option>
                                        <?php
                                        echo pageSelectTree($page->id());
                                        ?>
                                    </select>
                                </td>
                            </tr>
                    <?php
                        } else{?>
                         <tr valign="top" id="page-select" style="display:none;">
                    <th scope="row"><label for="target_page">Page to link <span class="asterisk">*</span></label></th>
                    <td>
                        <select name="target_page" id="target_page" class="required">
                            <option value="0">None</option>
                            <?php
                            echo newsSelectTree();
                            ?>
                        </select>
                    </td>
                </tr>

                        <?php

                            }

                        if($slider->getType() == 'external'){
                            ?>
                                <tr valign='top' id="url-page">
                                    <th scope="row"><label for="target_url">Url<span class="asterisk"></span> </label></th>
                                    <td>
                                    
                                        <input type="text" name="target_url" id="target_url" value="<?php echo $url ?>" class=" regular-text"/>
                                    </td>
                                </tr>
                            <?php
                        }else{?>
                           <tr valign='top' id="url-page" style="display:none;">
                    <th scope="row"><label for="target_url">URL</label></th>
                    <td><input name="target_url" id="target_url" type="text"  value="<?php echo set_value('target_url'); ?>"  class="regular-text " /></td>
                </tr>


                     <?php   }
                    ?>
            
            <tr valign='top'>
                <td><label>Is Active </label></td>
                <td>
                	<input type="radio" name="isActive" id="isActive" value="<?php echo STATUS_ACTIVE?>"  checked="checked"/>
            		Yes&nbsp;&nbsp;
            		<input type="radio" name="isActive" id="isActive" value="<?php echo STATUS_INACTIVE?>" <?php if($slider->getStatus() == STATUS_INACTIVE) echo " checked='checked'";?> />
            		No
                </td>
            </tr>
            
            <tr>
                <td>&nbsp;</td>
                <td><input name="btn_submit" id="btn_submit" type="submit" value="Save" class="button"/></td>
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