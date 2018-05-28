<div class="section">
<div class="response info">Click and Drag the rows to sort order.</div>

  <h4>View Footer Links(s) - [ <?php echo $group?> ] <a href="<?php echo admin_url('footer/addfooter/'.$group_id)?>" class="section-button" title="Add new footers on <?php echo $group?>"><span class="ui-icon ui-icon-plusthick"></span><span class="icontext">Add Link</span></a></h4>
  <div class="content">
    <div class="sort response info" style="display:none">Your changes have not been saved. Please click Save Order button at the bottom.</div>
  <?php if($footers):?>
<form name="content-list" id="content-list" method="post" action="">

    <table class="sortable data" cellpadding="0" cellspacing="0">
      <thead>
		<th width="2%"><input type="checkbox" name="checkall" id="checkall" /></th>
        <th width="20%">Link Label</th>
        <th width="20%">URL/Page</th>
        <th width="5%">Status</th>
        <th width="15%">Action</th>
      </thead>
<tbody id="toArray">
        <?php
        	foreach($footers as $k => $i):
				$url = $i['url'];
				
				if($i['type'] == 'internal')
				{
					//this should not be done in view but for now
					$page = $this->doctrine->em->find('content\models\Content',$url);
					
					//the page might be already deleted
					if(!$page){
						$url = '#';
					}
					else{
						$url = site_url('content/'.$page->getSlug());
						unset($page);
					}
				}	
					
		?>
        <tr id="<?php echo $i['id']?>">
			<td><input type="checkbox" name="check[]" value="<?php echo $i['id']?>" class="flag-check"></td>
        	<td><?php echo $i['title']?></td>
            <td><?php echo $url?></td>
            <td><?php echo $i['active']?'Active':'Inactive'?></td>
            <td>
            	<div class="action-controls">
            <a href="<?php echo admin_url('footer/editfooter/'.$i['id'])?>" class="action-button" title="Edit Link"><span class="ui-icon ui-icon-pencil"></span></a>
            <a href="<?php echo admin_url('footer/deletefooter/'.$i['id'])?>" class="action-button delete-link" title="Delete Link"><span class="ui-icon ui-icon-trash"></span></a>
            
            <div class="clear"></div>
         </div>
            </td>
         </tr>
        <?php endforeach;?>
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
    <?php 
	else : 
		echo "No items available yet. Start by adding one <a href=".admin_url('footer/addfooter/'.$group_id)." >here</a>.";
	endif;
	?>
    
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
		
	$('.delete-link').bind('click',function()
	{
		var really = confirm("You really want to remove this footer link?");
		if(!really) return false;
	});
})

function updateOrder(e,ui)
{
	$('.sort:hidden').fadeIn();
	var array = $('#toArray').sortable('toArray'),
		order = '';
	for(var i in array)
	{
		order += array[i]+'&';
	}
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