<div class="section">
	
	<h4>Manage College
    	<a href="<?php echo admin_url("college/addcollege")?>" class="section-button" title="Add new media"><span class="ui-icon ui-icon-plusthick"></span><span class="icontext">Add New College</span></a>
    </h4>                
    <div class="content">
	<div class="sort response info" style="display:none">Your changes have not been saved. Please click Save Order button at the bottom.</div>
  <?php if(count($college)): ?> 
  
	<form name="content-list" id="content-list" method="post" action="">
    <table class="sortable data" cellpadding="0" cellspacing="0">
      <thead>
		<th width="2%"><input type="checkbox" name="checkall" id="checkall" /></th>
		
		<th width="">Name</th>  
		<th width="">Address</th>
		<th width="">Email</th>   
		<th width="">Contact</th>  
		<th width="5%">Status</th>
        <th width="15%">Action</th>
      </thead>
	  
	  <tbody id="toArray">
        <?php foreach ($college as $c):?> 
        <tr id="<?php echo $c->id()?>">
			<td><input type="checkbox" name="check[]" value="<?php echo $c->id()?>" class="flag-check"></td>
			
			<td><?php echo ucfirst($c->getName())?></td> 
			<td><?php echo $c->getAddress() ?></td>
			<td><?php echo $c->getEmail() ?></td>
			<td><?php echo $c->getContact() ?></td>
			<td>
				<?php 
					if($c->getStatus() == 1){
						echo "Active";
					}else{
						echo "Inactive";
					}
				?>
			</td>
            <td>
            	<div class="action-controls">
								
				<a href="<?php echo admin_url("college/editcollege/".$c->id()) ?>" class="action-button" title="View and Edit College"><span class="ui-icon ui-icon-pencil"></span></a>
            <a href="<?php echo admin_url("college/deletecollege/".$c->id()) ?>" class="action-button delete-image" title="Delete College"><span class="ui-icon ui-icon-trash"></span></a>
            <div class="clear"></div>
         </div>
            </td>
            </tr>
        <?php endforeach?>  
        </tbody>
		
    </table>
	
	
<table class="form-table">
    	<tr>
        	<td width="10%">
            	<select name="action">
                	<option value="publish">Publish selected items</option>
                    <option value="unpublish">Unpublish selected items</option>
                    <option value="delete">Delete selected items</option>
                </select>
            </td>
            <td align="left">
            	<input type="submit" name="update" value="Update" class="button update" />
            </td>
        </tr>
    </table>
</form>
    <?php else: ?>  
		No items available yet. Start by adding one <a href="<?php echo admin_url("college/addcollege")?>" >here</a>
	<?php endif?>  
	<div style="clear"></div>
		<div class="sort" style="display:none; margin-top:20px">
			<form method="post" action="" name="sort-member">
				<input type="hidden" value="" name="order" id="arr-order"/>
				<input type="submit" name="saveorder" class="button" value="Save Order" />
			</form>
		</div>
  </div>
</div>

<script type="text/javascript">
$(function(){
	$('.delete-image').bind('click',function(e){
		var really = confirm("You really want to remove this item?");
		if(!really) return false;
	});
	
	
	$('tbody > tr').css({'cursor':'move'});

	var fixHelper = function(e, ui) {
		ui.children().each(function() {
		$(this).width($(this).width());
	});
	return ui;
	};


	$('.sortable tbody').sortable({	
									update:updateOrder,
									helper: fixHelper
									})
		.disableSelection();
})

function updateOrder(e,ui) {
	
	$('.sort:hidden').fadeIn();
	var array = $('#toArray').sortable('toArray'),
		order = '';
	for(var i in array)	order += array[i]+'&';
	order = order.substr(0,order.length-1);
	$('#arr-order').val(order);
}

</script>
<script>
$('#checkall').bind('click',function(){
		var boxes = $(this).parents('form').find('.flag-check');
		boxes.attr('checked',$(this).is(':checked'));
	});

$('.update').bind('click',function(e){
		if ($(".flag-check:checked").length < 1) { 
			$('#checkall').attr('checked',false);
			alert('Nothing selected!');
			return false;
		}
		var really = confirm("You really want to apply changes to selected items?");
		if(!really) return false;
	});
</script>

