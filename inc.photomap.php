<?php
include_once('functions.php');

if (!is_logged_in()) die('<div class="error-message">Error: you need to sign in to access this page.</div>');

include_once('config.php');

//Get user's pictures
  $query = "select picture, date, lat, lon, id
      from {$table_prefix}pictures
      where user_id = " . $_SESSION['userid'];
  //Execute query
  $res = $db->query($query);
  //Check it it was successful 
  if (!$res) {
    die('There was an error running the query [' . $db->error . ']');
  }
?>

  <div id="photomap"></div>

  <script type="text/javascript" id="loadMapsJS">
    var locations = [
    <?php 
      //Fetch the rows
      $i = 0;
      while ($row = $res->fetch_assoc()) {
        $date = date('d/m/Y \a\t H:i', strtotime($row['date']));
        echo "['" . $row['picture'] . "', '" . $date . "', " . $row['lat'] . ", " . $row['lon'] . ", " . $row['id'] . "]";
        if ($i+1 < $res->num_rows) echo ",";
        $i++;
      }
    ?>
    ];

    var map = new google.maps.Map(document.getElementById('photomap'), {
      zoom: 11,
      center: new google.maps.LatLng(55.8554602,-4.2324586),
      mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    var infowindow = new google.maps.InfoWindow();

    var marker, i;

    for (i = 0; i < locations.length; i++) {  
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][2], locations[i][3]),
        map: map
      });

      google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
          var imgDiv = document.createElement('div');
          imgDiv.innerHTML = '<img src="' +  locations[i][0] + '" style="width:300px;" /><br />Date: ' + locations[i][1];
          infowindow.setContent(imgDiv);
          infowindow.open(map, marker);
        }
      })(marker, i));
    }
    </script>