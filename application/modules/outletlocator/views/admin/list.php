<div id="outlets-list-wrapper" class="section">

<h4>Manage Outlets
  <a href="<?php echo admin_url('outletlocator/add')?>" class="section-button"><span class="ui-icon ui-icon-plusthick"></span><span class="icontext">Add an Outlet</span></a>
  </h4>
 <div class="content"> 
 <?php if(count($outlets) > 0):	?>
  <table class="data" cellpadding="0" cellspacing="0" width="100%">
  <thead>
    <tr>
   	  <th width="3%">Sn</th>
      <th width="20%">Name</th>
      <th width="20%">Location</th>
        <th width="20%">Description</th>
      <th width="20%">Email</th>
      <th width="4%">Active</th>
      <th width="10%">Action</th>
    </tr>
    </thead>
    <tbody>
    	<?php
        $i = 1;
		foreach($outlets as $a):
		//show_pre($outlets);exit;
		?>
        
    	<tr>
        	<td><?php echo $i++;?></td>
            <td><p class="td_title"><a href="<?php echo admin_url('outletlocator/edit/'.$a['id'])?>"><?php echo $a['name'];?></a></p></td>
        	<td><p class="td_title"><?php echo $a['location'];?></p></td>
            <td><p class="td_title"><?php echo $a['description'];?></p></td>
            <td><p class="td_title"><?php echo $a['email'];?></p></td>
            <td><?php echo $a['status'];?></td>
            
            <td class="action">
            <div class="action-controls">
           
            <a href="<?php echo admin_url('outletlocator/edit/'.$a['id'])?>" class="action-button" title="Edit Outlet"><span class="ui-icon ui-icon-pencil"></span></a>
            <a href="<?php echo admin_url('outletlocator/delete/'.$a['id']);?>" class="action-button remoutlet" title="Delete Outlet"><span class="ui-icon ui-icon-trash"></span></a>
           
            <div class="clear"></div>
         </div>
            
           </td>
        </tr>
        <?php endforeach;?>
    </tbody>
    </table>
    <?php
    else:
		echo "No outlets available yet. Start by adding one <a href=".admin_url('outletlocator/add')." >here</a>";
	endif;?>
   <?php
if(isset($pagination))
{
?>
<div class="pagination">
    <div class="nxt">
      <?php
            echo $pagination;
        ?>
      <!--  <span>1 - 10 of <?php //echo $articles->num_rows();?></span>-->
    </div>
    <div class="clear"></div>
  </div>
<?php
}
?></div>
  </div>
  <script type="text/javascript">
  $(function(){
	$('.remoutlet').bind('click',function(){
		var really = confirm("You really want to remove this outlet?");
		if(!really) return false;
	});	 
})
  </script>