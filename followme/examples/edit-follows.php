<?php
include('../functions.php');

if (!isset($_SESSION['email'])){
  header('Location: ./login.php');
}

if (isset($_POST['settings'])){
header("Location: edit-profile.php");
exit;
}

require('../dbconn.php');

if ($_POST['submit'] == "Follow"){
  $sqlalter = "";
  $user_id = $_SESSION['user_id'];
  foreach ($_POST as $key => $value) {
      if ($key != "submit"){
        if ($sqlalter != "") { $sqlalter .= ","; }
        $sqlalter .= "($user_id,$key)";
      }
  }

  // echo "$sqlalter"; //echos the sql insert to make sure it's formatted properly
  $sql = "DELETE FROM fm_follows WHERE user_id = '$user_id';";
  $conn->query($sql);
  $sql = "INSERT INTO fm_follows (user_id,following_user_id) VALUES $sqlalter;";
  $conn->query($sql);

  header('Location: ./profile.php');
}

$sql = "SELECT * FROM fm_users;";
$allresults = $conn->query($sql);

$user_id = $_SESSION['user_id'];

$sql = "SELECT following_user_id FROM fm_follows WHERE user_id = '$user_id'";
$followresults = $conn->query($sql);

while($row = $followresults->fetch_row()) {
  $follow_user_ids[]=$row[0];
}

$sql = "SELECT user_id FROM fm_follows WHERE following_user_id = '$user_id'";
$followingresults = $conn->query($sql);

while($row = $followingresults->fetch_row()) {
  $following_user_ids[]=$row[0];
}

 ?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="../assets/img/favicon.ico">
	<link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title> <?php echo $_SESSION['first_name'] . " " . $_SESSION['last_name'] . " - Profile"; ?> </title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

	<!-- Bootstrap core CSS     -->
	<link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
	<link href="../assets/css/paper-kit.css?v=2.1.0" rel="stylesheet"/>

	<!--  CSS for Demo Purpose, don't include it in your project     -->
	<link href="../assets/css/demo.css" rel="stylesheet" />

    <!--     Fonts and icons     -->
	<link href='https://fonts.googleapis.com/css?family=Montserrat:400,300,700' rel='stylesheet' type='text/css'>
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
	<link href="../assets/css/nucleo-icons.css" rel="stylesheet">

</head>
<body>
    <nav class="navbar navbar-expand-md fixed-top navbar-transparent" color-on-scroll="150">
        <div class="container">
			<div class="navbar-translate">
	            <button class="navbar-toggler navbar-toggler-right navbar-burger" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-bar"></span>
					<span class="navbar-toggler-bar"></span>
					<span class="navbar-toggler-bar"></span>
	            </button>
	            <a class="navbar-brand" href="">Follow Me</a>
			</div>
			<div class="collapse navbar-collapse" id="navbarToggler">
	            <ul class="navbar-nav ml-auto">
	                <li class="nav-item">
	                    <?php echo (isset($_SESSION['email'])) ? "<a href=\"?logout\" class=\"nav-link\">" . $_SESSION['email'] . "</a>" : "<a href=\"./login.php\" class=\"nav-link\"><i class=\"nc-icon nc-touch-id\"></i>Login</a>" ?>
	                </li>
	                <!-- <li class="nav-item">
	                    <a href="login.php" class="nav-link"><i class="nc-icon nc-book-bookmark"></i>  Login</a>
	                </li> -->

	            </ul>
	        </div>
		</div>
    </nav>

    <div class="wrapper">
        <div class="page-header page-header-xs" data-parallax="true" style="background-image: url('../assets/img/fabio-mangione.jpg');">
			<div class="filter"></div>
		</div>
        <div class="section profile-content">
            <div class="container">

                <div class="nav-tabs-navigation">
                    <div class="nav-tabs-wrapper">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#follows" role="tab">Available Users</a>
                            </li>

                        </ul>
                    </div>
                </div>
                <!-- Tab panes -->
                <div class="tab-content following">
                    <div class="tab-pane text-center active" id="follows" role="tabpanel">
                        <div class="row">
                            <div class="col-md-6 ml-auto mr-auto">
                              <!-- Start List Users -->
                              <form class="" action="" method="post">
                                <ul class="list-unstyled follows">
                                  <?php
                                      while ($row = $allresults->fetch_assoc()) {
                                        if ($row['user_id'] != $_SESSION['user_id']){
                                    ?>
                                    <li>
                                        <div class="row">
                                            <div class="col-md-2 col-sm-2 ml-auto mr-auto">
                                                <img src="<?php echo $row['image_url']; ?>" alt="Profile Picture" class="img-circle img-no-padding img-responsive">
                                            </div>
                                            <div class="col-md-7 col-sm-4  ml-auto mr-auto">
                                                <h6><?php echo $row['first_name'] . " " . $row['last_name']; ?><br/>
                                                  <small><?php echo $row['user_title']; ?></small></h6>
                                            </div>
                                            <div class="col-md-3 col-sm-2  ml-auto mr-auto">
												                      <div class="form-check">
					                                <label class="form-check-label">
					                                    <input class="form-check-input" name="<?php echo $row['user_id'] ?>" type="checkbox" value=""
                                              <?php if(in_array($row['user_id'],$follow_user_ids)){ echo "checked"; } ?>
                                              >
					                                    <span class="form-check-sign"></span>
					                                </label>
					                            </div>
                                            </div>
                                        </div>
                                    </li>
                                    <hr />
                                <?php }
                                    } ?>
                                </ul>
                                <center><input class="btn btn-warning btn-round" type="submit" name="submit" value="Follow"></center>
                              </form>
                              <!-- End List Users -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
	<footer class="footer section-dark">
        <div class="container">
            <div class="row">
                <div class="credits ml-auto">
                    <span class="copyright">
                        © <script>document.write(new Date().getFullYear())</script>, made with <i class="fa fa-heart heart"></i> by HesserCAN
                    </span>
                </div>
            </div>
        </div>
    </footer>
</body>

<!-- Core JS Files -->
<script src="../assets/js/jquery-3.2.1.js" type="text/javascript"></script>
<script src="../assets/js/jquery-ui-1.12.1.custom.min.js" type="text/javascript"></script>
<!-- <script src="../assets/js/tether.min.js" type="text/javascript"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="../assets/js/bootstrap.min.js" type="text/javascript"></script>


<!--  Paper Kit Initialization snd functons -->
<script src="../assets/js/paper-kit.js?v=2.1.0"></script>

</html>
