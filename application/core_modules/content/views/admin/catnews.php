<div class="section controls">
    <a href="<?php echo admin_url('content/category') ?>" class="control-button"><span class="ui-icon ui-icon-folder-open"></span><span class="icontext">Category</span></a>

    <div class="clear"></div>
</div>

<div id="list-content-wrapper" class="section">
    <h4><span class="ui-icon ui-icon-document"></span>Contents
        <a href="<?php echo admin_url('content/addFromCategory?categoryId='.$categoryId) ?>" class="section-button"><span class="ui-icon ui-icon-plusthick"></span><span class="icontext">Add Content</span></a>
    </h4>

    <div class="content">
        <div class="sort response info" style="display:none">Your changes have not been saved. Please click Save Order button at the bottom.</div>   
        <form name="content-list" id="content-list" method="post" action="">
            <table class="data sortable" cellpadding="0" cellspacing="0">

                <thead>
                <th width="2%"><input type="checkbox" name="checkall" id="checkall" /></th>
                <th width="30%">News Title</th>
                    <!--<th width="5%">Type</th>-->
                <th width="12%">Author</th>

                <th width="5%">Status</th>
                <th width="8%">Date</th>
                <th width="8%">Action</th>
                </thead>
                <tbody id="toArray">
                    <?php
                    if (count($contents) == 0) {
                        echo "<tr><td colspan='8' align='center'>No data available.</td></tr>";
                    } else {
                        $count = 1;
                        //show_pre($contents); 
                        foreach ($contents as $a):
                            $class = ($count > 0) ? "even" : "odd";
                            $count = $count * (-1);
                            $author = $a['firstname'] . ' ' . $a['lastname'];
                            ?>
                            <tr class="<?php echo $class ?>" id="<?php echo $a["id"] ?>">
                                <td><input class="flag-check" type="checkbox" name="check[]" value="<?php echo $a['id']; ?>" /></td>
                                <td><p class="td_title"><a href="<?php echo admin_url('content/edit/' . $a['id']) ?>"><?php echo $a['title'] ?></a></p></td>
                            <!--<td><?php echo (strtolower($a['type'] == 'article')) ? 'News' : 'Page' ?></td>-->
                                <td><?php echo $author ?></td>
                                <?php
                                if ($a['showfront'] == 1) {
                                    $chkr = "checked='checked'";
                                } else {
                                    $chkr = '';
                                }
                                ?>

                                <td><?php echo ucfirst($a['status']) ?></td>
                                <td title="<?php echo dateMySqlWithTime($a['created']) ?>"><?php echo dateMySql($a['created']) ?></td>
                                <td class="action">

                                    <div class="action-controls">

                                        <a href="<?php echo admin_url('content/edit/' . $a['id']) ?>" class="action-button" title="Edit Article"><span class="ui-icon ui-icon-pencil"></span></a>
                                        <a href="<?php echo admin_url('content/delete/' . $a['id']); ?>" class="action-button delete" title="Delete Article"><span class="ui-icon ui-icon-trash"></span></a>

                                        <div class="clear"></div>
                                    </div>

                                </td>
                            </tr>
                            <?php
                        endforeach;
                    }
                    ?>

                </tbody>
            </table>
            <table class="form-table">
                <tr>
                    <td width="10%">
                        <select name="action">
                            <option value="publish">Publish selected contents</option>
                            <option value="unpublish">Unpublish selected contents</option>
                            <option value="delete">Delete selected contents</option>
                        </select>
                    </td>
                    <td align="left">
                        <input type="submit" name="update" value="Update" class="button" />
                    </td>
                </tr>
            </table>
        </form>
    </div>

    <div style="clear"></div>
    <div class="sort" style="display:none; margin-top:20px">
        <form method="post" action="" name="sort-member">
            <input type="hidden" value="" name="order" id="arr-order"/>
            <input type="submit" name="saveorder" class="button" value="Save Order" />
        </form>
    </div>

</div>

<?php /* ?> <?php
  if(isset($pagination))
  {
  ?>
  <div class="pagination">
  <?php
  echo $pagination;
  ?>
  </div>
  <?php
  }
  ?><?php */ ?>
</div>
<script type="text/javascript">

    function showfrontt(ele) {
        if (confirm('Are you sure to select this content to show in Home page?')) {

            var sfid = ele.value;
            if (ele.checked == true) {
                var showfrontvalue = "true";
            }
            else if (ele.checked == false) {
                var showfrontvalue = "false";
            }

            var datatosend = 'id=' + sfid + '&showvalue=' + showfrontvalue;
            jQuery.ajax({
                url: '<?php echo admin_url('content/showfrontt') ?>',
                type: 'POST',
                data: datatosend,
                success: function (e) {
                },
                error: function (e) {
                }
            });
        }


    }

    $(function () {

        $('#content-list').bind('submit', function () {
            if ($(".flag-check:checked").length < 1) {
                $('#checkall').attr('checked', false);
                alert('Nothing selected!');
                return false;
            }
            var really = confirm("Please confirm if you want to apply this batch operation.");
            if (!really)
                return false;
        });

        $('.delete').bind('click', function () {
            var really = confirm("You really want to remove this content?");
            if (!really)
                return false;
        });

        $('#checkall').bind('click', function () {
            var boxes = $(this).parents('form').find('.flag-check');
            boxes.attr('checked', $(this).is(':checked'));
        });

    })
</script>
<script type="text/javascript">
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

    function updateOrder(e, ui) {

        $('.sort:hidden').fadeIn();
        var array = $('#toArray').sortable('toArray'),
                order = '';
        for (var i in array)
            order += array[i] + '&';
        order = order.substr(0, order.length - 1);
        $('#arr-order').val(order);
    }

</script>