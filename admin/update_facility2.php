
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
  
  
    <title>Locating Facility</title>
   <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      
    </style>
  </head>
  <body>
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-success">
                <div class="panel-heading">
                    <h4 class="panel-title"> <label>Facility Name</label></h4>
                </div>
                <div class="panel-body">
                    
                        <fieldset>
                          
                           
    <form role="form"  id="submit_data">
                <div class="form-group">
                 
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
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="map"></div>

    <script>
      var customLabel = {
        restaurant: {
          label: 'R'
        },
        bar: {
          label: 'B'
        }
      };

        function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: new google.maps.LatLng(-33.863276, 151.207977),
          zoom: 12
        });
        var infoWindow = new google.maps.InfoWindow;

          // Change this depending on the name of your PHP or XML file
          downloadUrl('https://storage.googleapis.com/mapsdevsite/json/mapmarkers2.xml', function(data) {
            var xml = data.responseXML;
            var markers = xml.documentElement.getElementsByTagName('marker');
            Array.prototype.forEach.call(markers, function(markerElem) {
              var id = markerElem.getAttribute('id');
              var name = markerElem.getAttribute('name');
              var address = markerElem.getAttribute('address');
              var type = markerElem.getAttribute('type');
              var point = new google.maps.LatLng(
                  parseFloat(markerElem.getAttribute('lat')),
                  parseFloat(markerElem.getAttribute('lng')));

              var infowincontent = document.createElement('div');
              var strong = document.createElement('strong');
              strong.textContent = name
              infowincontent.appendChild(strong);
              infowincontent.appendChild(document.createElement('br'));

              var text = document.createElement('text');
              text.textContent = address
              infowincontent.appendChild(text);
              var icon = customLabel[type] || {};
              var marker = new google.maps.Marker({
                map: map,
                position: point,
                label: icon.label
              });
              marker.addListener('click', function() {
                infoWindow.setContent(infowincontent);
                infoWindow.open(map, marker);
              });
            });
          });
        }



      function downloadUrl(url, callback) {
        var request = window.ActiveXObject ?
            new ActiveXObject('Microsoft.XMLHTTP') :
            new XMLHttpRequest;

        request.onreadystatechange = function() {
          if (request.readyState == 4) {
            request.onreadystatechange = doNothing;
            callback(request, request.status);
          }
        };

        request.open('GET', url, true);
        request.send(null);
      }

      function doNothing() {}
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBFwpoic3cubV6NO58GKT7RWBIiWC1wPyU &callback=initMap">
    </script>
 
   
  </body>
</html>