<div class="response info" >Fill in the information below, preview the location, make changes to the position of the marker as required and save the location.</div>
<div id="add-outlet-wrapper" class="section">
    <h4>Add An Outlet</h4>

    <div class="content">
        <div id="map_canvas" style="width: 100%; height: 400px;">Loading map...</div> 
        <form method="post" action="" name="frm_article" id="frm_article">
            <table border="0" width="500" class="form-table">
                
                
                <tr valign='top'>
                    <th scope="row"><label for="name">Name <span class="asterisk">*</span> </label></th>
                    <td><input name="name" id="name" type="text"  value=""  class="required regular-text"/></td>
                </tr>
                <tr valign='top'>
                    <th scope="row"><label for="location">Location <span class="asterisk">*</span> </label></th>
                    <td><input name="location" id="location" type="text"  value=""  class="required regular-text"/></td>
                </tr>
                <tr valign='top'>
                    <th scope="row"><label for="phone">Phone Number <span class="asterisk">*</span> </label></th>
                    <td><input name="phone" id="phone" type="text"  value=""  class="required regular-text"/></td>
                </tr>
               

                <tr valign='top'>
                    <th scope="row"><label for="description">Description <span class="asterisk">*</span> </label></th>
                    <td><textarea name="description" id="description" rows="8" cols="50"></textarea></td>
                </tr>

               
                <tr valign='top' id="email_id" >
                    <th scope="row"><label for="email">Email Id <span class="asterisk">*</span></label></th>
                    <td><input name="email" id="email" type="text"  value=""  class=" regular-text"/></td>
                </tr>



                <tr>
                    <td colspan="2">
                        <input type="hidden" id="lat" name="lat" value="" />
                        <input type="hidden" id="long" name="long" value="" />


                        <label for="add"></label>
                      
                        <input type="button" value="Preview" name="addlocation" class="button" id="addlocation" />
                        <input type="submit" value="Save" name="add_outlet" class="button" id="add_outlet" style="display:none" />
                    </td>
                </tr>

            </table>

        </form>
    </div>

</div>

<script type="text/javascript">
    var map;
    var geocoder;
    var marker = null;

    $(function () {
        $.getScript("http://maps.googleapis.com/maps/api/js?sensor=false&callback=mapInitialize");
<?php /* ?>
  $('#out_type').change(function(){
  var val = $(this).val();

  if(val == 'remitting_agent')
  {
  $('#country_select').show();
  $('#district_select').hide();
  $('select[name=country]').addClass('required');
  $('select[name=invalley]').removeClass('required');
  $('select[name=district]').removeClass('required');
  $('#outlet-in-valley').hide();
  }else{
  $('#country_select').hide();
  $('#district_select').show();
  $('select[name=district]').addClass('required');
  $('select[name=country]').removeClass('required');
  $('select[name=invalley]').addClass('required');
  $('#outlet-in-valley').show();
  }
  });<?php */ ?>
    })

    function mapInitialize()
    {
        var Nepal = new google.maps.LatLng(28.33198, 84.506836);
        geocoder = new google.maps.Geocoder();
        //console.log(Nepal);
        var center = {center: Nepal,
            zoom: 7,
            minZoom: 7,
            streetViewControl: false,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            zoomControlOptions: {style: google.maps.ZoomControlStyle.SMALL}
        };

        map = new google.maps.Map(document.getElementById("map_canvas"), center);

        //add the event listener
        $('#addlocation').click(function () {
            var address = $('#location').val();
            if (address != '')
                putMarker(address);
            else
                return false;
        });
    }

    function putMarker(address) {
        var markerLatLong;
        var country = 'Nepal';
        address = address + ", " + country;
        geocoder.geocode({address: address, region: "np"}, function (results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                markerLatLong = results[0].geometry.location;

                map.setCenter(markerLatLong);
                map.setZoom(15);

                $('#lat').val(markerLatLong.lat());
                $('#long').val(markerLatLong.lng());

                if (marker != null)
                    marker.setMap(null);

                marker = new google.maps.Marker({
                    map: map,
                    position: markerLatLong,
                    draggable: true
                });


                var contentString = $('#description').val();
                //add an info window
                var infowindow = new google.maps.InfoWindow({
                    //content:contentString
                    maxWidth: 200,
                    content: "<strong>" + $('#name').val() + "</strong><br/>" + contentString.replace(/(\r\n|\r|\n)/g, "<br />")
                });
                //console.log(infowindow);
                infowindow.open(map, marker);
                $('#add_outlet').show();

                //dragend marker
                google.maps.event.addListener(marker, 'dragend', function (e) {
                    //console.log(e);
                    markerLatLong = e.latLng;
                    $('#lat').val(markerLatLong.lat());
                    $('#long').val(markerLatLong.lng());
                    map.setCenter(markerLatLong);
                    //alert(markerLatLong.lat());
                });

                //center the maps at the marker when zoomed
                google.maps.event.addListener(map, 'zoom_changed', function () {
                    map.setCenter(markerLatLong);
                });
            } else {
                alert("Geocode was not successful for the following reason: " + status);
            }
        });
    }
