<div class="section">    
    <h4>
        View Applied Student's 
    </h4>                
    <div class="content">   
        <?php if ($faculty): ?>

            <form name="content-list" id="content-list" method="post" action="">
                <table class="sortable data" cellpadding="0" cellspacing="0">
                    <thead>

                    <th width="10%">Name</th>  
                    <th width="5%">Phone</th>
                    <th width="15%">Applied</th>
                    <th width="30%">Actions</th>
                    </thead>

                    <tbody id="toArray">
                        <?php foreach ($faculty->getAppliedStudents() as $s): ?>
                            <tr>
                                <td width="10%"> <?php echo ucfirst($s->getName()) ?> </td>
                                <td width="5%"><?php echo $s->getPhone() ?></td> 
                                <td><?php echo date_format($s->getCreated(), "M d,Y"); ?></td>
                                <td>
                                    <div class="action-controls">                                        
                                        <a href="<?php echo admin_url("faculty/viewStudent/" . $s->getId()) ?>" class="action-button" title="View Faculty"><span class="ui-icon ui-icon-arrowthick-1-ne"></span></a>
                                        <a href="<?php echo admin_url("faculty/deleteStudent/" . $s->getId() . "/" . $s->getFaculty()->getId()) ?>" class="action-button delete-image" title="Delete Faculty"><span class="ui-icon ui-icon-trash"></span></a>
                                        <div class="clear"></div>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach ?>  
                    </tbody>

                </table>                
            </form>    

            <div style="clear"></div>
        <?php endif; ?>
    </div>
</div>


