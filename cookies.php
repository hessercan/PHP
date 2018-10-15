<?php
include("functions.php");

//Checks Login Status and Redirects to index if not logged in.
checkLoginStatus();

  $cookie_name = "last_visit";
  $cookie_value = date("l F jS\, Y \- h:i:s A");

  if (isset($_COOKIE['last_visit'])){
    $notify1 = "You have been here before within the last 30 days.";
    $last_visit = $_COOKIE['last_visit'];
    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
  } else {
    $notify1 = "You haven't been here before.";
    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
  }


  $cookie_name = "time_last_visit";
  $cookie_value = time();

  if (isset($_COOKIE['time_last_visit'])){
    $timelapse = time() - $_COOKIE['time_last_visit'];
    $notify2 = "Fun fact, you were here " . $timelapse . " seconds ago";
    $last_visit = $_COOKIE['last_visit'];
    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
  } else {
    $notify2 = "No Fun Fact For You...";
    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
  }



 ?>

 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <?php $_SESSION['title'] = 'Cookies'; head(); ?>
   </head>
   <body>
     <?php navbar(); ?>

     <h2 style="text-align: center;">
       <?php
        echo $notify1;
        echo ($last_visit != "")? "<br /> Last Visit: " . $last_visit : "";
        echo "<br />" . $notify2;
        ?>

      </h2>

     <?php foot(); ?>
   </body>
 </html>