</script>


<script type="text/javascript">

    $(function () {

        $('.editor').each(function (i) {
            var id = $(this).attr('id');
            CKEDITOR.replace(id);
        });

        for (instance in CKEDITOR.instances) {
            CKEDITOR.instances[instance].on('blur', function () {
                this.updateElement();
            });
        }


    })
            ;
</script>





<?php /* ?><script type="text/javascript">
  var map;
  var geocoder;
  var marker = null;






  $(function(){
  $.getScript("http://maps.googleapis.com/maps/api/js?sensor=false&callback=mapInitialize");


  })

  function mapInitialize()
  {
  var Nepal = new google.maps.LatLng(28.33198, 84.506836);
  geocoder = new google.maps.Geocoder();
  //console.log(Nepal);
  var center = {	center		: Nepal,
  zoom		: 7,
  minZoom		: 7,
  streetViewControl: false,
  mapTypeId	: google.maps.MapTypeId.ROADMAP,
  zoomControlOptions	: {style:google.maps.ZoomControlStyle.SMALL}
  };

  map = new google.maps.Map(document.getElementById("map_canvas"),center);

  //add the event listener
  $('#addlocation').click(function(){
  var address = $('#location').val();
  if(address != '')
  putMarker(address);
  else return false;
  });
  }

  function putMarker(address) {
  var markerLatLong;

  var country = $('select[name=country]').val();
  address = address+", "+country;
  geocoder.geocode( { address: address,region:"np"}, function(results, status) {
  if (status == google.maps.GeocoderStatus.OK) {
  markerLatLong = results[0].geometry.location;

  map.setCenter(markerLatLong);
  map.setZoom(15);

  $('#lat').val(markerLatLong.lat());
  $('#long').val(markerLatLong.lng());

  if(marker != null) marker.setMap(null);

  marker = new google.maps.Marker({
  map: map,
  position: markerLatLong,
  draggable:true
  });


  var contentString = $('#description').val();
  //add an info window
  var infowindow = new google.maps.InfoWindow({
  //content:contentString
  maxWidth:200,
  content:"<strong>"+$('#name').val()+"</strong><br/>"+contentString.replace(/(\r\n|\r|\n)/g, "<br />")
  });
  //console.log(infowindow);
  infowindow.open(map,marker);
  $('#add_outlet').show();

  //dragend marker
  google.maps.event.addListener(marker, 'dragend', function(e) {
  //console.log(e);
  markerLatLong = e.latLng;
  $('#lat').val(markerLatLong.lat());
  $('#long').val(markerLatLong.lng());
  map.setCenter(markerLatLong);
  });

  //center the maps at the marker when zoomed
  google.maps.event.addListener(map, 'zoom_changed', function() {
  map.setCenter(markerLatLong);
  });
  } else {
  alert("Geocode was not successful for the following reason: " + status);
  }
  });
  }
  </script>
  <?php */ ?>
