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
    <title>4th Year Connection | Search</title>

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
    body {padding-top:50px; }
    </style>
 <div class="col-md-10 col-md-offset-1 signup">
      <style>
        .signup {padding-top:40px;}
      </style>
            <div class="well" id="search">
              <form class="bs-example form-horizontal" action="search.php" method="get">
                <fieldset>
                  <legend>Search for Grads</legend>
                  <div class="form-group">
                    <div class="col-lg-3">
                      <input type="text" class="form-control" id="firstName" name="firstName" placeholder="First Name">
                    </div>
                    <div class="col-lg-3">
                      <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Last Name">
                    </div>
                     <div class="col-lg-3">
                      <input type="text" class="form-control" name="major" id="major" placeholder="Major">
                    </div>
                      <div class="col-lg-3">
                      <input type="text" name="companyName" class="form-control" id="companyName" placeholder="Company/School">
                    </div>
      
                  </div>
                  <div class="form-group">
                  	              <div class="col-lg-3">
                      <input type="text" class="form-control" id="city" name="city" placeholder="City">
                    </div>
                    <div class="col-lg-3">
                      <select class="form-control" name="state" id="state">
                          <option value="" selected>Select a state</option>
                          <option value="AL">Alabama</option>
                          <option value="AK">Alaska</option>
                          <option value="AZ">Arizona</option>
                          <option value="AR">Arkansas</option>
                          <option value="CA">California</option>
                          <option value="CO">Colorado</option>
                          <option value="CT">Connecticut</option>
                          <option value="DE">Delaware</option>
                          <option value="DC">District Of Columbia</option>
                          <option value="FL">Florida</option>
                          <option value="GA">Georgia</option>
                          <option value="HI">Hawaii</option>
                          <option value="ID">Idaho</option>
                          <option value="IL">Illinois</option>
                          <option value="IN">Indiana</option>
                          <option value="IA">Iowa</option>
                          <option value="KS">Kansas</option>
                          <option value="KY">Kentucky</option>
                          <option value="LA">Louisiana</option>
                          <option value="ME">Maine</option>
                          <option value="MD">Maryland</option>
                          <option value="MA">Massachusetts</option>
                          <option value="MI">Michigan</option>
                          <option value="MN">Minnesota</option>
                          <option value="MS">Mississippi</option>
                          <option value="MO">Missouri</option>
                          <option value="MT">Montana</option>
                          <option value="NE">Nebraska</option>
                          <option value="NV">Nevada</option>
                          <option value="NH">New Hampshire</option>
                          <option value="NJ">New Jersey</option>
                          <option value="NM">New Mexico</option>
                          <option value="NY">New York</option>
                          <option value="NC">North Carolina</option>
                          <option value="ND">North Dakota</option>
                          <option value="OH">Ohio</option>
                          <option value="OK">Oklahoma</option>
                          <option value="OR">Oregon</option>
                          <option value="PA">Pennsylvania</option>
                          <option value="RI">Rhode Island</option>
                          <option value="SC">South Carolina</option>
                          <option value="SD">South Dakota</option>
                          <option value="TN">Tennessee</option>
                          <option value="TX">Texas</option>
                          <option value="UT">Utah</option>
                          <option value="VT">Vermont</option>
                          <option value="VA">Virginia</option>
                          <option value="WA">Washington</option>
                          <option value="WV">West Virginia</option>
                          <option value="WI">Wisconsin</option>
                          <option value="WY">Wyoming</option>
                     </select>
                  </div>
                    <div class="col-lg-3">
                      <select class="form-control" id="select" name="school">
                        <option value="" selected>Select a school</option>
                        <option value="CLAS">College of Arts and Sciences</option>
                        <option value="ENGR">Engineering</option>
                        <option value="NURS">Nursing</option>
                        <option value="ARCH">Architecture</option>
                        <option value="Curry">Education</option>
                        <option value="COMM">Commerce</option>
                        <option value="PPOL">Batten</option>
                      </select>
                    </div>
                      <div class="col-lg-3">
                      <input type="submit" class="btn btn-primary search" style="padding-left: 75px; padding-right: 75px; margin-right: 10px;"></button> 
                    </div>

                  </div>
                  </div>
                </fieldset>
              </form>
            </div>
          </div>

      <br>
      <div class="col-lg-10 col-lg-offset-1">
                  <?php 
                    if($_GET['firstName'] || $_GET['lastName'] || $_GET['city'] || $_GET['companyName'] || $_GET['state'] || $_GET['major'] || $_GET['school']) {
                      $db = new DbUtil();
                      $db->connect();
                      $res = $db->search($_GET['firstName'], $_GET['lastName'], $_GET['major'], $_GET['companyName'], $_GET['city'], $_GET['state'],  $_GET['school']);
                      $tb = '<div class="bs-example table-responsive"><table class="table table-striped table-bordered table-hover"><thead><tr><th>Name</th><th>Computing ID</th><th>Working for</th><th>Location</th><th>Send Message</th></tr></thead><tbody>';
                      $te = '</tbody></table></div>'; 
                      if($res[0]['computingID']) {
                        echo($tb); 
                        foreach($res as $row) {
                          echo('<tr>');
                          echo('<td>' . $row['firstName'] . ' ' . $row['lastName'] . '</td>');
                          echo('<td><a href="mailto:' . $row['computingID'] . '@virginia.edu"</a>' . $row['computingID'] . '</td>');
                          echo('<td>' . $row['companyName'] . '</td>');
                          echo('<td>' . $row['cityName'] . ', ' . $row['state'] .'</td>');
                          echo('<td><a href="message.php?to=' . $row['computingID'] . '">Message</a></td>'); 
                          echo('</tr>'); 
                        } 
                        echo($te);
                      } else if($res['computingID']) {
                          echo($tb); 
                          echo('<tr>');
                          echo('<td>' . $res['firstName'] . ' ' . $res['lastName'] . '</td>');
                          echo('<td><a href="mailto:' . $res['computingID'] . '@virginia.edu"</a>' . $res['computingID'] . '</td>');
                          echo('<td>' . $res['companyName'] . '</td>');
                          echo('<td>' . $res['cityName'] . ', ' . $res['state'] .'</td>');
                          echo('<td><a href="message.php?to=' . $res['computingID'] . '">Message</a></td>');  
                          echo('</tr>');
                          echo($te); 
                      } else {
                        echo("<h2>No results found!"); 
                      }
                      $db->disconnect(); 
                    } else {
                      echo('<h3>Try a search for grads!</h3>'); 
                    }

                  ?>
      </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>

</body></html>
