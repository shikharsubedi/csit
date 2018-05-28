<style type="text/css">
.ul_ordering{}
.ul_ordering li{ border:1px #999999 solid; margin-bottom:2px;}
.ul_ordering li a{text-decoration:none;background-color:#ebebeb; display:block; padding:3px; color:#000;font-weight:bold;cursor:move;}
.ul_ordering li a:hover{background-color:#dddddd;}
.ui-state-highlight { height: 1.5em; line-height: 1.2em; }
</style>
<div id="tabledata" class="section">
  <h2 class="ico_mug">Short Cuts</h2>  
  <div class="info_bar" ><p style="background:none; padding:0;font-weight:bold;">Check the corresponding box to set shortcut and arrange their order on the right side.</p></div>
  <table width="700" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="250">
      
	  <?php
	echo '<ul style="list-style-type:none">';
			foreach($shortcuts->result() as $ps)
			{
				//showpre($rowM);
				
				echo '<li>';
				echo ' <input name="" type="checkbox" value="'.$ps->menu_id.'"  ';
				if($ps->is_permitted=='Y') echo ' checked="checked" ';
				echo '/>';
				echo "<span>".$ps->shortcut_name."</span>";
				echo '</li>';
			}
			echo '</ul>';
    ?></td>
    <td width="250">&nbsp;</td>
      <td width="250" valign="top">
      <ul id="sortable" style="list-style:none;" class="ul_ordering">
    <?php

			foreach($shortcuts->result() as $ps)
			{
				if($ps->is_permitted=='Y')
				{
					?>
    <li id="item_<?php echo $ps->menu_id;?>"> <a href="javascript:void(0)" ><?php echo $ps->shortcut_name;?> </a></li>
    <?php
				}//end if is permitted
			}//end while
			?>
  </ul></td>
    </tr>
  </table>
 
</div>

<script type="text/javascript">

$(function(){
	$('input[type=checkbox]').bind('change',function(){
		//console.log('changed');
		var obj = $(this),
			mode = obj.is(':checked');
		
		var data = {	"user_id"	:	<?php echo Current_User::user()->user_cd?>,
						"add"		:	mode,
						"menu_id"	:	obj.val()};
						
		$.ajax({	"type"	:	"POST",
					"url"	:	"<?php echo base_url();?>xhr/shortcut/set",
					"data"	:	data,
					"success":	function(response){
							//directly append the new shortcut to the sortable list
							if(response == 1)
							{
								if(mode)
								{
									var name = obj.parent('li').children('span').html();
									var html = '<li id="item_'+obj.val()+'"> <a href="javascript:void(0)" >'+name+'</a></li>';
									$('#sortable').append(html);
									
									//todo append to the shortcut panel too
								}else
								{
									var toRemove = $('#sortable li#item_'+obj.val());
									toRemove.hide().remove();
									
									// todo remove from the shortcut panel too
								}
							}
						}
					});
			});
})

</script>
<script type="text/javascript">
jQuery(document).ready(function($){
	//
	jQuery("#sortable").sortable({
		axis: 'y',
		placeholder: "ui-state-highlight",
		update: function(evt, ui) { 
			//console.debug(evt+'----'+ui);
			var result=jQuery("#sortable").sortable('toArray');
			updateOrder(result);
		}

			
		});

	jQuery("#sortable").disableSelection();
});
////////////////////
function updateOrder(arr)
{
	//
	var num_items=arr.length;	
	//console.debug(arr);
	var datatosend='user_id=<?php echo Current_User::user()->user_cd;?>';
	datatosend+='&ordering=';
	
	for(i=0;i<(num_items-1);i++)
	{
		splt_arr=arr[i].split('_');
		datatosend+=splt_arr[1]+'|';
	}
	splt_arr=arr[i].split('_');
	datatosend+=splt_arr[1];
	//alert(datatosend);
	jQuery.ajax({
		//
		url: '<?php echo base_url();?>xhr/shortcut/updateOrder',
		type: 'POST',
		data: datatosend,
		success: function(e){
			//alert(e);
			console.debug(e);
		},
		error: function(e){ 
			//alert('error'+e);
		}
	});		
	//
}
////
</script>