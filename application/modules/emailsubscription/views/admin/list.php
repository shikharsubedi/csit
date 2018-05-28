<div id="list-content-wrapper" class="section">
    <h4><span class="ui-icon ui-icon-document"></span>Email's
        <a href="<?php echo admin_url('emailsubscription/add') ?>" class="section-button"><span class="ui-icon ui-icon-plusthick"></span><span class="icontext">Add Email</span></a>
    </h4>

    <div class="content">
        <?php // show_pre($quickLinks); exit; ?>
        <form name="content-list" id="content-list" method="post" action="">

            <table class="data" cellpadding="0" cellspacing="0">
                <thead>
                <th>SN</th>
                <th>Email</th>
                <th>Status</th>
                <th>Action</th><td>
                    </thead>
                <tbody>
                    <?php
                    $i = 1;
                    foreach ($emails as $key => $value):
                        ?>
                        <tr>
                            <td> <?php echo $i++; ?> </td>
                            <td> <?php echo $value->getEmail(); ?> </td>
                            <td> <?php echo $value->getActive(); ?> </td>
                            <td> 
                                <div class="action-controls">

                                    <a href="<?php echo admin_url('emailsubscription/edit/' . $value->getId()) ?>" class="action-button" title="Edit"><span class="ui-icon ui-icon-pencil"></span></a>
                                    <a href="<?php echo admin_url('emailsubscription/delete/' . $value->getId()) ?>" class="action-button delete" title="Delete"><span class="ui-icon ui-icon-trash"></span></a>

                                    <div class="clear"></div>
                                </div>
                            </td>
                        </tr>

                    <?php endforeach; ?>
                </tbody>
            </table>
        </form>
    </div>
</div>
<script type="text/javascript">
    $(function () {
               //delete slider
        $('.delete').bind('click', function (e) {
            var really = confirm("You really want to remove this email?");
            if (!really)
                return false;
        });
    });
</script>