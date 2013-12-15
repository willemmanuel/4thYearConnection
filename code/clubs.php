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
<title>4th Year Connection | Clubs</title>

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
        <?php 
        include('./auth.php'); 
        $db = new DbUtil();
        $db->connect();
        $prsn = $db->getPerson($_SERVER['PHP_AUTH_USER']);
        $db->disconnect(); 
        ?>
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
              body {padding-top:50px; }
            </style>
            <div class="col-lg-6 col-lg-offset-3 clubbing">
              <style>
                .clubbing {padding-top:50px; text-align:center;}
              </style>
              <img src="../assets/images/club.jpg" width="99%"><br>
              <hr>
              <p style="text-align:justify; margin: 0 40px 0 40px">The UVA Global Network is a collection of regional UVA clubs created to connect alumni, parents and friends around the world under the flag of the University of Virginia. Individual networks are powered by our amazing volunteers and supported by the Office of Engagement & Annual Giving.</p>
              <hr>
              <?php 
              $db = new DbUtil();
              $db->connect();
              // WRITE THE FIND CLUB COMMAND

              if ($db->isMember($_SERVER['PHP_AUTH_USER'], $prsn['cityName'], $prsn['state']) == TRUE){
                // list out club members
                $res = $db->findMembers($prsn['cityName'], $prsn['state']);
                $tb = '<div class="bs-example table-responsive"><table class="table table-striped table-bordered table-hover"><thead><tr><th>Name</th><th>City</th><th>State</th><th>Computing ID</th><th>Send Message</th></tr></thead><tbody>';
                $te = '</tbody></table></div>'; 
                if($res[0]['computingID']) {
                  echo("Here is the member list of your club!");
                  echo($tb); 
                  foreach($res as $row) {
                    echo('<tr>');
                    echo('<td>' . $row['firstName'] . ' ' . $row['lastName'] . '</td>');
                    echo('<td>'. $row['cityName'] . '</td>');
                    echo('<td>'. $row['state'] . '</td>');
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
                  echo('<td><a href="mailto:' . $res['computingID'] . '@virginia.edu"</a>' . $res['computingID'] . '</td>');
                  echo('<td><a href="message.php?to=' . $res['computingID'] . '">Message</a></td>');  
                  echo('</tr>');
                  echo($te); 
                } else {
                  echo("<h4>No other members in your club!</h4>"); 
                }

              }
              else{
                $res = $db->findClub($prsn['cityName'], $prsn['state']);
                $tb = '<div class="bs-example table-responsive"><table class="table table-striped table-bordered table-hover"><thead><tr><th>Name</th><th>Contact Email</th><th>Contact Number</th><th>Link to Join</th></tr></thead><tbody>';
                $te = '</tbody></table></div>'; 
              if($res['cityName']) {
                echo("<h3>There is a UVa club in your area!</h3>"); 
                echo('
                      <li class="list-group-item"><b>Name: </b>' . 
                      $res['clubName'] . '  
                      </li>
                      <li class="list-group-item"><b>Contact email: </b><a href="mailto:' . 
                      $res['contactMail'] . '@virginia.edu">' . $res['contactMail'] . '@virginia.edu</a>  
                      </li>
                      <li class="list-group-item"><b>Contact phone: </b>' . 
                        $res['phoneNum'] . '
                      </li>
                      <li class="list-group-item">
                      <a href="joinclub.php?city=' . $res['cityName'] . '&state=' . $res['state'] . '">Join</a>
                      </li>
                    '); 
              } else {
                echo('<h2>No clubs found in your area!</h2> <h4>Create one now! </h4><br>');
                // FORM APPEARS IF NOT A CLUB IN THE CITY AS PERSON 
                echo('<form class="bs-example form-horizontal" action="makeclub.php" method="post">');
                echo('<fieldset>');
                echo('<div class="form-group">');
                echo('<label for="name" class="col-lg-2 control-label">Club Name</label>');
                echo('<div class="col-lg-10">');
                echo('<input type="text" class="form-control" id="clubName" name="clubName" placeholder="Club Name">');
                echo('</div>');
                echo('</div>');
                echo('<div class="form-group">');
                echo('<label for="clubCity" class="col-lg-2 control-label">City</label>');
                echo('<div class="col-lg-5">');
                echo('<input type="text" class="form-control" id="clubCity" name="clubCity" readonly value="' . $prsn['cityName'] . '">');
                echo('</div>');
                echo('<div class="col-lg-5">');
                echo('<input type="text" class="form-control" id="clubState" name="clubState" readonly value="' . $prsn['state'] . '">');
                echo('</div>');
                echo('</div>');
                echo('<div class="form-group">');
                echo('<label for="inputEmail" class="col-lg-2 control-label">Contact Email</label>');
                echo('<div class="col-lg-10">');
                echo('<input type="text" class="form-control" id="inputEmail" readonly value="' . $_SERVER['PHP_AUTH_USER'] . '@virginia.edu">');
                echo('</div>');
                echo('</div> ');
                echo('<div class="form-group">');
                echo('<label for="contactNum" class="col-lg-2 control-label">Contact Number</label>');
                echo('<div class="col-lg-10">');
                echo('<input type="text" class="form-control" name="contactNum" id="contactNum" placeholder="Contact Phone Num.">');
                echo('</div>');
                echo('</div>');
                echo('</fieldset>');
                echo('<div class="form-group">');
                echo('<div class="col-lg-3 ">');
                echo('<input type="submit" class="btn btn-primary"></button>'); 
                echo('</div>');
                echo('</div>');
                echo('</div>');
                echo('</fieldset>');
                echo('</form>');
              }
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
