<?php
//echo "<pre>";
//    \Doctrine\Common\Util\Debug::dump($contacts);exit;
?>
<div id="list-content-wrapper" class="section">
    <h4><span class="ui-icon ui-icon-document"></span>Contact Us</h4>    
    <div class="content">
        <form name="content-list" id="content-list" method="post" action="">

            <table class="data" cellpadding="0" cellspacing="0">
                <thead>
                <th>Date</th>
                <th>Name</th>
                <th>Email</th>
                <th>Message</th>
                <th>Action</th>
                </thead>
                <tbody>
                    <?php foreach ($contacts as $key => $value): ?>
                        <tr>
                            <td> <?php echo date_format(($value->getCreated()), 'Y-m-d'); ?> </td>
                            <td> <?php echo $value->getName(); ?> </td>
                            <td> <?php echo $value->getEmail(); ?> </td>
                            <td> <?php echo $value->getMessage(); ?> </td>
                            <td class="actions">
                                <div class="action-controls">
                                    <a href="<?php echo admin_url('contactus/view/' . $value->getId()); ?>" class="action-button" title="View"><span class="ui-icon ui-icon-arrowthick-1-ne"></span></a>

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