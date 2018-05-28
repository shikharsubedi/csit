<div class="section">
<div class="response info">Click and Drag the rows to sort order.</div>
  <h4> Listing Footer Groups
  		<a href="<?php echo admin_url('footer/addgroup')?>" class="section-button"><span class="ui-icon ui-icon-plusthick"></span><span class="icontext">Add a Group</span></a> 
        </h4>
  <div class="content">
	<div class="sort response info" style="display:none">Your changes have not been saved. Please click Save Order button at the bottom.</div>
<?php if (count($groups) > 0):?>
<form name="content-list" id="content-list" method="post" action="">

    <table class="sortable data">
      <thead>
		<th width="2%"><input type="checkbox" name="checkall" id="checkall" /></th>
      	<th width="40%">Group Name</th>
		<th width="10%">Status</th>	
        <th width="20%">Actions</th>
        </thead>
      <tbody id="toArray">
      <?php foreach($groups as $t):?>
        <tr id="<?php echo $t['id']?>">
		  <td><input type="checkbox" name="check[]" value="<?php echo $t['id']?>" class="flag-check"></td>
          <td><?php echo $t['name']?></td>
		  <td><?php echo ($t['active']==1) ? 'Active':'Inactive'?></td>
          <td class="actions">
          	<div class="action-controls">
            	<a href="<?php echo admin_url('footer/addfooter/'.$t['id'])?>" class="action-button" title="Add a Link"><span class="ui-icon ui-icon-plusthick"></span></a>
                <a href="<?php echo admin_url('footer/editgroup/'.$t['id'])?>" class="action-button" title="Edit Group"><span class="ui-icon ui-icon-pencil"></span></a>
                <a href="<?php echo admin_url('footer/viewfooters/'.$t['id']);?>" class="action-button" title="View Links"><span class="ui-icon ui-icon-arrowthick-1-ne"></span></a>
                <a href="<?php echo admin_url('footer/deletegroup/'.$t['id']);?>" class="action-button delete" title="Delete Group"><span class="ui-icon ui-icon-trash"></span></a>
              <div class="clear"></div>
            </div></td>
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
<?php else: 
		echo 'Footer not added yet. Start by adding one <a href="'.admin_url("footer/addgroup").'">here</a>'; 
	endif?>
	<div style="clear"></div>
    <div class="sort" style="display:none; margin-top:20px">
        <form method="post" action="" name="sort-member">
			<input type="hidden" value="" name="order" id="arr-order"/>
			<input type="submit" name="saveorder" class="button" value="Save Order" />
        </form>
    </div>
  </div>
</div>
<script>
$('.ui-icon-trash').click(function () {
	var sure = confirm('You really want to remove this team?');
	if (!sure) return false;
	});

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