<!-- added facebook links-->
<div class="section tabs">
    <ul>
        <li><a href="#tabs-general">General</a></li>
		 <li><a href="#tabs-meta">Meta</a></li>
        <li><a href="#tabs-appearance">Settings</a></li>
        <?php /* <li><a href="#tabs-footer_links">Footer Links</a></li>* */ ?>


        <li><a href="#tabs-homepage">Homepage</a></li>


    </ul>
<!-- <h3><span class="ui-icon ui-icon-gear"></span>Site Configuration</h3>-->
    <div class="content" id="tabs-general">
        <form method="post" action="" name="frm_user" id="frm_user" enctype="multipart/form-data">
            <table class="form-table">
                <tr valign="top">
                    <th scope="row"><label for="admin_name">Site Name <span class="asterisk">*</span> </label></th>
                    <td><input name="admin_name" id="admin_name" type="text" size="50" value="<?php echo $_CONFIG['admin_name']; ?>"  autocomplete="off" class="regular-text required" /></td>
                </tr>

                <tr valign="top">
                    <th scope="row"><label for="slogan">Slogan<span class="asterisk">*</span> </label></th>
                    <td><input name="slogan" id="slogan" type="text" class="regular-text" value="<?php echo $_CONFIG['slogan']; ?>"  autocomplete="off" /></td>
                </tr>

                <tr valign="top">
                    <th scope="row"><label for="admin_email">Admin Email<span class="asterisk">*</span> </label></th>
                    <td><input name="admin_email" id="admin_email" type="text" value="<?php echo $_CONFIG['admin_email']; ?>"  autocomplete="off"  class="regular-text required"/></td>
                </tr>

                <tr valign="top">
                    <th scope="row"><label for="feedback_email">Feedback Email<span class="asterisk">*</span> </label></th>
                    <td><input name="feedback_email" id="feedback_email" type="text" value="<?php echo Options::get('feedback_email', $_CONFIG['admin_email']); ?>"  autocomplete="off"  class="regular-text required"/></td>
                </tr>


                <tr valign="top">
                    <th scope="row"><label for="toll_free_no">Contact Number<span class="asterisk">*</span> </label></th>
                    <td><input name="toll_free_no" id="toll_free_no" type="text" value="<?php echo Options::get('toll_free_no', 'Not Available'); ?>"  autocomplete="off"  class="regular-text required"/></td>
                </tr>


                <tr valign="top">
                    <th scope="row"><label for="logo">Logo</label></th>
                    <td><img src="<?php echo base_url() . "assets/upload/images/config/" . Options::get('brand_image') ?>" /></td>
                </tr>

                <tr valign="top">
                    <th scope="row"><label for="logo">Change Logo</label></th>
                    <td><input name="logo" id="logo" type="file" class="regular-text"/></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label for="footer_slogan">Footer Slogan<span class="asterisk">*</span></label></th>
                    <td><textarea name="footer_slogan" id="footer_slogan"  class="regular-text" cols="80" rows="10"><?php echo Options::get('footer_slogan', 'Not Available'); ?></textarea></td>
                </tr>


                <tr valign="top">
                    <th scope="row"><label for="contact_details">Contact Details</label></th>
                    <td><textarea class="editor" id="contact_details" name="contact_details"><?php echo Options::get('contact_details', 'Not Available'); ?></textarea></td>
                </tr>
            </table>
            <p class="submit">
                <input type="submit" name="btn_submit_siteconfig" id="btn_submit_siteconfig" class="button" value="Save Settings">
            </p>
        </form>
    </div>

	<div class="content" id="tabs-meta">
        <form method="post" action="" name="frm_web_settings" id="frm_web_settings" enctype="multipart/form-data">
            <table class="form-table">
            	
                <tr valign="top">
                    <th scope="row"><label for="meta_title">Meta Title</label></th>
                    <td>
                        <input name="meta_title" id="meta_title" type="text" size="28" value="<?php echo Options::get('meta_title') ?>" autocomplete="off" />
                       
                    </td>
                </tr>
                     
                <tr valign="top">
                    <th scope="row"><label for="meta_description">Meta Description </label></th>
                    <td>
                        <textarea name="meta_description" id="meta_description" rows="5" cols="100" ><?php echo Options::get('meta_description') ?></textarea><br />
                      	<small>A single sentence for the HTML header is needed.</small>
                    </td>
                </tr>
                
                <tr valign="top">
                    <th scope="row"><label for="meta_keyword">Meta Keyword</label></th>
                    <td>
                        <textarea name="meta_keyword" id="meta_keyword" rows="5" cols="100" ><?php echo Options::get('meta_keyword') ?></textarea><br />
                    	<small>Keywords for HTML header, separated by commas.</small>
                    </td>
                </tr>
                  
            </table>
            <p class="submit">
            	<input type="submit" name="btn_submit_meta" id="btn_submit_meta" class="button" value="Save Settings">
            </p>
        </form>
    </div>

    <div class="content" id="tabs-appearance">
        <form method="post" action="" name="frm_web_settings" id="frm_web_settings" enctype="multipart/form-data">
            <table class="form-table">

                <tr valign="top">
                    <th scope="row"><label for="googleplus_id">Google Plus ID : <span class="asterisk">*</span></label></th>
                    <td><input name="googleplus_id" id="googleplus_id" type="text" value="<?php echo Options::get('googleplus_id', NULL) ?>" autocomplete="off" class="required" />
