<div class="section">
    <h4>Manage Testimonials
        <a href="<?php echo admin_url("testimonial/add") ?>" class="section-button"><span class="ui-icon ui-icon-plusthick"></span><span class="icontext">Add Testimonial</span></a>
    </h4>

    <div class="content"> 
        <?php if (count($testimonial) > 0): ?>
            <form name="content-list" id="content-list" method="post" action="">
                <table class="data" cellpadding="0" cellspacing="0">
                    <thead>
                    <th width="5%"><input type="checkbox" name="checkall" id="checkall" /></th>
                    <th width="20%">Name</th>
                    <th width="20%">Message</th>

                    <th width="5%">Status</th>
                    <th width="7%">Show Front</th>
                    <th width="15%">Action</th>
                    </thead>
                </table>
                <ul>
                    <?php
                    $sn = 1;
                    foreach ($testimonial as $t) {
                        ?>
                        <li id="<?php echo 'sl_' . $t->getId(); ?>">
                            <table class="data">
                                <tr valign="middle" class="<?php
                                if ($sn % 2 == 0)
                                    echo 'odd';
                                else
                                    echo 'even';
                                ?>" id="sltr_<?php echo $t->getId(); ?>" >
                                    <td class="tr_sortable" width="5%" id="slsn_<?php echo $t->getId(); ?>">
                                        <input class="flag-check" type="checkbox" name="check[]" value="<?php echo $t->getId(); ?>" />
                                    </td>
                                    <td width="20%"><?php echo $t->getName();
                                ?></td>
                                    <td width="20%">
                                        <?php echo $t->getBody(); ?>
                                    </td>
                                    <td width="5%" align="left"><?php echo $t->getStatus() ? "Active" : "Inactive"; ?></td>
                                    <?php //<td width="5%" align="left"><?php echo $t->getShowfront()?"Yes":"No"; ?>
                                    <td width="5%" align="left"><input type="radio" name="showFront" class="showFront" value="<?php echo $t->getId() ?>" <?php if ($t->getShowFront() == '1') { ?> checked=""<?php } ?>></td>
                                    <td width="15%">
                                        <div class="action-controls">
                                            <a href="<?php echo admin_url('testimonial/edit/' . $t->getId()) ?>" class="action-button" title="Edit Testimonial"><span class="ui-icon ui-icon-pencil"></span></a>
                                            <a href="<?php echo admin_url('testimonial/delete/' . $t->getId()); ?>" class="action-button delete-image" title="Delete Image"><span class="ui-icon ui-icon-trash"></span></a>

                                            <div class="clear"></div>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </li>
                        <?php
                        $sn++;
                    }
                    ?>
                </ul>
                <table class="form-table">
                    <tr>
                        <td width="10%">
                            <select name="action">
                                <option value="publish">Activate selected testimonials</option>
                                <option value="unpublish">Deactivate selected testimonials</option>
                                <option value="delete">Delete selected testimonials</option>
                            </select>
                        </td>
                        <td align="left">
                            <input type="submit" name="act-content" value="Update" class="button" />
                        </td>
                    </tr>
                </table>
            </form>
            <?php
        else:
            echo "No testimonials available yet. Start by adding one <a href=" . admin_url('testimonial/add') . " >here</a>";
        endif;
        ?>

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
        ?></div>
</div>

<script type="text/javascript">
    $(function () {
        var prevBackground;
        $('.sort_slider').sortable({handle: '.table_check',
            placeholder: 'ui-state-highlight',
            forcePlaceholderSize: true,
            update: _alert,
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

        $('#checkall').bind('click', function () {
            var boxes = $(this).parents('form').find('.flag-check');
            boxes.attr('checked', $(this).is(':checked'));
        });
        $('#content-list').bind('submit', function () {
            var really = confirm("Please confirm if you want to apply this batch operation.");
            if (!really)
                return false;
        });

        //delete slider
        $('.delete-image').bind('click', function (e) {
            var really = confirm("You really want to remove this image?");
            if (!really)
                return false;
        });
    });

    function _alert(evt, ui)
    {
        var result = $(".sort_slider").sortable('toArray');
        updateSerial(result);
        ui.item.css({background: 'none'});
        $('#save-notif').show();

        $('#save-changes').bind('click', function (e) {
            e.preventDefault();
            updateOrder(result);
        });


    }
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

        $('#save-notif').hide();
        $('#save-progress').show();

        jQuery.ajax({
            url: '<?php echo admin_url('testimonial/updateOrder'); ?>',
            type: 'POST',
            data: datatosend,
            success: function (e) {

                $('#save-progress').removeClass('info').addClass('success').text('The changes were successfully saved.');
                $('#save-progress').fadeOut(1500, null, function () {
                    $(this).removeClass('success').addClass('info').text('Saving.....');
                });
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
        }
    }
    //ajax update of values
    $(document).ready(function () {
        $(".showFront").click(function () {

            $.ajax({
                type: "POST",
                url: "<?php echo admin_url("testimonial/updateFront"); ?>",
                data: {id: $(this).val(), status: $(this).is(':checked')
                },
                success: function (data) {
                }
            });
        });
    });
</script>