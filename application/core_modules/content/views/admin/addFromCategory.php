<div class="section">
    <h4>Add Content
    </h4>

    <div class="content"><form method="post" action="" name="frm_ad_news" id="frm_ad_news" enctype="multipart/form-data">
            <table class="form-table">
                <tr valign="top">
                    <th scope="row"><label for="content_title">Title <span class="asterisk">*</span> </label></th>
                    <td><input name="content_title" id="content_title" type="text" size="255" value="<?php echo set_value('content_title') ?>"  autocomplete="off" class="regular-text required" style="width:80%" /></td>
                </tr>

                <?php if (!$custom_type): ?>
                    <tr valign="top">
                        <th scope="row"><label for="content_type">Content Type</label></th>
                        <td><select name="content_type" id="content_type" class="required">
                                <option value="">-- SELECT --</option>
                                <option value="<?php echo content\models\Content::CONTENT_TYPE_ARTICLE; ?>" selected="">Article</option>
                                <option value="<?php echo content\models\Content::CONTENT_TYPE_PAGE ?>">Basic Page</option>
                            </select></td>
                    </tr>
                <?php endif; ?>
                
                <?php
                if (count($custom_fields) > 0) {
                    foreach ($custom_fields as $field) {
                        render_custom_field($field);
                    }
                }
                ?>

                <tr valign="top" id="category-list" style="">
                    <th scope="row" ><label for="select_category_id">Category</label></th>
                    <td>
                        <p style="height:25px;"><select name="select_category_id" id="select_category_id" disabled="">
                                <option value="0">--- SELECT ---</option>
                                <?php
                                echo categorySelectTree($categoryId);
                                ?>
                            </select></p>
                        <div class="article-category">
                            <span class="catNameHolder" id="licat_<?php echo $categoryId; ?>"><?php echo $selectedCategory->getName(); ?></span>
                            <input type="hidden" id="catval_<?php echo $categoryId; ?>" name="cat_id[]" value="<?php echo $categoryId; ?>" />
                        </div>
                        <div style="clear:both"></div>
                    </td>
                </tr>
                <tr valign="top" id="article-date-row" >
                    <th scope="row" ><label for="article_date">Date</label></th>
                    <td>
                        <input name="article_date" id="article_date" type="text" value="<?php echo set_value('article_date') ?>"  autocomplete="off"/>
                    </td>
                </tr>  

                <tr valign='top'>
                    <th scope="row"><label for="published">Published </label></th>
                    <td>
                        <input type="radio" name="published" id="published-yes" value=1  checked="checked"/>
                        Yes&nbsp;&nbsp;
                        <input type="radio" name="published" id="published-no" value=0 />
                        No
                    </td>
                </tr>


                <tr valign="top">
                    <th scope="row"><label for="content_body">Content body<span class="asterisk">*</span> </label></th>
                    <td><?php echo $ckeditor; ?></td>
                </tr>

                <tr valign="top">
                    <th scope="row"><label for="content_tags">Tags </label></th>
                    <td><input name="content_tags" id="content_tags" type="text" size="255" autocomplete="off" style="width:80%" /></td>
                </tr>

                <?php if ($alltags): ?>
                    <tr id="info-prompt">
                        <th scope="row"><label>&nbsp;</label></th>
                        <th scope="row"><label for="tags">OR select from existing tags shown below: </label></th>
                    </tr>				

                    <tr>
                        <th scope="row"><label>&nbsp;</label></th>
                        <td><div class="tag-category" id="append-tag"><?php
                                foreach ($alltags as $at) {
                                    echo '<span class="tagNameHolder add-tag" id="' . $at . '">' . $at . '<span class="addtag"></span></span>';
                                }
                                ?></div>
                        </td>
                    </tr>
                <?php endif; ?>            



            </table>
            <div id="tabs">&nbsp;</div>
            <p>&nbsp;</p>
            <p class="submit">
                <input type="hidden" name="btn_add_tab" id="btn_add_tab" class="button" value="Add Tab">&nbsp;&nbsp;&nbsp;
                <input type="submit" name="btn_submit" id="btn_submit" class="button" value="Save Content">
            </p>
        </form></div>
</div>
<!-- load f1 link plugin-->
<script type="text/javascript" src="<?php echo base_url() . 'assets/js/f1link.js' ?>"></script>
<script type="text/javascript">
    $(function () {

        $('#article_date').datepicker({'dateFormat': 'yy-mm-dd'});

<?php if (!$custom_type): ?>
            $('#select_category_id').bind('change', function () {
                var obj = $(this),
                        val = obj.val(),
                        text = obj.children("[value=" + val + "]").text(),
                        form = $('#frm_ad_news');

                var catHolder = $('.article-category');

                //check if this category was already added
                var count = catHolder.children('#licat_' + val).length;
                //if that category was not already added proceed else do nothing
                if (count == 0 && val != 0)
                {
                    var html = '<span class="catNameHolder" id="licat_' + val + '">' + text + '<span class="remcat"></span></span>';
                    catHolder.append(html);

                    //add to the hidden field stack
                    form.prepend('<input type="hidden" id="catval_' + val + '" name="cat_id[]" value="' + val + '" />');
                }
            });

            $('.remcat').live('click', function () {
                var toRemove = $(this).closest('.catNameHolder'),
                        val = toRemove.attr('id').split('_')[1];
                toRemove.hide(750).remove();

                console.log(val);

                //also remove it from the hidden input stack
                $("#catval_" + val).remove();
            });


            $("#content_type").change(function () {
                var value = $(this).val();

                switch (value) {
                    case "article":
                        $('#parent-page-list').fadeOut();
                        $('#category-list').fadeIn();
                        $('#article-date-row').fadeIn();
                        $('#article-date-row').find('input, select').addClass('required');
                        break;
                    default:
                        $('#category-list').fadeOut();
                        $('#category-list').find('input, select').removeClass('required');
                        $('#parent-page-list').fadeIn();
                        $('#article-date-row').fadeOut();
                        $('#article-date-row').find('input, select').removeClass('required');
                }
            });
<?php endif; ?>

<?php if ($alltags): ?>
            $('.add-tag').live('click', function () {
                var toAdd = $(this).closest('.tagNameHolder'),
                        tag = toAdd.attr('id'),
                        str = ($("#content_tags").val() == '') ? tag : $("#content_tags").val() + ', ' + tag;
                $("#content_tags").val(str);
                toAdd.hide(750).remove();
                child = $('#append-tag > span').length;
                if (child < 1)
                    $("#info-prompt").hide();
            });
<?php endif; ?>
    })
</script>