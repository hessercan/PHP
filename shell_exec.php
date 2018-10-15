<?php
include('functions.php');

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <?php $_SESSION['title'] = "Shell"; head(); ?>
  </head>
  <body>
    <?php navbar(); ?>

    <?php

    if (file_exists("test")){
      if (is_dir("test")){
        echo "test exists, and is a folder";
      } else {
        echo "test exists, and is a file";
      }
    } else {
      echo "test does not exist and will be created";
      mkdir("test", 0775, true);
    }
    echo "<br />";
    $dir = "test";
    $files = scandir($dir);
    foreach ($files as $key => $file) {
      if ($file == "." || $file == ".."){
        continue;
      }

      echo "{$key} => {$file} ";
      echo "<br />";
      //print_r($file);

    }
    echo "Current Logged in Users: " . "<br />";
    $whousers = shell_exec('w');
    $usersExploded = explode("\n", $whousers);

    foreach ($usersExploded as $key => $value) {
      if ($key == "0" || $key == "1"){ continue; }
      $username = substr($value, 0, strpos($value, ' '));
      echo $username . "<br />";
    }
    //$ls = shell_exec('ls -lash');
    //echo "<pre>$ls</pre>";
    ?>

    <?php foot(); ?>
  </body>
</html>
