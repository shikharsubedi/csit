<div id="edit-outlet-wrapper" class="section">
    <h4>Edit An Outlet</h4>

    <div class="content">
        <div id="map_canvas" style="width: 100%; height: 400px;">map div</div> 
        <form method="post" action="" name="frm_article" id="frm_article">
            <table border="0" width="500" class="form-table">


                <tr valign='top'>
                    <th scope="row"><label for="name">Name <span class="asterisk">*</span> </label></th>
                    <td><input name="name" id="name" type="text"  value="<?php echo $outlet->getName(); ?>"  class="required regular-text"/></td>
                </tr>

                <tr valign='top'>
                    <th scope="row"><label for="location">Location <span class="asterisk">*</span> </label></th>
                    <td><input name="location" id="location" type="text"  value="<?php echo $outlet->getLocation() ?>"  class="required regular-text"/></td>
                </tr>
                
                <tr valign='top'>
                    <th scope="row"><label for="phone">Phone Number <span class="asterisk">*</span> </label></th>
                    <td><input name="phone" id="phone" type="text"  value="<?php echo $outlet->getPhone() ?>"  class="required regular-text"/></td>
                </tr>

               
                <tr valign='top'>
                    <th scope="row"><label for="description">Description <span class="asterisk">*</span> </label></th>
                    <td><textarea name="description" id="description" rows="8" cols="50"><?php echo $outlet->getDescription(); ?></textarea></td>
                </tr>


                <tr valign='top' id="email_id">
                    <th scope="row"><label for="email">Email Id  <span class="asterisk">*</span></label></th>
                    <td><input name="email" id="email" type="text"  value="<?php echo $outlet->getEmail(); ?>"  class=" regular-text"/></td>
                </tr>

                <tr>
                    <td colspan="2">

                        <input type="hidden" id="lat" name="lat" value="" />
                        <input type="hidden" id="long" name="long" value="" />
                        <label for="add"></label>
                        <input type="button" class="button" value="Preview" name="addlocation" id="addlocation" />
                        <input type="submit" class="button" value="Save" name="add_outlet" id="add_outlet" style="display:none" />
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
    var markerLatLong;



    $(function () {
        $.getScript("http://maps.googleapis.com/maps/api/js?sensor=false&callback=mapInitialize");


    })

    function mapInitialize()
    {
        markerLatLong = new google.maps.LatLng(<?php echo $outlet->getLatitude() . "," . $outlet->getLongitude(); ?>);
        ;
        geocoder = new google.maps.Geocoder();
        //console.log(Nepal);
        var center = {center: markerLatLong,
            zoom: 15,
            minZoom: 7,
            streetViewControl: false,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            zoomControlOptions: {style: google.maps.ZoomControlStyle.SMALL}
        };

        map = new google.maps.Map(document.getElementById("map_canvas"), center);
        putMarker();
        $('#addlocation').click(function () {
            var address = $('#location').val();
            if (address != '')
                doGeocode(address);
            else
                return false;
        });

        google.maps.event.addListener(map, 'zoom_changed', function () {
            map.setCenter(markerLatLong);
        });
    }

    function listenMarker()
    {
//dragend marker
        google.maps.event.addListener(marker, 'dragend', function (e) {
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
        //console.log(contentString);
        //add an info window
        var infowindow = new google.maps.InfoWindow({
            //content:contentString
            content: contentString.replace(/(\r\n|\r|\n)/g, "<br />")
        });
        //console.log(infowindow);
        infowindow.open(map, marker);
        $('#add_outlet').show();

        listenMarker();

    }

    function doGeocode(address) {


        geocoder.geocode({'address': address, region: "np"}, function (results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                markerLatLong = results[0].geometry.location;
                putMarker();
            } else {
                alert("Geocode was not successful for the following reason: " + status);
            }
        });
    }
</script>
