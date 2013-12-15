<html lang="en"><head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../docs-assets/ico/favicon.png">
    <script type="text/javascript"
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAeZtEo0GTFMWMDAWOWRJRLff8wS76_c54&sensor=true">
    </script>
   <style type="text/css">
      #map-canvas { height: 100% }
    </style>
    <title>4th Year Connection</title>

    <!-- Bootstrap core CSS -->
    <link href="../assets/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../docs-assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  <style type="text/css"></style></head>

  <body style="">
    <?php include('./auth.php'); ?>
    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">4th Year Connection</a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                    <li><a href="me.php">welcome, <?php echo($_SERVER['PHP_AUTH_USER']); ?>!</a></li>
                    <li><a href="search.php">search</a></li>
                    <li><a href="profile_update.php">profile</a></li>
                    <li><a href="person_index.php">map</a></li>
                    <li><a href="clubs.php">alumni clubs</a></li>
            </ul>
        </div><!--/.navbar-collapse -->
      </div>
    </div>

    <div class="container">
      <!-- Example row of columns -->
      <div class="row">
        <style>
    body {padding-top:60px; }
    </style>
    </div>
    <script type="text/javascript">
      function initialize() {
        var geocoder = new google.maps.Geocoder();
        var mapOptions = {
          center: new google.maps.LatLng(39.5, -98.35),
          zoom: 4
        };
        var map = new google.maps.Map(document.getElementById("map-canvas"),
            mapOptions);
        <?php 
$db = new DbUtil();
$db->connect();
$res = $db->indexPersonLocation(); 
foreach($res as $row) {
        echo("geocoder.geocode( { 'address': '" . $row['cityName'] . "," . $row['state'] . "'}, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                var marker = new google.maps.Marker({
                    map: map,
                    position: results[0].geometry.location
                });
                var displayString = '<div id=\"content\">'+
                          '<div id=\"siteNotice\">'+
                          '</div>'+
                          '<h3 id=\"firstHeading\" class=\"firstHeading\">".$row['firstName']." ". $row['lastName'] ."</h1>'+
                          '<div id=\"bodyContent\">'+
                          '<ul>'+
                          '<li><b>Location: </b>" . $row['cityName'] . " ," . $row['state'] . "</li>'+
                          '<li><b>Working for: </b>" . $row['companyName'] . "</li>'+
                          '</ul>' +
                          '</div>'+
                          '</div>';
                var infoWindow = new google.maps.InfoWindow({
                  content: displayString
                });

                google.maps.event.addListener(marker, 'click', function () {
                  infoWindow.open(map, marker);
                });
            }
        });");

  }
  $db->disconnect(); 
        ?>
      }
      google.maps.event.addDomListener(window, 'load', initialize);
    </script>

<!--       <footer>
        <p>Hey from footer</p>
      </footer> -->
    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <div id="map-canvas"/>
</body></html>