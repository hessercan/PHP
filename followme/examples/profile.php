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

$sql = "SELECT * FROM fm_users";
$followUserResults = $conn->query($sql);
$followingUserResults = $conn->query($sql);

$user_id = $_SESSION['user_id'];


$sql = "SELECT user_id FROM fm_follows WHERE following_user_id = '$user_id'";
$followresults = $conn->query($sql);

while($row = $followresults->fetch_row()) {
  $follow_user_ids[]=$row[0];
}

$sql = "SELECT following_user_id FROM fm_follows WHERE user_id = '$user_id'";
$followingresults = $conn->query($sql);

while($row = $followingresults->fetch_row()) {
  $following_user_ids[]=$row[0];
}

// var_dump($follow_user_ids);
// echo "<br />";
// var_dump($following_user_ids);

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
    <?php echo $_SESSION['ret']; ?>
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
                <div class="owner">
                    <div class="avatar">
                        <img src="<?php echo $_SESSION['image_url']; ?>" alt="Circle Image" class="img-circle img-no-padding img-responsive">
                    </div>
                    <div class="name">
                        <h4 class="title"><?php echo $_SESSION['first_name'] . " " . $_SESSION['last_name']; ?></h4>
						            <h6 class="description"><?php echo $_SESSION['user_title']; ?></h6>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 ml-auto mr-auto text-center">
                        <p><?php echo $_SESSION['description']; ?></p>
                        <br />
                        <form action="edit-profile.php">
                        <btn onclick="location.href='edit-profile.php'" class="btn btn-outline-default btn-round"><i class="fa fa-cog"></i> Settings</btn>
                      </form>
                    </div>
                </div>
                <br/>
                <div class="nav-tabs-navigation">
                    <div class="nav-tabs-wrapper">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#follows" role="tab">Followers</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#following" role="tab">Following</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- Tab panes -->
                <div class="tab-content following">
                  <!-- Start Followers Tab -->
                    <div class="tab-pane text-center active" id="follows" role="tabpanel">
                        <div class="row">
                            <div class="col-md-6 ml-auto mr-auto">
                                <ul class="list-unstyled follows">
                                  <?php
                                      while ($row = $followUserResults->fetch_assoc()) {
                                        if(in_array($row['user_id'],$follow_user_ids)) {
                                    ?>
                                    <li>
                                        <div class="row">
                                            <div class="col-md-2 col-sm-2 ml-auto mr-auto">
                                                <img src="<?php echo $row['image_url']; ?>" alt="Profile Picture" class="img-circle img-no-padding img-responsive">
                                            </div>
                                            <div class="col-md-7 col-sm-2 ml-auto mr-auto">
                                                <h6><?php echo $row['first_name'] . " " . $row['last_name']; ?><br/>
                                                  <small><?php echo $row['user_title']; ?></small></h6>
                                            </div>
					                            </div>
                                    </li>
                                    <hr />
                                <?php }
                                    }?>
                                </ul>
                            </div>
                        </div>
                        <hr />
                    </div>
                    <!-- End Followers Tab -->
                    <!-- Start Following Tab -->
                    <div class="tab-pane text-center" id="following" role="tabpanel">
                      <?php if (isset($following_user_ids)) { ?>
                        <div class="row">
                            <div class="col-md-6 ml-auto mr-auto">
                                <ul class="list-unstyled follows">
                                  <?php
                                      while ($row = $followingUserResults->fetch_assoc()) {
                                        if(in_array($row['user_id'],$following_user_ids)) {
                                    ?>
                                    <li>
                                        <div class="row">
                                            <div class="col-md-2 col-sm-2 ml-auto mr-auto">
                                                <img src="<?php echo $row['image_url']; ?>" alt="Profile Picture" class="img-circle img-no-padding img-responsive">
                                            </div>
                                            <div class="col-md-7 col-sm-2 ml-auto mr-auto">
                                                <h6><?php echo $row['first_name'] . " " . $row['last_name']; ?><br/>
                                                  <small><?php echo $row['user_title']; ?></small></h6>
                                            </div>
					                            </div>
                                    </li>
                                    <hr />
                                <?php }
                                    }?>
                                </ul>
                            </div>
                        </div>
                        <hr />
                      <button onclick="location.href='edit-follows.php'" class="btn btn-warning btn-round">Find More Users to Follow</button>
                    <?php } else { ?>
                        <h3 class="text-muted">Not following anyone yet :(</h3>
                        <button onclick="location.href='edit-follows.php'" class="btn btn-warning btn-round">Find Users to Follow</button>
                      <?php } ?>
                    </div>
                    <!-- End Following Tab -->
                </div>
                <!-- End Tabs -->
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
