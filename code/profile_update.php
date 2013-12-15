<html lang="en"><head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<link rel="shortcut icon" href="../../docs-assets/ico/favicon.png">

<title>4th Year Connection | Update</title>

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
            <div class="col-md-10 col-md-offset-1 update">
              <style>
                .update {padding-top:40px;}
              </style>
              <div class="well" id="update">
                <form class="bs-example form-horizontal" action="update.php" method="post">
                  <fieldset>
                    <legend>Profile Update</legend>
                    <?php 
                    include('./auth.php'); 
                    $db = new DbUtil();
                    $db->connect();
                    $res = $db->getPerson($_SERVER['PHP_AUTH_USER']);
                    $db->disconnect(); 
                    ?>
                    <div class="form-group">
                      <label for="name" class="col-lg-2 control-label">Name</label>
                      <div class="col-lg-5">
                        <input type="text" class="form-control" id="firstName" name="firstName" value="<?php echo $res['firstName'];  ?>">
                      </div>
                      <div class="col-lg-5">
                        <input type="text" class="form-control" id="lastName" name="lastName" value="<?php echo $res['lastName'];  ?>">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputEmail" class="col-lg-2 control-label">Email</label>
                      <div class="col-lg-10">
                        <input type="text" class="form-control" id="inputEmail" disabled value="<?php echo($_SERVER['PHP_AUTH_USER']); ?>@virginia.edu">
                      </div>
                    </div> 
                    <div class="form-group">
                      <label for="select" class="col-lg-2 control-label">School</label>
                      <div class="col-lg-10">
                        <select class="form-control" id="select" name="school">
                          <option value="<?php echo $res['school'];  ?>" selected><?php echo $res['school'];  ?> (Current school)</option>
                          <option value="CLAS" selected>College of Arts and Sciences</option>
                          <option value="ENGR">Engineering</option>
                          <option value="NURS">Nursing</option>
                          <option value="ARCH">Architecture</option>
                          <option value="Curry">Education</option>
                          <option value="COMM">Commerce</option>
                          <option value="PPOL">Batten</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="major" class="col-lg-2 control-label">Major</label>
                      <div class="col-lg-10">
                        <input type="text" class="form-control" name="major" id="major" value="<?php echo $res['major']; ?>" placeholder="Major">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="minor" class="col-lg-2 control-label"></label>
                      <div class="col-lg-10">
                        <input type="text" class="form-control" name="minor" id="minor" value="<?php echo $res['minor'];  ?>" placeholder="Minor / Second Major">
                      </div>
                    </div>
                  </fieldset>
                  <fieldset>
                    <legend>Where do you live?</legend>
                    <div class="form-group">
                      <label for="locale" class="col-lg-2 control-label">Living in</label>
                      <div class="col-lg-3">
                        <input type="text" class="form-control" id="city" name="city" value="<?php echo $res['cityName'];  ?>">
                      </div>
                      <div class="col-lg-3">
                        <select class="form-control" name="state" id="state" value="<?php echo $res['state'];  ?>">
                          <option value="<?php echo $res['state'];  ?>" selected><?php echo $res['state'];  ?> (Current state)</option>
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
                      <label for="searchRoom" class="col-lg-2 control-label" style="padding-top: 0px; ">Looking for Roommates?</label>
                         <div class="col-lg-1">
                        <input type="checkbox" name="searchRoom" class="form-control" id="searchRoom" <?php if($res['searchRoom'] == 1) echo 'checked="checked"'; ?>>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="company" class="col-lg-2 control-label">Working for</label>
                      <div class="col-lg-10">
                        <input type="text" name="companyName" class="form-control" id="companyName" value="<?php echo $res['companyName'];  ?>" placeholder="Company">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="position" class="col-lg-2 control-label">Position</label>
                      <div class="col-lg-10">
                        <input type="text" name="position" class="form-control" id="position" value="<?php echo $res['position'];  ?>" placeholder="Position">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-lg-10 col-lg-offset-2">
                      <input type="submit" class="btn btn-primary"></button> 
                    </div>
                  </div>
                </fieldset>
              </form>
            </div>
          </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>

  </body></html>