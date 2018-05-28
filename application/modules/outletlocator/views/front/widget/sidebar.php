<div class="widget">
<div style="padding:6px 6px 0 6px;background:#F0F0F0">
<h1>Our ATMs</h1>
	<div style="width:222px; height:200px; margin-bottom:10px; border:#a0a0a0 1px solid;" id="map_canvas_widget">
    	map
    </div>
    <div class="content">
    	<p><?php echo $atminvalley." ATMs inside valley."?></p>
        <p><?php echo $atmnotinvalley." ATMs outside valley."?></p>
    	<p><a href="<?php echo base_url();?>outlet-locator" class="more">View all</a></p>
    </div>
</div>    
</div>
<script type="text/javascript">
var map;
var marker;
$(function(){
	$.getScript("http://maps.googleapis.com/maps/api/js?sensor=false&callback=mapInitialize");
})

function mapInitialize()
{
	var def = new google.maps.LatLng(<?php echo $default->latitude.','.$default->longitude;?>);
	
	var center = {	center			 	: def,
					zoom				: 14,
					minZoom				: 7,
					streetViewControl	: false,
					zoomControl			: false,
					scrollwheel			: false,
					draggable			: false,
					mapTypeControl		: false,
					panControl			: false,
					mapTypeId			: google.maps.MapTypeId.ROADMAP,
					zoomControlOptions	: {style:google.maps.ZoomControlStyle.SMALL}
				};
	
	map = new google.maps.Map(document.getElementById("map_canvas_widget"),center);
	marker = new google.maps.Marker({
            map: map,
            position: def
        });	
}
</script>