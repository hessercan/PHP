<?php include('functions.php'); ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <?php $_SESSION['title'] = 'Home'; head(); ?>
  </head>
  <body>

    <?php navbar(); ?>
  
    <h1>Welcome to PHP!</h1>
    <?php if (isset($_SESSION['username'])) { echo "Logged in as: " . $_SESSION['username']; } ?>
    <?php foot(); ?>
    </div>
  </body>
</html>
