<div class="section">
    <h4> Team Categories 
        <a href="<?php echo admin_url('management/addteam') ?>" class="section-button"><span class="ui-icon ui-icon-plusthick"></span><span class="icontext">Add a Team</span></a> 
    </h4>
    <div class="content">
        <table class="data">
            <thead>
            <th>Team ID</th>
            <th>Team Category</th>
            <th width="20%">Actions</th>
            </thead>
            <tbody>
                <?php foreach ($teams as $t): ?>
                    <tr>
                        <td><?php echo $t['id'] ?></td>
                        <td><?php echo $t['name'] ?></td>
                        <td class="actions">
                            <div class="action-controls">
                                <a href="<?php echo admin_url('management/addmember/' . $t['id']) ?>" class="action-button" title="Add a Member"><span class="ui-icon ui-icon-plusthick"></span></a>
                                <a href="<?php echo admin_url('management/editteam/' . $t['id']) ?>" class="action-button" title="Edit Team"><span class="ui-icon ui-icon-pencil"></span></a>
                                <a href="<?php echo admin_url('management/viewmembers/' . $t['id']); ?>" class="action-button" title="View Members"><span class="ui-icon ui-icon-arrowthick-1-ne"></span></a>

                                <div class="clear"></div>
                            </div></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<script>
    $('.ui-icon-trash').click(function () {
        var sure = confirm('Do you really want to delete this team and all the members in it?');
        if (!sure)
            return false;
    });
</script>