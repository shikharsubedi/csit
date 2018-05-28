<div id="list-content-wrapper" class="section">
    <h4><span class="ui-icon ui-icon-document"></span>Download Items in category "<?php echo $category->getName(); ?>"
        <a href="<?php echo admin_url('downloads/addfile/' . $category->id()) ?>" class="section-button"><span class="ui-icon ui-icon-plusthick"></span><span class="icontext">Add a Download Item</span></a>
    </h4>

    <div class="content">
        <?php if (count($items) > 0): ?>
            <form name="content-list" id="content-list" method="post" action="">
                <table class="data " cellpadding="0" cellspacing="0">
                    <thead>
                    <th width="2%"><input type="checkbox" name="checkall" id="checkall" /></th>                
                    <th width="30%">Name</th>
                    <th width="20%">Filename</th>
                    <th width="20%">Added</th>
                    <th width="20%">Show in Quick Links</th>
                    <th width="10%">Published</th>
                    <th width="10%">Action</th>
                    </thead>
                </table>
                <ul class="sort_dl" style="list-style-type:none; width:100%; margin:0 0 0 0;">
                    <?php
                    $count = 1;
                    foreach ($items as $a):
						$chk = ($a['showFront'] == 1) ? "checked" : "";
                    ?>
                        <li id="<?php echo 'sl_' . $a['id']; ?>">
                            <table class="data">
                                <tr class="<?php if ($count % 2 == 0) echo 'odd';
                else echo 'even'; ?> table_check tr_sortable">
                                    <td width="2%"><input type="checkbox" name="check[]" value="<?php echo $a['id'] ?>" class="flag-check"></td>                            
                                    <td width="30%"><p class="td_title"><?php echo $a['name']; ?></p></td>
                                    <td width="20%"><?php echo $a['file'] ?></td>
                                    <td width="20%"><?php echo $a['created']; ?></td>
                                    <td width="20%">
										<input type="checkbox" name="showfront" <?php echo $chk?> class="showfront" value="<?php echo $a['id']?>" />
                                    </td>
                                    <td width="10%"> <?php
                                        $pubclass = ($a['status'] == STATUS_ACTIVE) ? 'published' : 'unpublished';
                                        echo "<div class='publishflag $pubclass' id='pub_" . $a['id'] . "'></div>";
                                        ?></td>

                                    <td width="10%" class="action">

                                        <div class="action-controls">
                                            <a href="<?php echo admin_url('downloads/deleteitem/' . $a['id']); ?>" class="action-button delete" title="Delete Item"><span class="ui-icon ui-icon-trash"></span></a>

                                            <div class="clear"></div>
                                        </div>

                                    </td>
                                </tr>
                            </table>
                        </li>
    <?php endforeach; ?>
                </ul>
                </table>
                <table class="form-table">
                    <tr>
                        <td width="10%">
                            <select name="action">
                                <option value="publish">Publish selected items</option>
                                <option value="unpublish">Unpublish selected items</option>
                                <option value="delete">Delete selected items</option>
                            </select>
                        </td>
                        <td align="left">
                            <input type="submit" name="update" value="Update" class="button update" />
                        </td>
                    </tr>
                </table>
            </form>
        <?php
        else:
            echo 'Download items not added yet. Start by adding one <a href="' . admin_url('downloads/addfile/' . $category->id()) . '">here</a>';
        endif
        ?>
        </table></div>
    <?php
    if (isset($pagination)) {
        ?>
        <div class="pagination">
            <div class="nxt">
                <?php
                echo $pagination;
                ?>
            </div>
            <div class="clear"></div>
        </div>
        <?php
    }
    ?>
</div>
<script type="text/javascript">
    $(function () {
		
		$('.showfront').click(function(e) {
            
			var id = $(this).val();
			var chk = $(this).is(':checked');
			var datatosend = 'id='+id+'&chk='+chk;
			
			jQuery.ajax({
				
				url 	: '<?php echo site_url()?>downloads/ajax/setQuickLinks'	,
				type	: 'POST',
				data	: datatosend,
				success	: function(data){
					
						}
			})
        });

        //publish unpublish an article
        $('.publishflag').bind('click', function () {
            var obj = $(this);
            var published,
                    articleId = obj.attr('id').split('_')[1];
            //obj.toggleClass('published').toggleClass('unpublished');
            if (obj.hasClass('published'))
                published = '<?php echo STATUS_INACTIVE; ?>';
            else
                published = '<?php echo STATUS_ACTIVE; ?>';

            var data = {id: articleId,
                value: published}

            $.ajax({type: 'POST',
                url: '<?php echo base_url(); ?>downloads/ajax/setActivateItem',
                data: data,
                success: function (response) {
                    obj.toggleClass('published').toggleClass('unpublished');
                }
            });
        });

        $('.delete').bind('click', function () {
            var really = confirm("You really want to remove this item?");
            if (!really)
                return false;
        });

        var prevBackground;
        $('.sort_dl').sortable({handle: '.table_check',
            placeholder: 'ui-state-highlight',
            forcePlaceholderSize: true,
            update: function (evt, ui) {
                ui.item.css({background: 'none'});
                var result = jQuery(".sort_dl").sortable('toArray');
                updateOrder(result);
            },
            start: function (e, ui) {
                //console.debug(ui);
                prevBackground = ui.item.css('background');
                ui.item.css({background: '#eee'});
            },
            stop: function (e, ui) {
                ui.item.css({background: prevBackground});
            }
        })
                .disableSelection();

        function updateOrder(arr)
        {
            var num_items = arr.length;
            var datatosend = 'ordering=';

            for (i = 0; i < (num_items - 1); i++)
            {
                splt_arr = arr[i].split('_');
                datatosend += splt_arr[1] + '|';
            }
            splt_arr = arr[i].split('_');
            datatosend += splt_arr[1];

            jQuery.ajax({
                url: '<?php echo base_url(); ?>downloads/ajax/updateDownloadOrder',
                type: 'POST',
                data: datatosend,
                success: function (e) {
                    updateSerial(arr);
                },
                error: function (e) {
                }
            });
        }

        function updateSerial(arr)
        {
            var num_items = arr.length;
            for (i = 0; i < (num_items); i++)
            {
                var id = arr[i].split('_')[1];
                var selector = 'tr#sltr_' + id;
                var obj = $(selector);
                var klass = ((i % 2) == 0) ? 'odd' : 'even';
                obj.removeClass().addClass(klass);

                $('td#slsn_' + id).html(i + 1);
            }
        }

    })
</script>
<script>
    $('#checkall').bind('click', function () {
        var boxes = $(this).parents('form').find('.flag-check');
        boxes.attr('checked', $(this).is(':checked'));
    });

    $('.update').bind('click', function (e) {
        if ($(".flag-check:checked").length < 1) {
            $('#checkall').attr('checked', false);
            alert('Nothing selected!');
            return false;
        }
        var really = confirm("You really want to apply changes to selected items?");
        if (!really)
            return false;
    });
</script>