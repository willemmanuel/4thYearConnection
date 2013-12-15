<html lang="en"><head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<link rel="shortcut icon" href="../../docs-assets/ico/favicon.png">
<style type="text/css">
  #map-canvas { height: 100% }
</style>
<title>4th Year Connection | Roommate Search</title>

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
            </ul>
            </div><!--/.navbar-collapse -->
          </div>
        </div>

        <div class="container">
          <!-- Example row of columns -->
          <div class="row">
            <style>
              body {padding-top:50px; }
            </style>
            <div class="col-lg-10 col-lg-offset-1 roomies">
            <style>
        .roomies {padding-top:50px;}
      </style>
            <a href="me.php">&larr; Back</a>
            <h2>Company Search</h2>
            <?php 
              $db = new DbUtil();
              $db->connect();
           $res = $db->findCompany($_SERVER['PHP_AUTH_USER']);
              $tb = '<div class="bs-example table-responsive"><table class="table table-striped table-bordered table-hover"><thead><tr><th>Name</th><th>City</th><th>State</th><th>Position</th><th>Computing ID</th><th>Send Message</th></tr></thead><tbody>';
              $te = '</tbody></table></div>'; 
              if($res[0]['computingID']) {
                echo($tb); 
                foreach($res as $row) {
                  echo('<tr>');
                  echo('<td>' . $row['firstName'] . ' ' . $row['lastName'] . '</td>');
                  echo('<td>'. $row['cityName'] . '</td>');
                  echo('<td>'. $row['state'] . '</td>');
                  echo('<td>'. $row['position'] . '</td>');
                  echo('<td><a href="message.php?to=' . $row['computingID'] . '">Message</a></td>');
                  echo('<td><a href="mailto:' . $row['computingID'] . '@virginia.edu"</a>' . $row['computingID'] . '</td>');
                  echo('</tr>'); 
                } 
                echo($te);
              } else if($res['computingID']) {
                echo($tb); 
                echo('<tr>');
                echo('<td>' . $res['firstName'] . ' ' . $res['lastName'] . '</td>');
                echo('<td>'. $res['cityName'] . '</td>');
                echo('<td>'. $res['state'] . '</td>');
                echo('<td>'. $res['position'] . '</td>');
                echo('<td><a href="mailto:' . $res['computingID'] . '@virginia.edu"</a>' . $res['computingID'] . '</td>');
                echo('<td><a href="message.php?to=' . $res['computingID'] . '">Message</a></td>');  
                echo('</tr>');
                echo($te); 
              } else {
                echo("<h4>No results found!</h4>"); 
              }
              $db->disconnect(); 

            ?>
            
          </div>
        </style>
      </div>
    </div>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>

  </body></html>
