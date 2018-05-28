<div class="section">
    <div class="response info">Click and Drag the rows to sort order.</div>


    <h4>Manage Video Category
        <a href="<?php echo admin_url("video/addcat") ?>" 
           class="section-button" 
           title="Add new media">
            <span class="ui-icon ui-icon-plusthick"></span>
            <span class="icontext">Add New Category</span>
        </a>
    </h4> 
    <?php if($cat){?>
    <div class="content">
        <div class="sort response info" style="display:none">Your changes have not been saved. Please click Save Order button at the bottom.</div>
          <form name="content-list" id="content-list" method="post" action="">
        <table class="sortable data" cellpadding="0" cellspacing="0">
            <thead>
            <th width="5%"><input type="checkbox" name="checkall" id="checkall" /></th> 
            <th width="25">Category Title</th>
            <th width="25">Category Slug</th>
            <th width="25%">Status</th>
            <th width="15%">Action</th>
            </thead>
            <tbody id="toArray">
                <?php
                foreach ($cat as $c):
                    ?>
                    <tr id="<?php echo $c['id'] ?>">
                        <td><input type="checkbox" name="check[]" value="<?php echo $c['id'] ?>" class="flag-check"></td>
                        <td><?php echo $c['title'] ?></td>
                        <td><?php echo $c['slug'] ?></td>
                        <td><?php echo ($c["status"]) ? "Active" : "Inactive" ?></td>
                        <td><div class="action-controls">
                                <a href="<?php echo admin_url("video/editcat/" . $c["id"]) ?>" class="action-button" title="View and Edit Category"><span class="ui-icon ui-icon-pencil"></span></a>

                                <a href="<?php echo admin_url("video/deletecat/" . $c["id"]) ?>" class="action-button delete-image" title="Delete Category"><span class="ui-icon ui-icon-trash"></span></a>
                                <a title="View Video" class="action-button" href="<?php echo admin_url('video/videolist/' . $c['id']) ?>"><span class="ui-icon ui-icon-arrowthick-1-ne"></span></a>
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
                        <option value="publish">Publish selected images</option>
                        <option value="unpublish">Unpublish selected contents</option>
                        <option value="delete">Delete selected contents</option>
                      
                    </select>
                </td>
                <td align="left">
                    <input type="submit" name="update" value="Update" class="button update" />
                </td>
            </tr>
        </table>
        <div class="sort" style="display:none; margin-top:20px">
            <form method="post" action="" name="sort-member">
                <input type="hidden" value="" name="order" id="arr-order"/>
                <input type="submit" name="saveorder" class="button" value="Save Order" />
            </form>
        </div>
          </form>
    </div>
    <?php } else{
        echo "No items available yet. Start by adding one <a href=" . admin_url('video/addcat') . " >here</a>";
    
    }
?>
    

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
<script>
    $(function () {
        $('.delete-image').click(function () {
            return confirm('Are you sure to delete this category and its videos?');
        });
    });
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