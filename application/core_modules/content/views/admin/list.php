<div class="section controls">
	<a href="<?php echo admin_url('content/category')?>" class="control-button"><span class="ui-icon ui-icon-folder-open"></span><span class="icontext">Category</span></a>
  
<div class="clear"></div>
</div>

<div id="list-content-wrapper" class="section">
  <h4><span class="ui-icon ui-icon-document"></span>Contents
  <a href="<?php echo admin_url('content/add')?>" class="section-button"><span class="ui-icon ui-icon-plusthick"></span><span class="icontext">Add Content</span></a>
  </h4>
  
  <div class="content">
  <?php /*?><div class="sort response info" style="display:none">Your changes have not been saved. Please click Save Order button at the bottom.</div>   
  <?php */?>
  <form name="filter" method="post" action="">
  	<table class="form-table" style="margin-bottom:10px;" width="100%">
    	<tr>
        	<td width="12%"><label>Content Status</label></td>
        	<td width="8%">
            	<select name="published" id="published">
                	<option value="">Any</option>
                    <option value=<?php echo STATUS_ACTIVE;?> <?php if($this->input->post('published') == STATUS_ACTIVE) echo "selected='selected'";?>>Active</option>
                    <option value=<?php echo STATUS_INACTIVE;?> <?php if($this->input->post('published') == STATUS_INACTIVE) echo "selected='selected'";?>>Inactive</option>
                </select>
            </td>
            <td width="4%"><label>Type</label></td>
            <td width="9%">
            	<select name="type" id="type">
                	<option value="">Any</option>
                    
                    <?php foreach($content_types as $type):?>
                	<option value="<?php echo $type;?>"><?php echo $type;?></option>
                	<?php endforeach;?>
                    
                </select>
            </td>
            <td>
            	<input type="submit" name="filter" value="Filter" class="button" />
            </td>
            <td align="right" style="width:25em;">
            	<input type="text" name="search-key" placeholder="search content" class="regular-text" />
            </td>
            <td align="right" style="width:90px">
            <input type="submit" name="search" value="Search" class="button" />
            </td>
        </tr>
    </table>
  </form>
  
  <form name="content-list" id="content-list" method="post" action="">
  <table class="data sortable" cellpadding="0" cellspacing="0">
  
  <thead>
  	  <th width="2%"><input type="checkbox" name="checkall" id="checkall" /></th>
      <th width="17%">Article</th>
      <th width="5%">Type</th>
      <th width="10%">Author</th>
      <th width="10%">Updates</th>
      <th width="2%">Status</th>
      <th width="9%">Date</th>
      <th width="9%">Action</th>
    </thead>
    <tbody id="toArray">
    	<?php 
		
		if(count($content) == 0)
		{
			echo "<tr><td colspan='8' align='center'>No data available.</td></tr>";
		}else{
		$count = 1;
		foreach($content as $a):
			$class = ($count > 0) ? "even":"odd";
			$count = $count*(-1);
			
			//format the title
			$title = $a->getTitle();
			$title = ellipsize($title,35,1);
			
			$author = $a->getAuthor();
		?>
    	<tr class="<?php echo $class?>" id="<?php echo $a->id();?>">
        	<td><input class="flag-check" type="checkbox" name="check[]" value="<?php echo $a->id();?>" /></td>
        	<td><p class="td_title"><a href="<?php echo admin_url('content/edit/'.$a->id())?>"><?php echo $title;?></a></p></td>
            <td><?php echo $a->getType();?></td>
            <td><?php echo $author->getFirstname()." ".$author->getLastname();?></td>
            <td><input class="flag-check check" type="checkbox" name="updatenews" value="<?php echo $a->id();?>" <?php if($a->getUpdatenews() == 1) echo "checked='checked'";?>/></td>
            <td><?php echo $a->getStatus();?></td>
            
            
            <td><?php echo $a->created()->format('F j, Y');?></td>
            <td class="action">
            
            <div class="action-controls">
           
            <a href="<?php echo admin_url('content/edit/'.$a->id())?>" class="action-button" title="Edit Article"><span class="ui-icon ui-icon-pencil"></span></a>
            <a href="<?php echo admin_url('content/delete/'.$a->id());?>" class="action-button delete" title="Delete Article"><span class="ui-icon ui-icon-trash"></span></a>
           
            <div class="clear"></div>
         </div>
            
        </td>
        </tr>
        <?php 
				endforeach;
			}
		?>
        
    </tbody>
    </table>
    <table class="form-table">
    	<tr>
        	<td width="10%">
            	<select name="action">
                	<option value="publish">Publish selected contents</option>
                    <option value="unpublish">Unpublish selected contents</option>
                    <option value="delete">Delete selected contents</option>
                </select>
            </td>
            <td align="left">
            	<input type="submit" name="act-content" value="Update" class="button" />
            </td>
        </tr>
    </table>
    </form>
    </div>
   <?php
if(isset($pagination))
{
?>
<div class="pagination">
  <?php
        echo $pagination;
    ?>
  </div>
<?php
}
?>

<?php /*?><div class="sort" style="display:none; margin-top:20px">
	<form method="post" action="" name="sort-member">
		<input type="hidden" value="" name="order" id="arr-order"/>
		<input type="submit" name="saveorder" class="button" value="Save Order" />
	</form>
</div><?php */?>

</div>
  
  <script type="text/javascript">
  $(function(){
	
	$('#content-list').bind('submit',function(){
		if ($(".flag-check:checked").length < 1) { 
			$('#checkall').attr('checked',false);
			alert('Nothing selected!');
			return false;
		}
		var really = confirm("Please confirm if you want to apply this batch operation.");
		if(!really) return false;
	});

	$('.delete').bind('click',function(){
		var really = confirm("You really want to remove this content?");
		if(!really) return false;
	});	 
	
	$('#checkall').bind('click',function(){
		var boxes = $(this).parents('form').find('.flag-check');
		boxes.attr('checked',$(this).is(':checked'));
	});
  $(".check").click(function(){
     var checked = $(this).attr('checked');
    
   if(checked){

      var value = $(this).val();
      // alert(value);
         jQuery.ajax({
            url: '<?php echo admin_url("content/updatenews") ?>',

            // How the data is sent.
            type: 'POST',
            data: {"id":value,"vals":1},
            jsonp: true,
            success: function (data) {
              console.log(data);
            },
            error: function (data) {

            }
        });
       }else{
           var value = $(this).val();
      
         jQuery.ajax({
            url: '<?php echo admin_url("content/updatenews") ?>',

            // How the data is sent.
            type: 'POST',
            data: {"id":value,"vals":0},
            jsonp: true,
            success: function (data) {
              console.log(data);
            },
            error: function (data) {

            }
        });

       }
});
	
})
  </script>
  
<?php /*?><script type="text/javascript">
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

function updateOrder(e,ui) {
	
	$('.sort:hidden').fadeIn();
	var array = $('#toArray').sortable('toArray'),
		order = '';
	for(var i in array)	order += array[i]+'&';
	order = order.substr(0,order.length-1);
	$('#arr-order').val(order);
}

</script><?php */?>