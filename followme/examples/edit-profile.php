<?php
include('../functions.php');

if (!isset($_SESSION['email'])){
  header('Location: ./login.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  require('../dbconn.php');
  updateProfile();

  if (isset($_FILES['profile-pic'])){
    uploadProfilePic();
  }
  reloadSession();
}

 ?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="../assets/img/favicon.ico">
	<link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title> <?php echo $_SESSION['first_name'] . " " . $_SESSION['last_name'] . " - Edit Profile"; ?> </title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

	<!-- Bootstrap core CSS     -->
	<link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
	<link href="../assets/css/paper-kit.css?v=2.1.0" rel="stylesheet"/>

	<!--  CSS for Demo Purpose, don't include it in your project     -->
	<link href="../assets/css/demo.css" rel="stylesheet" />

    <!--     Fonts and icons     -->
	<link href='https://fonts.googleapis.com/css?family=Montserrat:400,300,700' rel='stylesheet' type='text/css'>
	<link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
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
    <div class="section landing-section">
        <div class="container">
            <div class="row">
                <div class="col-md-8 ml-auto mr-auto">
                    <h2 class="text-center">Edit Profile</h2>
                    <form class="contact-form" action="" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                              <label>First Name</label>
                                <div class="input-group">
                                  <span class="input-group-addon">
                                      <i class="nc-icon nc-user-run"></i>
                                  </span>
                                  <input type="text" class="form-control" placeholder="First Name" name="first_name">
                              </div>
                            </div>
                            <div class="col-md-6">
                                <label>Last Name</label>
                                <div class="input-group">
                                  <span class="input-group-addon">
                                    <i class="nc-icon nc-user-run"></i>
                                  </span>
                                  <input type="text" class="form-control" placeholder="Last Name" name="last_name">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                              <label>Title</label>
                                <div class="input-group">
                                  <span class="input-group-addon">
                                      <i class="nc-icon nc-world-2"></i>
                                  </span>
                                  <input type="text" class="form-control" placeholder="Title" name="user_title">
                              </div>
                            </div>
                            <div class="col-md-6">
                                <label>Profile Picture</label>
                                <div class="input-group">
                                  <span class="input-group-addon">
                                    <i class="nc-icon nc-cloud-upload-94"></i>
                                  </span>
                                  <input type="file" class="form-control" id="profile-pic" name="profile-pic">
                                </div>
                            </div>
                        </div>
                          <label>Description</label>
                          <textarea class="form-control" rows="4" name="description" placeholder="Tell everyone a little about you..." name="description"></textarea>
                          <div class="row">
                            <div class="col-md-3 ml-auto mr-auto">
                              <button class="btn btn-danger btn-lg btn-fill">Save Profile</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
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
                        
                    </div>
                </div>
                <br/>

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
