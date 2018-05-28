<?php 
$country= $outletdata[0]['country'];
$location = $outletdata[0]['location'];
$name = $outletdata[0]['name'];
$description = $outletdata[0]['description'];
$district = $outletdata[0]['district'];
$country = $outletdata[0]['country'];
$latitude = $outletdata[0]['latitude'];
$longitude = $outletdata[0]['longitude'];
$email = $outletdata[0]['email'];
?>
<div id="search-result">
	
</div>

<div class="all_container">
<div>
<div style="margin-bottom:15px;margin-top:10px;text-align:right;">
   
  
    <div style="clear:both;"></div>
</div>
<span id="search_result"></span>
<div id="map_canvas" style=" border-bottom-color:#3366FF; width:710px;height:250px; margin-bottom:15px;">Loading map.....</div>
</div>
<script type="text/javascript">
var map;
var geocoder;
var marker = null;
var markerLatLong; 

$(function(){
	$.getScript("http://maps.googleapis.com/maps/api/js?sensor=false&callback=mapInitialize");
	
	
})

function mapInitialize()
{
	markerLatLong = new google.maps.LatLng(<?php echo $latitude ?>,<?php echo $longitude?>);;
	geocoder = new google.maps.Geocoder();
	//console.log(Nepal);
	var center = {	center		: markerLatLong,
					zoom		: 15,
					minZoom		: 7,
					streetViewControl: false,
					mapTypeId	: google.maps.MapTypeId.ROADMAP,
					zoomControlOptions	: {style:google.maps.ZoomControlStyle.SMALL}
				};
	
	map = new google.maps.Map(document.getElementById("map_canvas"),center);
	putMarker();
	/*marker = new google.maps.Marker({
            map: map,
            position: markerLatLong,
			draggable:true
        });
	listenMarker();	*/
	//add the event listener

	
	google.maps.event.addListener(map, 'zoom_changed', function() {
		map.setCenter(markerLatLong);
	});
}

function listenMarker()
{
//dragend marker
		google.maps.event.addListener(marker, 'dragend', function(e) {
			//console.log(e);
			markerLatLong = e.latLng;
			$('#lat').val(markerLatLong.lat());
			$('#long').val(markerLatLong.lng());
			map.setCenter(markerLatLong);
		});
}

function putMarker()
{
	map.setCenter(markerLatLong);
		map.setZoom(7);
		
		if(marker != null) marker.setMap(null);
		
        marker = new google.maps.Marker({
            map: map,
            position: markerLatLong,
			draggable:false
        });
		
		
		//var contentString = '97714240746, 01 4440537, 014102764, bindabasinimusic@yahoo.com ,Aanamnagar, Kathmadu, Nepal';
		var contentString = '<?php echo $latitude;?> , <?php echo $longitude;?>, <?php echo $email;?>,<?php echo $name;?>,<?php echo $location;?>, <?php echo $country;?>';
		//console.log(contentString);
		//add an info window
		var infowindow = new google.maps.InfoWindow({
			//content:contentString
			content:contentString.replace(/(\r\n|\r|\n)/g, "<br />")
		});
		//console.log(infowindow);
		infowindow.open(map,marker);
		$('#add_outlet').show();
		
		listenMarker();
		
}

function doGeocode(address) {
	
	
    geocoder.geocode( { 'address': address,region : "np"}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
		markerLatLong = results[0].geometry.location;
		putMarker();
      } else {
        alert("Geocode was not successful for the following reason: " + status);
      }
    });
  }
</script>


</div>

    
    