<!--                        <small> ( Required to fetch the stock data from Nepal Share Market.) </small>-->
                    </td>
                </tr>

                <tr valign="top">
                    <th scope="row"><label for="facebook_id">Facebook ID : <span class="asterisk">*</span></label></th>
                    <td><input name="facebook_id" id="facebook_id" class="required" type="text" value="<?php echo Options::get('facebook_id', 100); ?>"  autocomplete="off" /></td>
                </tr>

                <tr valign="top">
                    <th scope="row"><label for="twitter_id">Twitter ID : <span class="asterisk">*</span></label></th>
                    <td><input name="twitter_id" id="twitter_id" type="text" value="<?php echo Options::get('twitter_id', 200000000); ?>"  autocomplete="off"  class="required"/></td>
                </tr>

                <tr valign="top">
                    <th scope="row"><label for="linkedIn_id : ">LinkedIn ID :</label></th>
                    <td><input name="linkedIn_id" id="linkedIn_id" type="text" size="28" value="<?php echo Options::get('linkedIn_id') ?>" autocomplete="off" />

                    </td>
                </tr>


            </table>
            <p class="submit">
                <input type="submit" name="btn_submit_content" id="btn_submit_content" class="button" value="Save Settings">
            </p>
        </form>
    </div> <!--#tabs-appearance -->



    <div id="tabs-homepage">
        <form method="post" action="" name="frm_sec_settings" id="frm_sec_settings" enctype="multipart/form-data">
            <table class="form-table">
                
                <tr valign="top">
                    <th scope="row"><label for="mid-first">Mid Block First<span class="asterisk">*</span></label></th>
                    <td>
                        <select name="mid-first" id="mid-first" class="required">
                            <option value="0">None</option>
                            <?php
                            echo pageSelectTree(Options::get('mid-first', NULL));
                            ?>
                        </select><small> ( This page will be shown on Home Page at Mid Block First.) </small>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label for="mid-second">Mid Block Second<span class="asterisk">*</span></label></th>
                    <td>
                        <select name="mid-second" id="mid-second" class="required">
                            <option value="0">None</option>
                            <?php
                            echo pageSelectTree(Options::get('mid-second', NULL));
                            ?>
                        </select><small> ( This page will be shown on Home Page at Mid Block Second.) </small>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label for="mid-third">Mid Block Third<span class="asterisk">*</span></label></th>
                    <td>
                        <select name="mid-third" id="mid-third" class="required">
                            <option value="0">None</option>
                            <?php
                            echo pageSelectTree(Options::get('mid-third', NULL));
                            ?>
                        </select><small> ( This page will be shown on Home Page at Mid Block Third.) </small>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label for="footer-content">Footer Content<span class="asterisk">*</span></label></th>
                    <td>
                        <select name="footer-content" id="footer-content" class="required">
                            <option value="0">None</option>
                            <?php
                            echo pageSelectTree(Options::get('footer-content', NULL));
                            ?>
                        </select><small> ( This content will be shown on footer of Home Page.) </small>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label for="home-category-first">Home Page Category First<span class="asterisk">*</span></label></th>
                    <td>
                        <select name="home-category-first" id="home-category-first" class="required">
                            <option value="0">None</option>
                            <?php
                            echo categorySelectTree(Options::get('home-category-first', NULL));
                            ?>
                        </select><small> ( This category will be shown on Home Page.) </small>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label for="home-category">Home Page Category Secong<span class="asterisk">*</span></label></th>
                    <td>
                        <select name="home-category" id="home-category" class="required">
                            <option value="0">None</option>
                            <?php
                            echo categorySelectTree(Options::get('home-category', NULL));
                            ?>
                        </select><small> ( This category will be shown on Home Page.) </small>
                    </td>
                </tr>
            </table>
            <p>&nbsp;</p>
            <p class="submit">
                <input type="submit" name="btn_submit_homepage" id="btn_submit_homepage" class="button" value="Save Settings">
            </p>
        </form>
    </div>

