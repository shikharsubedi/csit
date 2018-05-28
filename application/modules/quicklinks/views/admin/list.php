<div id="list-content-wrapper" class="section">
    <h4><span class="ui-icon ui-icon-document"></span>Quick Link's
        <a href="<?php echo admin_url('quicklinks/add') ?>" class="section-button"><span class="ui-icon ui-icon-plusthick"></span><span class="icontext">Add QuickLink</span></a>
    </h4>

    <div class="content">
        <?php // show_pre($quickLinks); exit; ?>
        <form name="content-list" id="content-list" method="post" action="">

            <table class="data" cellpadding="0" cellspacing="0">
                <thead>
                <th>Title</th>
                <th>Type</th>
                <th>Status</th>
                <th>Action</th><td>
                    </thead>
                <tbody>
                    <?php foreach ($quickLinks as $key => $value): ?>
                        <tr>
                            <td> <?php echo $value['title']; ?> </td>
                            <td> <?php echo $value['type']; ?> </td>
                            <td> <?php echo $value['status']; ?> </td>
                            <td> 
                                <div class="action-controls">

                                    <a href="<?php echo admin_url('quicklinks/edit/' . $value['id']) ?>" class="action-button" title="Edit"><span class="ui-icon ui-icon-pencil"></span></a>
                                    <a href="<?php echo admin_url('quicklinks/delete/' . $value['id']); ?>" class="action-button" title="Delete"><span class="ui-icon ui-icon-trash"></span></a>

<!--     Revise                               <a href="<?php echo admin_url('quicklinks/view/' . $value['id']);?>" class="action-button" title="View Content"><span class="ui-icon ui-icon-arrowthick-1-ne"></span></a>-->
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