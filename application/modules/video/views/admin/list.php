<div class="section">
    <div class="response info">Click and Drag the rows to sort order.</div>
    <h4>Manage Video 
        <a href="<?php echo admin_url("video/add/" . $id) ?>" 
           class="section-button" 
           title="Add new media">
            <span class="ui-icon ui-icon-plusthick"></span>
            <span class="icontext">Add New Video</span>
        </a>
    </h4> 
    <div class="content">
        <div class="sort response info" style="display:none">Your changes have not been saved. Please click Save Order button at the bottom.</div>
        <form name="content-list" id="content-list" method="post" action="">
            <table class="sortable data" cellpadding="0" cellspacing="0">
                <thead>
                <th width="5%"><input type="checkbox" name="checkall" id="checkall" /></th>
                <th width="25%">Name</th>
                <th width="10%">Status</th>
                <th width="15%">Action</th>
                </thead>
                <tbody id="toArray">
                    <?php
                    foreach ($videos as $e):
                        ?>
                        <tr id="<?php echo $e['id'] ?>">
                            <td><input type="checkbox" name="check[]" value="<?php echo $e['id'] ?>" class="flag-check"></td>
                            <td><?php echo $e['title'] ?></td>
                            <td><?php echo ($e["active"] == 1) ? "Active" : "Inactive" ?></td>
                            <td><div class="action-controls">
                                    <a href="<?php echo admin_url("video/edit/" . $e["id"]) ?>" class="action-button" title="View and Edit Video"><span class="ui-icon ui-icon-pencil"></span></a>

                                    <a href="<?php echo admin_url("video/delete/" . $e["id"]) ?>" class="action-button delete-image" title="Delete Video"><span class="ui-icon ui-icon-trash"></span></a>

                                    <div class="clear"></div>

                                </div> 

                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
            <table class="form-table">
                <tr>
                    <td width="10%">
                        <select name="action">
                            <option value="publish">Publish selected items</option>
                            <option value="unpublish">Unpublish selected items</option>
                            <option value="delete">Delete selected contents</option>

                        </select>
                    </td>
                    <td align="left">
                        <input type="submit" name="update" value="Update" class="button update" />
                    </td>
                </tr>
            </table>
            <div style="clear"></div>
            <div class="sort" style="display:none; margin-top:20px">
                <form method="post" action="" name="sort-member">
                    <input type="hidden" value="" name="order" id="arr-order"/>
                    <input type="submit" name="saveorder" class="button" value="Save Order" />
                </form>
            </div>
           
        </form>

    </div>


</div>
<?php
if (isset($pagination)) {
    ?>
    <div class="pagination">
        <?php
        echo $pagination;
        ?>
    </div>
<?php }
?>
<script>
    $('.ui-icon-trash').click(function () {
        var sure = confirm('You really want to remove this team?');
        if (!sure)
            return false;
    });

    $(function () {
        $('tbody > tr').css({'cursor': 'move'});

        var fixHelper = function (e, ui) {
            ui.children().each(function () {
                $(this).width($(this).width());
            });
            return ui;
        };


        $('.sortable tbody').sortable({
            update: updateOrder,
            helper: fixHelper
        })
                .disableSelection();
    })


    function updateOrder(e, ui)
    {
        $('.sort:hidden').fadeIn();
        var array = $('#toArray').sortable('toArray'),
                order = '';
        for (var i in array)
        {
            order += array[i] + '&';
        }
        order = order.substr(0, order.length - 1);
        $('#arr-order').val(order);
    }
</script>
<script type="text/javascript">
    $(function () {
        //delete slider
        $('.delete-image').bind('click', function (e) {
            var really = confirm("You really want to remove this Menu?");
            if (!really)
                return false;
        });
    })


    function showFront(ele) {

        var id = ele.value;
        var chk = (ele.checked == true) ? 'Y' : 'N';
        var datatosend = 'id=' + id + '&chk=' + chk;
        jQuery.ajax({
            url: '<?php echo admin_base_url() ?>audio/showfront',
            type: 'POST',
            data: datatosend,
            success: function () {
            },
            error: function () {
            }
        })
    }
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