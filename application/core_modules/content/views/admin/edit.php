<div class="section">
    <h4>Edit content
    </h4>

    <div class="content">
        <form method="post" action="" name="frm_edit_news" id="frm_edit_news" enctype="multipart/form-data">
            <?php
            //show_pre(get_defined_vars()); exit;
            if ($content->getType() == \content\models\Content::CONTENT_TYPE_ARTICLE) {
                foreach ($categories as $k => $v) {
                    echo '<input type="hidden" id="catval_' . $k . '" name="cat_id[]" value="' . $k . '" />';
                }
            }
            ?>

            <table class="form-table">
                <tr valign="top">
                    <th scope="row"><label for="content_title">Title <span class="asterisk">*</span> </label></th>
                    <td><input name="content_title" id="content_title" type="text" size="100" value="<?php echo $content->getTitle(); ?>"  autocomplete="off" class="regular-text required" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label for="content_image">Image <span class="asterisk">*</span> </label></th>
                    <td><input name="content_image" id="content_image" type="file" size="255" value=""  autocomplete="off" style="width:80%" /></td>
                </tr>
                <tr>current Image:
                    <?php if($content->getImage()!=''): ?>
                    <td><img src="<?php echo base_url().'assets/upload/images/content/'.$content->getImage(); ?>" width="200"></td>
                    <?php endif; ?>
                </tr>
                <?php
                if ($content->getType() == \content\models\Content::CONTENT_TYPE_ARTICLE) {
                    ?>
                    <tr valign="top">
                        <th scope="row"><label for="select_category_id">Category</label></th>
                        <td>
                            <p style="height:25px;"><select name="select_category_id" id="select_category_id">
                                    <option value="0">--- SELECT ---</option>
                                    <?php
                                    echo categorySelectTree();
                                    ?>
                                </select><small> ( you can add multiple categories ) </small></p>
                            <div class="article-category">
                                <?php
                                foreach ($categories as $k => $v) {
                                    echo '<span class="catNameHolder" id="licat_' . $k . '">' . $v . '<span class="remcat"></span></span>';
                                }
                                ?>
                            </div>
                        </td>
                    </tr>

                <?php } ?>

                <?php
                if (count($custom_fields) > 0) {
                    foreach ($custom_fields as $field) {
                        render_custom_field($field);
                    }
                }
                ?>
                <?php
                if ($content->getType() == \content\models\Content::CONTENT_TYPE_ARTICLE) {
                    ?>
                    <tr valign="top" id="article-date-row" >
                        <th scope="row" ><label for="article_date">Date</label></th>
                        <td>
                            <input name="article_date" id="article_date" type="text" value="<?php echo $content->getEventdate() ?>"  autocomplete="off"/>
                        </td>
                    </tr>   
                <?php } ?>

                <?php
                if ($content->getType() != \content\models\Content::CONTENT_TYPE_ARTICLE) {
                    ?>
                    <tr valign="top" id="parent-page-list">
                        <th scope="row"><label for="parent_id">Parent Page</label></th>
                        <td>
                            <select name="parent_id" id="parent_id">
                                <option value="0">None</option>
                                <?php
                                $parent = $content->getParent();
                                $parent_id = (is_null($parent)) ? NULL : $parent->id();
                                echo pageSelectTree($parent_id);
                                ?>
                            </select>
                        </td>
                    </tr>
                <?php } ?>
                <tr valign='top'>
                    <th scope="row"><label for="published">Published </label></th>
                    <td>
                        <input type="radio" name="published" id="published-yes" value=1  checked="checked"/>
                        Yes&nbsp;&nbsp;
                        <input type="radio" name="published" id="published-no" value=0<?php if ($content->getStatus() == STATUS_INACTIVE) echo 'checked="checked"'; ?> />
                        No
                    </td>
                </tr>



                <tr valign="top">
                    <th scope="row"><label for="content_body">Content Body<span class="asterisk">*</span> </label></th>
                    <td><?php echo $ckeditor; ?></td>
                </tr>
                
                <tr valign="top">
                    <th scope="row"><label for="meta_title">Meta Title</label></th>
                    <td><input name="meta_title" id="meta_title" type="text" size="28" value="<?php echo $content->getMetaTitle('meta_title') ?>" autocomplete="off" /></td>
                </tr>
                
                <tr valign="top">
                    <th scope="row"><label for="meta_description">Meta Description </label></th>
                    <td>
                        <textarea name="meta_description" id="meta_description" rows="5" cols="100" ><?php echo $content->getMetaDescription('meta_description') ?></textarea><br />
                        <small>A single sentence for the HTML header is needed.</small>
                    </td>
                </tr>
                
                <tr valign="top">
                    <th scope="row"><label for="meta_keyword">Meta Keyword</label></th>
                    <td>
                        <textarea name="meta_keyword" id="meta_keyword" rows="5" cols="100" ><?php echo $content->getMetaKeyword('meta_keyword') ?></textarea><br />
                        <small>Keywords for HTML header, separated by commas.</small>
                    </td>
                </tr> 
                
                <?php if ($tags): ?>
                    <tr>
                        <th scope="row" id="tags-label"><label for="tags">Content Tags </label></th>
                        <td><div class="tag-category content-tags"><?php
                                foreach ($tags as $k => $v) {
                                    echo '<span class="tagNameHolder" id="' . $k . '">' . $v . '<span class="remtag"></span></span>';
                                }
                                ?></div>
                        </td>
                    </tr>
                <?php endif; ?>
                <tr valign="top">
                    <th scope="row"><label for="content_tags">Add New Tags </label></th>
                    <td><input name="content_tags" id="content_tags" type="text" size="100" autocomplete="off" style="width:80%" value="<?php //echo $content->getTags()     ?>"/></td>
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
            <?php
            if (isset($tabs) and count($tabs)) {
                $idx = 0;
                foreach ($tabs as $t):
                    ?>
                    <div id="tab<?php echo $idx ?>"><p>&nbsp;&nbsp;</p><hr/>
                        <table class="form-table">
                            <tr valign="top"><td><input type="hidden" name="tab_id[]" value="<?php echo $t->id() ?>" /></td></tr>
                            <tr valign="top">
                                <th scope="row"><label>Tab Title </label></th>
                                <td><input name="content_tab_title[]" maxlength="25" id="content_tab_title<?php echo $idx ?>" type="text" size="100" value="<?php echo $t->getTitle() ?>"  autocomplete="off" class="regular-text required" /></td>
                            </tr>
                            <tr valign="top">
                                <th scope="row"><label>Tab Content </label></th><td><textarea id="content_tab_body<?php echo $idx ?>" name="content_tab_body[]"><?php echo $t->getBody() ?></textarea></td>
                                                          	<td><a class="action-button" onclick="remTab('tab<?php echo $idx ?>', '<?php echo $t->id() ?>');" title="Remove this Tab"><span class="ui-icon ui-icon-trash"></span></a></td></tr>
                                                	</table>
                                                	<script>editor = CKEDITOR.replace(document.getElementById('content_tab_body<?php echo $idx; ?>'));</script>
                                                    </div>
                    <?php
                    $idx++;
                endforeach;
            }
            ?>

		<input type="hidden" name="remTabID" id="remTabID" value=""> 
		<input type="hidden" name="remTagID" id="remTagID" value=""/>   
	  <div id="tabs">&nbsp;</div> 
	  <p>&nbsp;</p>
        <p class="submit">
     <!--   <input type="button" name="btn_add_tab" id="btn_add_tab" class="button" value="Add Tab">&nbsp;&nbsp;&nbsp; -->
      <input type="submit" name="btn_submit" id="btn_submit" class="button" value="Save Content">
    </p>
    </form>
