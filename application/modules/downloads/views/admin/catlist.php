<style>
.table_check{ cursor:move;}
</style>
<div id="list-content-wrapper" class="section">
  <h4><span class="ui-icon ui-icon-document"></span>Download Categories
  <a href="<?php echo admin_url('downloads/addcategory')?>" class="section-button"><span class="ui-icon ui-icon-plusthick"></span><span class="icontext">Add new category</span></a>
  </h4>
  
<div class="content">
<?php if (count($categories) > 0):?>
<form name="content-list" id="content-list" method="post" action="">
<table class="data" cellpadding="0" cellspacing="0">
    <thead>
	<th width="2%"><input type="checkbox" name="checkall" id="checkall" /></th>
    <th width="5%">SN</th>
    <th width="65%">Name</th>
    <th width="10%">Published</th>
    <th width="20%">Action</th>
    </thead>
</table>
<ul class="sort_dl" style="list-style-type:none; width:100%; margin:0 0 0 0;">
<?php 
$sn = 1;
foreach($categories as $a):
?>
    <li id="<?php echo 'sl_'.$a['id'];?>">
        <table class="data">
            <tr class="<?php if($sn%2==0) echo 'odd'; else echo 'even';?>" id="sltr_<?php echo $a['id'];?>" >
               <td><input type="checkbox" name="check[]" value="<?php echo $a['id']?>" class="flag-check"></td> 
                <td width="5%" class="table_check tr_sortable" id="slsn_<?php echo $a['id'];?>"><?php echo $sn++;?> </td>				
                <td width="65%"><p class="td_title"><a href="<?php echo admin_url('downloads/editcategory/'.$a['id'])?>"><?php echo $a['name'];?></a></p></td>
                <td width="10%"> <?php
                $pubclass = ($a['status'] == STATUS_ACTIVE) ? 'published':'unpublished';
                echo "<div class='publishflag $pubclass' id='pub_".$a['id']."'></div>";
                ?></td>
                
                <td width="20%" class="action">
                    <div class="action-controls">
                        <a href="<?php echo admin_url('downloads/showitems/'.$a['id']);?>" class="action-button" title="See items in this category"><span class="ui-icon ui-icon-arrowthick-1-ne"></span></a>
                        <a href="<?php echo admin_url('downloads/addfile/'.$a['id'])?>" class="action-button" title="Add an Item"><span class="ui-icon ui-icon-plusthick"></span></a>
                        <a href="<?php echo admin_url('downloads/editcategory/'.$a['id'])?>" class="action-button" title="Edit Category"><span class="ui-icon ui-icon-pencil"></span></a>
                        <!--<a href="<?php //echo admin_url('downloads/delete/'.$a['id']);?>" class="action-button delete" title="Delete Category"><span class="ui-icon ui-icon-trash"></span></a>-->
                    <div class="clear"></div>
                    </div>
                </td>
            </tr>
        </table>
    </li>
<?php endforeach;?>
</ul>
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
		echo 'Download categories not added yet. Start by adding one <a href="'.admin_url("downloads/addcategory").'">here</a>'; 
	endif?>
<?php
if(isset($pagination))
{
?>
<div class="pagination">
    <div class="nxt">
      <?php
            echo $pagination;
        ?>
    </div>
    <div class="clear"></div>
  </div>
<?php
}
?>
  </div>
</div>
  <script type="text/javascript">
  $(function(){
	var prevBackground;
	$('.sort_dl').sortable({		handle				:	'.table_check',
									placeholder			:	'ui-state-highlight',
									forcePlaceholderSize: 	true,
									update				:	function(evt, ui){
															ui.item.css({background:'none'});
															var result=jQuery(".sort_dl").sortable('toArray');
															updateOrder(result);
														},
									start				:	function(e,ui){
															//console.debug(ui);
															prevBackground = ui.item.css('background');
															ui.item.css({background:'#eee'});
														},
									stop				:	function(e,ui){
															ui.item.css({background:prevBackground});
														}
								})
							.disableSelection();
	
	
	
	
	
	//publish unpublish an article
	$('.publishflag').bind('click',function(){
		var obj = $(this);
		var published,
			articleId = obj.attr('id').split('_')[1];
		//obj.toggleClass('published').toggleClass('unpublished');
		if(obj.hasClass('published')) published = '<?php echo STATUS_INACTIVE; ?>';
		else published = '<?php echo STATUS_ACTIVE; ?>';
		
		var data = {id 		: articleId,
					value 	: published}
		
		$.ajax({	type	:	'POST',
					url		:	'<?php echo base_url();?>downloads/ajax/setActivate',
					data	:	data,
					success	:	function(response){
							obj.toggleClass('published').toggleClass('unpublished');
						}
			});
	});  
	
	$('.delete').bind('click',function(){
		var really = confirm("You really want to remove this category? This will delete all the items inside the category as well.");
		if(!really) return false;
	});	 
})
	
function updateOrder(arr)
{
	var num_items=arr.length;	
	var datatosend='ordering=';
	
	for(i=0;i<(num_items-1);i++)
	{
		splt_arr=arr[i].split('_');
		datatosend+=splt_arr[1]+'|';
	}
	splt_arr=arr[i].split('_');
	datatosend+=splt_arr[1];
	
	jQuery.ajax({
		url: '<?php echo base_url();?>downloads/ajax/updateOrder',
		type: 'POST',
		data: datatosend,
		success: function(e){
			updateSerial(arr);
		},
		error: function(e){ 
		}
	});		
}

function updateSerial(arr)
{
	var num_items=arr.length;
	for(i=0;i<(num_items);i++)
			{
				var id = arr[i].split('_')[1];
				var selector = 'tr#sltr_'+id;
				var obj = $(selector);
				var klass = ((i%2) == 0) ? 'odd':'even';
				obj.removeClass().addClass(klass);
				
				//now fix the serial number
				$('td#slsn_'+id).html(i+1);
			}
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