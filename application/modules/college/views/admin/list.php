<div class="section">
    
    <h4>Manage University
        <a href="<?php echo admin_url("college/add")?>" class="section-button" title="Add new media"><span class="ui-icon ui-icon-plusthick"></span><span class="icontext">Add New University</span></a>
        <a href="<?php echo admin_url("college/listAllCollege")?>" class="section-button" title="Add new media"><span class="ui-icon ui-icon-arrowthick-1-ne"></span><span class="icontext">College</span></a>
    </h4>                
    <div class="content">
   
  <?php if(count($university)): ?> 
  
    <form name="content-list" id="content-list" method="post" action="">
    <table class="sortable data" cellpadding="0" cellspacing="0">
      <thead>
        
        <th width="">Name</th>  
        <th width="5%">Status</th>
        <th width="15%">Action</th>
      </thead>
      
      <tbody id="toArray">
        <?php foreach ($university as $u):?> 
        <tr id="<?php echo $u->id()?>">
           
            
            <td><?php echo ucfirst($u->getName())?></td> 
            <td>
                <?php 
                    if($u->getStatus() == 1){
                        echo "Active";
                    }else{
                        echo "Inactive";
                    }
                ?>
            </td>
            <td>
                <div class="action-controls">
                                <a href="<?php echo admin_url("college/listcollege/".$u->id()) ?>" class="action-button" title="Add Faqs"><span class="ui-icon ui-icon-arrowthick-1-ne"></span></a>
                
                
                <a href="<?php echo admin_url("college/edit/".$u->id()) ?>" class="action-button" title="View and Edit Faqcat"><span class="ui-icon ui-icon-pencil"></span></a>
            <a href="<?php echo admin_url("college/delete/".$u->id()) ?>" class="action-button delete-image" title="Delete Faqcat"><span class="ui-icon ui-icon-trash"></span></a>
            <div class="clear"></div>
         </div>
            </td>
            </tr>
        <?php endforeach?>  
        </tbody>
        
    </table>
    
    

</form>
    <?php else: ?>  
        No items available yet. Start by adding one <a href="<?php echo admin_url("college/add")?>" >here</a>
    <?php endif?>  
    <div style="clear"></div>
        
  </div>
</div>

<script type="text/javascript">
$(function(){
    $('.delete-image').bind('click',function(e){
        var really = confirm("You really want to remove this item?");
        if(!really) return false;
    });
  })



</script>