</div>
</div>
<!-- load f1 link plugin-->
<script type="text/javascript" src="<?php echo base_url() . 'assets/js/f1link.js' ?>"></script>
<?php if ($content->getType() == \content\models\Content::CONTENT_TYPE_ARTICLE) { ?>	
                        <script type="text/javascript">
                                                        $(function () {

                                                            /*	
                                                             $('#frm_edit_news').submit(function(e){
                                                             e.preventDefault();
                                                             //var content = CKEDITOR.instances.content_body.getData();
                                                             
                                                             var content = CKEDITOR.instances.content_body.document.getDocumentElement().$.innerHTML;
                                                             //console.log(CKEDITOR.instances.content_body.document.getDocumentElement().$.innerHTML);
                                                             //console.log($(content).find('a'));
                                                             //console.log($(content));
                                                             
                                                             $(content).find('a').each(function(i,ele){
                                                             console.log($(this));
                                                             $(this).addClass('content_anchor');
                                                             });
                                                             
                                                             console.log(content);
                                                             return false;
                                                             });
                                                             */

                                                            $('#article_date').datepicker({'dateFormat': 'yy-mm-dd', 'maxDate': '+0d'});
                                                            $('#select_category_id').bind('change', function () {
                                                                var obj = $(this),
                                                                        val = obj.val(),
                                                                        text = obj.children("[value=" + val + "]").text(),
                                                                        form = $('#frm_edit_news');

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

                                                                //also remove it from the hidden input stack
                                                                $("#catval_" + val).remove();
                                                            });
                                                        })
    </script><?php } ?>	
<script>
    $('.remtag').live('click', function () {
        var sure = confirm('Are you sure to Remove this Tag?');
        if (!sure)
            return false;
        var toRemove = $(this).closest('.tagNameHolder'),
                id = toRemove.attr('id'),
                tag = toRemove.html().split('<')[0];
        toRemove.hide(750).remove();
        var val_ = $("#remTagID").val() + ' ' + id;
        $("#remTagID").val(val_);
        $('#append-tag').append('<span class="tagNameHolder add-tag" id="' + tag + '">' + tag + '<span class="addtag"></span></span>');
        child = $('#append-tag > span').length;
        if (child > 0)
            $("#info-prompt").show();
        child = $('#append-tag > span').length;
        if (child > 0)
            $("#info-prompt").show();
        chld = $('.content-tags > span').length;
        if (chld < 1)
            $("#tags-label").hide();
    });

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
</script>
