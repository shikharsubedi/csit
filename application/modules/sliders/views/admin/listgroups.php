<style>
    .table_check{ cursor:move;}
</style>

<!--  <div class="response info" >You can sort the Groups using the sorting handle in the actions in each row.</div>-->
<div class="section">
    <h4>Manage Slider Groups

        <a href="<?php echo admin_url('slider/addgroup') ?>" class="section-button"><span class="ui-icon ui-icon-plusthick"></span><span class="icontext">Add Group</span></a>

    </h4>

    <div class="content"> 
        <div class="response info" id="save-notif" style="display:none">Your changes have not been saved.Please click <a href="#" id="save-changes">here</a> to save the changes.</div>
        <div class="response info" id="save-progress" style="display:none">Saving.....</div>
        <?php if (count($sliders) > 0): ?>
            <form name="content-list" id="content-list" method="post" action="">
                <table class="data" cellpadding="0" cellspacing="0">
                    <thead>
                    <th width="5%"><input type="checkbox" name="checkall" id="checkall" /></th>
                    <th width="20%">Name</th>
                    <th width="20%">Width</th>
                    <th width="30%">Height</th>
                    <th width="15%">Action</th>
                    </thead>
                </table>
                <ul class="sort_slider" style="list-style-type:none; width:100%; margin:0 0 0 0;">
                    <?php
                    $sn = 1;
                    //show_pre($sliders);
                    //die;
                    foreach ($sliders as $u) {
                        ?>
                        <li id="<?php echo 'sl_' . $u['id']; ?>">
                            <table class="data">
                                <tr valign="middle" class="<?php if ($sn % 2 == 0)
                    echo 'odd';
                else
                    echo 'even';
                ?>" id="sltr_<?php echo $u['id']; ?>" >
                                    <td class="tr_sortable" width="5%" id="slsn_<?php echo $u['id']; ?>">
                                        <input class="flag-check" type="checkbox" name="check[]" value="<?php echo $u['id']; ?>" />
                                    </td>
                                    <td width="20%"><?php echo $u['name']; ?></td>
                                    <td width="20%" align="left"><?php echo $u['width']; ?></td>
                                    <td width="30%" align="left"><?php echo $u['height']; ?></td>
                                    <td width="15%">
                                        <div class="action-controls">

                                            <a href="<?php echo admin_url('slider/editgroup/' . $u['id']) ?>" class="action-button" title="Edit Slider Group"><span class="ui-icon ui-icon-pencil"></span></a>
                                            <a href="<?php echo admin_url('slider/items/' . $u['id']); ?>" class="action-button" title="View Slider"><span class="ui-icon ui-icon-arrowthick-1-ne"></span></a>
                                            <?php /* ?>
                                              <a href="<?php echo admin_url('slider/addslider/'.$u['id']);?>" class="action-button" title="Add Slider"><span class="ui-icon ui-icon-plusthick"></span></span></a>
                                              <a href="<?php echo admin_url('slider/deletegroup/'.$u['id']);?>" class="action-button delete-image" title="Delete group"><span class="ui-icon ui-icon-trash"></span></a>
                                              <?php */ ?>
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
                <?php  ?>
                  <table class="form-table">
                  <tr>
                  <td width="10%">
                  <select name="action">
                  <option value="publish">Activate selected images</option>
                  <option value="unpublish">Deactivate selected contents</option>
                  <option value="delete">Delete selected contents</option>
                  </select>
                  </td>
                  <td align="left">
                  <input type="submit" name="act-content" value="Update" class="button" />
                  </td>
                  </tr>
                  </table><?php  ?>
                <div class="clear">  </div>
                <?php  ?>
                  <table class="form-table">
                  <tr valign="top">
                  <th scope="row" width="10%"><b>Main Slider</b></th>
                  <td width="10%">
                  <select name="actionMain">
                  <option value="">Main Slider</option>
                  <?php
                  foreach ($sliders as $s) {
                  //show_pre($s);
                  echo "<option value='{$s['id']}'>{$s['name']}</option>";
                  }
                  ?>
                  </select>
                  </td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <th scope="row" width="10%"><b>Mini Slider</b></th>
                  <td width="10%">
                  <select name="actionMini">
                  <option value="">Mini Slider</option>
                  <?php
                  foreach ($sliders as $s) {
                  echo "<option value='{$s['id']}'>{$s['name']}</option>";
                  }
                  ?>
                  </select>
                  </td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td align="left">
                  <input type="submit" name="update-slider" value="Update" class="button" />
                  </td>
                  </tr>
                  </table>
                  <?php  ?>
            </form>
            <?php
        else:
            echo "No sliders available yet. Start by adding one <a href=" . admin_url('slider/addgroup') . " >here</a>";
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
            url: '<?php echo base_url(); ?>slider/ajax/updateOrder',
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
</script>