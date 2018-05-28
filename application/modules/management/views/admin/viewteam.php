<?php
$mgmt = ((strtolower($team) == 'management' or strtolower($team) == 'management team')) ? (true) : false;
if ($mgmt)
    echo '<style>li.placeholder2{width:200px; height:30px; background:#ccc;}</style>';
?>

<div class="section">
    <h4>View Team Member(s) - [ <?php echo $team ?> ] <a href="<?php echo admin_url('management/addmember/' . $team_id) ?>" class="section-button" title="Add new member for <?php echo $team ?>"><span class="ui-icon ui-icon-plusthick"></span><span class="icontext">Add Member</span></a></h4>
    <div class="content">
        <div class="sort response info" style="display:none">Your changes have not been saved. Please click Save Order button at the bottom.
        </div>
        <ul id="manage-pos-list">
            <div id="subscriber_1" class="subscriber">
                <?php foreach ($members as $m):
                    ?>
                    <li id="pos_<?php echo $m['id'] ?>" title="hold the mouse button and drag to sort order" <?php if ($mgmt) echo ' style="height:auto;"' ?>>
                        <div>
                            <?php if ($m['image']): ?>
                                <img src="<?php echo base_url() . "assets/upload/images/members/frontpage_thumbs/" . $m['image'] ?>" style="max-width:125px">
                            <?php endif; ?>
                            <h1><?php echo $m['name'] ?></h1>
                            <p class="position"><?php echo $m['position'] ?></p>
                        </div>
                        <div class="control">
                            <a href="<?php echo ($mgmt) ? admin_url('management/editmember/' . $m['id'] . '/' . $team_id) : admin_url('management/editmember/' . $m['id']) ?>">Edit</a>
                            | <a href="<?php echo admin_url('management/deletemember/' . $m['id']) ?>" class="delete-pos">Delete</a> 
                        </div> <br>

                        <input type="checkbox" name="showFront[]" class="showFront" value="<?php echo $m['id']; ?>" <?php if ($m['showFront'] == '1') { ?> checked=""<?php } ?>>Show on Homepage  


                    </li>
                <?php endforeach; ?>
            </div>
        </ul>
        <?php if (count($members) < 1) echo 'No members associated with this team.' ?>
        <div style="clear:both"></div>               
        <div class="sort" style="display:none">
            <form method="post" action="" name="sort-member">
                <input type="hidden" value="" name="order" id="arr-order"/>
                <button type="submit" name="Save Order" class="button">Save Order</button>
            </form>

        </div>

    </div>
</div>
<script type="text/javascript">
    $(function () {
        $('#manage-pos-list').sortable({placeholder: '<?php echo ($mgmt) ? "placeholder2" : "placeholder" ?>',
            update: updateOrder
        })
                .disableSelection();

        $('#manage-pos-list li').bind('mouseenter', function () {
            $(this).children('.control').fadeIn();
        });

        $('#manage-pos-list li').bind('mouseleave', function () {
            $(this).children('.control').fadeOut();
        });


        $('.delete-pos').bind('click', function ()
        {
            var really = confirm("You really want to remove this member?");
            if (!really)
                return false;
        });
    })



    function updateOrder(e, ui)
    {
        $('.sort:hidden').fadeIn();
        var array = $(ui.item).closest('ul').sortable('toArray'),
                order = '';
        for (var i in array)
        {
            order += array[i].split('_')[1] + '&';
        }
        order = order.substr(0, order.length - 1);
        $('#arr-order').val(order);

    }
    //ajax update of showFront
    $(document).ready(function () {
        $(".showFront").click(function () {

            $.ajax({
                type: "POST",
                url: "<?php echo admin_url("management/updatefront"); ?>",
                data: {id: $(this).val(), status: $(this).is(':checked')
                },
                success: function (data) {
                }
            });
        });
    });

//Determine the limit for check boxes to be set to true
    var limit = 2;
    var count = <?php echo $count ?>;
    if (count > 2)
        alert('count cannot be greater than two');
    if (count == 2)
        limit = 0;
    else if (count == 1)
        limit = 1;
    else if (count == 0)
        limit = 2;
    //numberOfCheckboxesSelected 
    var numberOfCheckboxesSelected = $("input:checkbox:checked").length;
    if (numberOfCheckboxesSelected == 1)
        limit++;
    else if (numberOfCheckboxesSelected == 2) {
        limit++;
        limit++;
    }
    //Determine the limit for check boxes to be set to true 

<?php //allow only two showfront values to be set to 1              ?>
    $('.subscriber :checkbox').change(function () {
        var $cs = $(this).closest('.subscriber').find(':checkbox:checked');
        if ($cs.length > limit) {
            this.checked = false;
        }
    });
<?php //allow only two showfront values to be set to 1              ?>
</script>