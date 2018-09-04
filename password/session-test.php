<?php session_start(); ?>
<? if(isset$username){
  echo You are logged in as $_SESSION['username'];
} else {
  echo You are logged out;
}

?>