</div> <!-- .section tabs -->
<script type="text/javascript">

    $(function () {
        // var bottom_count = <?php // echo $bottom_count;              ?>;
        $('.editor').each(function (i) {
            var id = $(this).attr('id');
            CKEDITOR.replace(id);
        });

        for (instance in CKEDITOR.instances) {
            CKEDITOR.instances[instance].on('blur', function () {
                this.updateElement();
            });
        }


        $('input[name|="type"]').live('change', function () {
            var val = $(this).val();
            if (val == 'external')
            {
                $(this).parents('table').find('.url-page').show();
                $(this).parents('table').find('.target_url').addClass('required');
                $(this).parents('table').find('.page-select').hide();
                $(this).parents('table').find('.target_page').removeClass('required');

            }
            if (val == 'internal')
            {
                $(this).parents('table').find('.url-page').hide();
                $(this).parents('table').find('.target_page').addClass('required');
                $(this).parents('table').find('.page-select').show();
                $(this).parents('table').find('.target_url').removeClass('required');
            }
        });

        $('.remove_bottom_link').live('click', function () {
            $(this).parents('table').hide('slow', function () {
                $(this).remove();
            });
        });
    })



    $(function () {
        $('form#frm_rate_settings').validate();//{ rules : {	'plan_name[]' : 'required','plan_rate[]' : 'required'}}
        $.validator.addClassRules("interestRates", {required: true});
    })
    $(function () {

        $('.editor').each(function (i) {
            var id = $(this).attr('id');
            CKEDITOR.replace(id, {toolbar: "F1soft"});
        });

        for (instance in CKEDITOR.instances) {
            CKEDITOR.instances[instance].on('blur', function () {
                this.updateElement();
            });
        }

        $.validator.addMethod('IPchecker', function (value) {
            var allowed_ip = "^(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$";
            return value.match(allowed_ip);
        }, 'Invalid IP address');

        $('#frm_sec_settings').validate({
            rules: {
                allowed_ip: {IPchecker: true}
            }
        });

        $('#enforced').click(function () {
            if ($(this).attr('checked'))
                $('#allowed_ip').addClass('required');
            else {
                $("#allowed_ip").rules("remove");
                $('#allowed_ip').removeClass('required');
            }
        })

    });
</script>
