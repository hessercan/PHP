<?php
if (!isset($_SESSION)){
  session_start();
}

if (isset($_GET['logout'])) {
    logoutUser();
}

$_SESSION['title'] = "PHP";

?>

<?php
function head() { include('includes/header.php'); }
function navbar() { include('includes/navbar.php'); }
function foot() { include('includes/footer.php'); }
function logoutUser() {
  unset($_SESSION['username']);
  header("Location: ./index.php");
}
function checkLoginStatus() {
  if (!isset($_SESSION['username'])){
    header('Location: ./login.php');
  }
}
?>
