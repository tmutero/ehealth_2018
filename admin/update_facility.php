
<?php 
  include('../functions.php');

  if (!isAdmin()) {
    $_SESSION['msg'] = "You must log in first";
    header('location: ../login.php');
  }

?>

<!DOCTYPE html >
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/css/font-awesome.min.css" rel="stylesheet">
  <link href="../assets/css/datepicker3.css" rel="stylesheet">
  
    <title>Locating Facility</title>
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 90%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 60%;
        width: 60%;
        margin: 0;
        padding: 0;
      }
    </style>
  </head>
  <body>
    <center></center>
    <div id="map" ></div>
    <div class="container">
    
    <div class="row">
    <div class="col-md-4 col-md-offset-4">
            
                <div class="panel-body">
                    
                        <fieldset>
                             <form role="form"  id="submit_data">
                <div class="form-group">
                  <label>Facility Name</label>
                  <input class="form-control" placeholder="" id="name" name="name">
                </div>
                <div class="form-group">
                    <label>City</label>
                    <select class="form-control" id="city_id" name="city_id" >
                        <?php
                        include('../conn.php');
                        $select="SELECT  * FROM `city`";
                        $run_select=mysqli_query($conn,$select);
                
                        while ($rows=mysqli_fetch_array($run_select)) {
                          $id=$rows['id'];
                          $name=$rows['name'];
                        //var_dump($id);die();

                        
                        ?>

                      <option value=<?php echo $id; ?>><?php echo $name; ?>
                    
                  
                      </option>
                  <?php
                        }

                  ?>
                      
                    </select>
                  </div>
              
                <div class="form-group">
                  <label>Address</label>
                  <textarea class="form-control" rows="2" id="address" name="address"></textarea>
                </div>
                               

                                
                                <div id="result" ></div>
                              </form>
                           <button  class="btn btn-primary" onclick='saveData()'>Submit Button</button>
                        </fieldset>
                   
                </div>
            </div>
  </div>

</div>

                              

  
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBFwpoic3cubV6NO58GKT7RWBIiWC1wPyU&callback=initMap">
    </script>

                            
                                
                                <script src="jquery-1.12.3.min.js"></script>
        

    <script>
      var map;
      var marker;
      var infowindow;
      var messagewindow;

      function initMap() {
        var harare = {lat:-17.823725 , lng: 31.040007 };
        map = new google.maps.Map(document.getElementById('map'), {
          center: harare,
          zoom: 13
        });

        infowindow = new google.maps.InfoWindow({
          content: document.getElementById('form')
        });

        messagewindow = new google.maps.InfoWindow({
          content: document.getElementById('message')
        });

        google.maps.event.addListener(map, 'click', function(event) {
          marker = new google.maps.Marker({
            position: event.latLng,
            map: map
          });


          google.maps.event.addListener(marker, 'click', function() {
            infowindow.open(map, marker);
          });
        });
      }

      function saveData() {
        
        var name = escape(document.getElementById('name').value);
        alert(name);
        var address = escape(document.getElementById('address').value);
        var city_id = document.getElementById('city_id').value;
        var latlng = marker.getPosition();
        var lon = marker.getPosition();
        var url = 'facilityProcessor.php?name=' + name + '&address=' + address +
                  '&city_id=' + city_id + '&lat=' + latlng.lat() + '&lon=' + lon.lng();

        downloadUrl(url, function(data, responseCode) {

          if (responseCode == 200 && data.length <= 1) {
            infowindow.close();
            messagewindow.open(map, marker);
          }
        });
      }

      function downloadUrl(url, callback) {
        var request = window.ActiveXObject ?
            new ActiveXObject('Microsoft.XMLHTTP') :
            new XMLHttpRequest;

        request.onreadystatechange = function() {
          if (request.readyState == 4) {
            request.onreadystatechange = doNothing;
            callback(request.responseText, request.status);
          }
        };

        request.open('GET', url, true);
        request.send(null);
      }

      function doNothing () {
      }

    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCqZNUgpf1A0hbNiAg6A9HTAchLOs5O3EA&callback=initMap">
    </script>
  </body>
</html>