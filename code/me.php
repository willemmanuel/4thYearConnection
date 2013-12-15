<html lang="en"><head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../docs-assets/ico/favicon.png">

    <title>4th Year Connection</title>

    <!-- Bootstrap core CSS -->
    <link href="../assets/css/bootstrap.css" rel="stylesheet">
    <link href="../assets/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../docs-assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>

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
                    <li><a href="export.php">export</a></li>
            </ul>
        </div><!--/.navbar-collapse -->
      </div>
    </div>
  <br>
  <?php 
     include('./auth.php'); 
     $db = new DbUtil();
     $db->connect();
     $stats = $db->getStats($_SERVER['PHP_AUTH_USER']); 
     $db->disconnect(); 
  ?>
  <div class="col-lg-10 col-lg-offset-1" style="padding-top:43px">
    <h2>Dashboard</h2>
    <hr>
  </div>
      <div class="col-lg-10 col-lg-offset-1">
<div class="col-lg-4 col-sm-6">
            <div class="panel panel-warning">
              <div class="panel-heading">
                <h2 class="panel-title">Wahoos at your company!</h2>
              </div>
              <div class="panel-body">
                There <?php if($stats['numCompany']==1) echo "is" ; else echo "are"; ?> <b><u><?php echo $stats['numCompany']?></u></b> UVa <?php if($stats['numCompany']==1) echo "grad" ; else echo "grads"; ?> working for your company. <a href="companyList.php">Message them now!</a>
              </div>
            </div>
  </div>
  <div class="col-lg-4">
            <div class="panel panel-success">
              <div class="panel-heading">
                <h3 class="panel-title">Cavaliers in your city!</h3>
              </div>
              <div class="panel-body">
                There <?php if($stats['numCity']==1) echo "is" ; else echo "are"; ?> <b><u><?php echo $stats['numCity']?></u></b> UVa <?php if($stats['numCity']==1) echo "grad" ; else echo "grads"; ?> moving to your city. <a href="cityList.php">View them now</a> to get in contact! 
              </div>
            </div>
          </div>
            <div class="col-lg-4">
            <div class="panel panel-danger">
              <div class="panel-heading">
                <h3 class="panel-title">Roomates available</h3>
              </div>
              <div class="panel-body">
                Looking for roommates? So are <b><u><?php echo $stats['numRoom']?></u></b> wahoos in your city, <a href="roommate_search.php">see a list</a> of them now. 
              </div>
            </div>
          </div>
          <br>
          <hr>
        <div class="col-lg-6">
          <h3>Message Inbox</h3>
          <?php 
            $db = new DbUtil();
            $db->connect();
            $res = $db->indexMessage($_SERVER['PHP_AUTH_USER']);
            $tb = '<div class="bs-example table-responsive"><table class="table table-striped table-bordered table-hover" style="table-layout: fixed;
word-wrap: break-word;"><thead><tr><th width="15%">To</th><th width="15%">From</th><th width="55%">Subject</th><th width="15%">Reply</th></tr></thead><tbody>';
            $te = '</tbody></table></div>'; 
            if($res[0]['toID']) {
              echo($tb); 
              foreach($res as $row) {
                echo('<tr class="head">');
                if($row['toID'] == $_SERVER['PHP_AUTH_USER'])
                  echo('<td>me</td>');
                else
                  echo('<td>' . $row['toID'] . '</td>');
                if($row['fromID'] == $_SERVER['PHP_AUTH_USER'])
                  echo('<td>me</td>');
                else 
                  echo('<td>' . $row['fromID'] . '</td>');
                echo('<td>' . $row['subject'] . '</td>');
                if($row['toID'] != $_SERVER['PHP_AUTH_USER']) {
                  echo('<td><a href="message.php?to=' . $row['toID'] . '">Send</a></td>'); 
                }
                else {
                  echo('<td><a href="message.php?to=' . $row['fromID'] . '">Send</a></td>'); 
                }
                echo('</tr>'); 
                echo('<tr><td></td><td colspan="4"><b>Sent on: </b>' . $row['sent']. '</br><b>Body: </b>'. $row['message']. '</td></tr>'); 
              } 
              echo($te);
            } else if($res['toID']) {
                echo($tb); 
                echo('<tr class="head">');
                if($row['toID'] == $_SERVER['PHP_AUTH_USER'])
                  echo('<td>me</td>');
                else
                  echo('<td>' . $res['toID'] . '</td>');
                if($row['fromID'] == $_SERVER['PHP_AUTH_USER'])
                  echo('<td>me</td>');
                else 
                  echo('<td>' . $res['fromID'] . '</td>');
                echo('<td>' . $res['subject'] . '</td>');
                if($res['toID'] != $_SERVER['PHP_AUTH_USER']) {
                  echo('<td><a href="message.php?to=' . $res['toID'] . '">Send</a></td>'); 
                }
                else {
                  echo('<td><a href="message.php?to=' . $res['fromID'] . '">Send</a></td>'); 
                }
                echo('</tr>'); 
                echo('<tr><td></td><td colspan="4"><b>Sent on: </b>' . $res['sent']. '</br><b>Body: </b>'. $res['message']. '</td></tr>'); 
                echo($te); 
            } else {
              echo("<h4>No messages found!</h4>"); 
            }
            $db->disconnect(); 
        ?>
      </div>

            <div class="col-lg-6" >
        <h3>Posts to your city</h3>
          <?php 
            $db = new DbUtil();
            $db->connect();
            $res = $db->indexPost($_SERVER['PHP_AUTH_USER']);
            $tb = '<div class="bs-example table-responsive"><table class="table table-striped table-bordered table-hover" style="table-layout: fixed;
word-wrap: break-word;"><thead><tr><th width="15%">From</th><th width="70%">Subject</th><th width="15%">Reply</th></tr></thead><tbody>';
            $te = '</tbody></table></div>'; 
            if($res[0]['fromID']) {
              echo($tb); 
              foreach($res as $row) {
                echo('<tr class="head">');
                if($row['fromID'] == $_SERVER['PHP_AUTH_USER'])
                  echo('<td>me</td>');
                else 
                  echo('<td>' . $row['fromID'] . '</td>');
                echo('<td>' . $row['subject'] . '</td>');
                echo('<td><a href="post.php">Send</a></td>'); 
                echo('</tr>'); 
                echo('<tr><td></td><td colspan="4"><b>Sent on: </b>' . $row['sent']. '</br><b>Body: </b>'. $row['message']. '</td></tr>'); 
              } 
              echo($te);
            } else if($res['fromID']) {
                echo($tb); 
                echo('<tr class="head">');
                if($res['fromID'] == $_SERVER['PHP_AUTH_USER'])
                  echo('<td>me</td>');
                else 
                  echo('<td>' . $res['fromID'] . '</td>');
                echo('<td>' . $res['subject'] . '</td>');
                echo('<td><a href="post.php">Send</a></td>'); 
                echo('</tr>'); 
                echo('<tr><td></td><td colspan="4"><b>Sent on: </b>' . $row['sent']. '</br><b>Body: </b>'. $res['message']. '</td></tr>'); 
                echo($te); 
            } else {
              echo("<h4>No posts found!</h4>"); 
            }
        ?>
        <a href="post.php">+ Make a new city post</a>
      </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/msg.js"></script>