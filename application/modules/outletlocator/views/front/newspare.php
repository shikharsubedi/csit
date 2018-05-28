

    
 <?php get_header(); ?>
 <?php get_middle()?>   
          
     <div class="main_con">
    
    	   
    <div id="search-result">
        
    </div>

    <div class="all_container">
    <div>
    <div style="margin-bottom:15px;margin-top:10px;text-align:right;">
       
      
        <div style="clear:both;"></div>
    </div>
    <span id="search_result"></span>
    <div id="map_canvas" style=" border-bottom-color:#3366FF; width:950px;height:500px; margin-bottom:15px;">Loading map.....</div>
    </div>
    <?php
            //show_pre($outlets);
            foreach($outlets as $o)
            {
                $toadd = trim(($o['regions'])) ? trim(($o['regions'])) : 'invalley';
                $json = $toadd;
                if (!isset($$json))
                    $$toadd = "var {$json} = ["; 
                
                $o['description'] = nl2br($o['description']);
                $$toadd .= json_encode($o).",";
                
            }
            
            foreach ($outlets as $o) {
                $toadd = trim(($o['regions'])) ? trim(($o['regions'])) : 'invalley';
                $jsondata[$toadd] = $$toadd;
            }
    
            
            if(!array_key_exists('invalley',$jsondata))
                $jsondata['invalley'] = 'var invalley = []';
                
        
            
            
            
    ?>	
    <script type="text/javascript">
    var map;
    var geocoder;
    var markerCluster = null;
    var markers = [];
    var infowindows = [];
    var geocoder;
    
    
        
        <?php
        
            foreach ($jsondata as $toadd) {
                if(substr($toadd,-1,1) != '[')
                    $toadd = substr($toadd,0,strlen($toadd)-1)."];";
                else
                    $toadd .= "];";
                    
                echo($toadd)."\r\n";	
            }
            
        ?> 
    $(function(){
        
        $.getScript("http://maps.googleapis.com/maps/api/js?sensor=false&callback=mapInitialize");
        
        
    })
    
    function mapInitialize()
    {
        var Nepal = new google.maps.LatLng(28.33198, 84.206836);
        geocoder = new google.maps.Geocoder();
        
        var center = {	center			 	: Nepal,
                        zoom				: 7,
                        minZoom				: 7,
                        streetViewControl	: false,
                        mapTypeId			: google.maps.MapTypeId.ROADMAP,
                        zoomControlOptions	: {style:google.maps.ZoomControlStyle.SMALL}
                    };
        
        map = new google.maps.Map(document.getElementById("map_canvas"),center);
        showValley();
        
        $('#invalley').change(function() {
            
            if ($(this).val() == '1') showValley();
            else if($(this).val() == '2') 
            showMap($('#regions').val());
            
        });
        
    
        google.maps.event.addListener(map, 'zoom_changed', function() {
            var zoom = map.getZoom();
            /*if(zoom == 7)
                map.setCenter(Nepal);
            return;*/
        });
    }
    
    
    
    function showValley()
    {
        
        if(markerCluster != null) clearClusters();
        for(var i in invalley)
        {
            var marker = new google.maps.Marker({animation:google.maps.Animation.DROP,position: new google.maps.LatLng(invalley[i].latitude,invalley[i].longitude)});
            markers.push(marker);
            
            var infowindow = new google.maps.InfoWindow({
                    content:invalley[i].description
                });
            infowindows.push(infowindow);
            listenMarker(marker,infowindow);
        }
        drawCluster();
    }
    
    
    function setSearchView(address)
    {
        
        geocoder.geocode( { 'address': address,region : "np"}, function(results, status) {
          if (status == google.maps.GeocoderStatus.OK) {
            var bounds = results[0].geometry.bounds;
            var count = 0;
            
            for(var i in markers)
            {
                if(bounds.contains(markers[i].getPosition()))
                    count++;
            }
            
            if(count > 0)
            {
                var center = results[0].geometry.location;
                map.setCenter(center);
                map.setZoom(15);
                //map.panToBounds(bounds);
            }
            $('#search_result').html('').html(count+" Spares found near "+ address);
          } else {
            alert("Geocode was not successful for the following reason: " + status);
          }
        });
    
    }
    
    function clearClusters() {
        markerCluster.clearMarkers();
        markers = new Array();
    }
    
    function drawCluster()
    {
        $.getScript('http://google-maps-utility-library-v3.googlecode.com/svn-history/r295/trunk/markerclusterer/src/markerclusterer.js',function(){
            markerCluster = new MarkerClusterer(map, markers);
            //markerCluster.resetViewport();
        });
    }
    
    function listenMarker(marker,infowindow)
    {
        google.maps.event.addListener(marker, 'click', function(e) {
            infowindow.open(map,marker);
        });
    }
    </script>
    
    
    </div>



    <div class="branch_list">
        <?php  if($outlets) { ?>
      <h1>Locations </h1>
        
        
        <table cellpadding="2" cellspacing="1" width="100%">
        <tbody>
            <tr>
                <th width="50">
                S.no
                </th>
                <th>
                Name
                </th>
                <th>
                Places
                </th>
                <?php /*?><th>
                <p align="center">Description</p>
                </th><?php */?>
            </tr>
            <?php $i=1; foreach($outlets as $o) {  ?>
            <tr>
                <td>
                <?php echo $i++;?>
                </td>
                <td>
                <?php echo $o['name']?>
                </td>
                <td>
                <?php echo $o['location']?>
                </td>
               <?php /*?> <td>
                <p><?php echo $o['description']?></p>
                </td><?php */?>
            </tr>
            <?php }?>
        </tbody>
    </table>
        <?php 
        } // end of if
        ?>
    </div>
     
    </div>
                                 		
          
<?php echo Modules::run('service/serviceimage')?>  
<?php get_footer(); ?>
<?php get_script() ?>
