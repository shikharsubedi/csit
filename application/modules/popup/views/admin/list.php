<div id="list-content-wrapper" class="section">
  <h4><span class="ui-icon ui-icon-document"></span>Popups
  <a href="<?php echo admin_url('popup/add')?>" class="section-button"><span class="ui-icon ui-icon-plusthick"></span><span class="icontext">Add Popup</span></a>
  </h4>
  
  <div class="content">
<?php if (count($popups) > 0):?>
<form name="content-list" id="content-list" method="post" action="">

<table class="data" cellpadding="0" cellspacing="0">
  <thead>
	  <th width="2%"><input type="checkbox" name="checkall" id="checkall" /></th>
      <th width="17%">Title</th>
      <th width="10%">Author</th>
      <th width="13%">Date</th>
      <th width="2%">Status</th>
      <th width="9%">Action</th>
    </thead>
    <tbody>
    	<?php 
		$count = 1;
		foreach($popups as $a):
			$class = ($count > 0) ? "even":"odd";
			$count = $count*(-1);
			
			//format the title
			$title = $a['title'];
			$title = ellipsize($title,25,1);
		?>
    	<tr class="<?php echo $class?>">
			<td><input type="checkbox" name="check[]" value="<?php echo $a['id']?>" class="flag-check"></td>
        	<td><p class="td_title"><a href="<?php echo admin_url('popup/edit/'.$a['id'])?>"><?php echo $title;?></a></p></td>
            <td><?php echo $a['firstname'];?></td>
            <td><?php echo dateMysql($a['created']);?></td>
            
            <td width="5%" align="center"> <?php
				echo $a['status'];
			?></td>
            <td class="action">
            <div class="action-controls">
           
            <a href="<?php echo admin_url('popup/edit/'.$a['id'])?>" class="action-button" title="Edit Article"><span class="ui-icon ui-icon-pencil"></span></a>
            <a href="<?php echo admin_url('popup/delete/'.$a['id']);?>" class="action-button" title="Delete Article"><span class="ui-icon ui-icon-trash"></span></a>
           
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
<?php else: 
		echo 'Popups not added yet. Start by adding one <a href="'.admin_url("popup/add").'">here</a>'; 
	endif?>
</div>
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
?>
  </div>
  <script type="text/javascript">
  $(function(){
	
	//publish unpublish an article
	$('.publishflag').bind('click',function(){
		var obj = $(this);
		var published,
			articleId = obj.attr('id').split('_')[1];
		//obj.toggleClass('published').toggleClass('unpublished');
		if(obj.hasClass('published')) published = 'N';
		else published = 'Y';
		
		var data = {id 		: articleId,
					value 	: published}
		
		$.ajax({	type	:	'POST',
					url		:	'<?php echo base_url();?>popup/ajax/setActivate',
					data	:	data,
					success	:	function(response){
							obj.toggleClass('published').toggleClass('unpublished');
						}
			});
	});  
	
	$('.ui-icon-trash').bind('click',function(){
		var really = confirm("You really want to remove this article?");
		if(!really) return false;
	});	 
})
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