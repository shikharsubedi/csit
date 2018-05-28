<div class="response info">
	<span id="descr">You can sort the dashboard items order by dragging and dropping.</span><span id="hint" style="display:none">Your changes have not been saved. Please click Save Order button at the bottom.</span>
</div>
<div style="margin-bottom:15px;">
  <ul class="dash-nav-cols">
   <?php the_dashboard()?> 
    <!--<div class="clear"></div>-->
  </ul>
</div>
<div class="clear"></div>
	<div class="sort" style="display:none;">
        <form method="post" action="" name="sort-order">
			<input type="hidden" value="" name="order" id="arr-order"/>
			<input type="submit" name="saveorder" class="button" value="Save Order" />
        </form>
    </div>

<script>
$(function(){
	$('.dash-nav-cols > li').css('cursor','move');
	$('.dash-nav-cols').sortable({
		update: updateOrder
	});

function updateOrder() {
	$('span#descr').hide();$('span#hint').show();$('span#hint').css('color','#930');$('.sort:hidden').fadeIn();
	var array = $('.dash-nav-cols').sortable('toArray'), order = '';
	for(var i in array)	order += array[i];$('#arr-order').val(order);
}
});
</script>