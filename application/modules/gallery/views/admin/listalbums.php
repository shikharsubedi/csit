<div class="section">
	<h4>Gallery Albums
    	<a href="<?php echo admin_url('gallery/add')?>" class="section-button"><span class="ui-icon ui-icon-plusthick"></span><span class="icontext">Add an Album</span></a>
    </h4>
    <div class="content">
	<div class="sort response info" style="display:none">
		Your changes have not been saved. Please click Save Order button at the bottom.
	</div>
        <ul id='sort-albums' style="display:block;">
    	<?php foreach($albums as $a): //echo '<pre>'; \Doctrine\Common\Util\Debug::dump($albums);exit;
?>
        	<li id="<?php echo $a['id'];?>">
            	<div class="album_controls" >
                    <a href="<?php echo admin_url('gallery/delete/'.$a['id'])?>"><span class="ui-icon ui-icon-trash" title="Delete this album"></span></a>
                    <a href="<?php echo admin_url('gallery/edit/'.$a['id'])?>"><span class="ui-icon ui-icon-pencil" title="Edit this Album"></span></a>
                    <a href="#" ><span style="cursor:move;" class="ui-icon ui-icon-arrow-4" title="Click and drag to sort the position of this album."></span></a>
                </div>
            	<img src="<?php echo base_url().'assets/upload/images/album/thumbs/'.$a['cover_image']?>" width="120" />
                <div class="album_name">
                	<?php echo $a['name']?>
                </div>
            </li>
        <?php endforeach;?>
        <div class="clear"></div>
        </ul>
        
    </div>
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
	$('#sort-albums').sortable({ handle:'.ui-icon-arrow-4',placeholder:'placeholder', update:updateOrder,});
	$('#sort-albums li').hover(function(){
									$(this).children('.album_controls').fadeIn();
								},
								function(){
									$(this).children('.album_controls').fadeOut();
								});
	$('.ui-icon-trash').click(function(e){
		var really = confirm('Do you really want to delete this album and all the images in it?');
		if(!really)
			return false;
	});
});

function updateOrder(e,ui) {
	
	$('.sort:hidden').fadeIn();
	var array = $('#sort-albums').sortable('toArray'),
		order = '';
	for(var i in array)	order += array[i]+'&';
	order = order.substr(0,order.length-1);
	$('#arr-order').val(order);
}
</script>