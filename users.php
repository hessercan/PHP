<!-- <?php
include('functions.php');

//Checks Login Status and Redirects to index if not logged in.
checkLoginStatus();

//Bring in database connection
require('dbconn.php');

if (isset($_POST['userid'])) {
  if (isset($_POST['delete'])) {
    $sql = "DELETE FROM users WHERE userid = " . $_GET['userid'];
    $result = $conn->query($sql);
    $sql = "SELECT username FROM users WHERE userid = " . $_GET['userid'];
    var_dump($sql);
    $result = $conn->query($sql);
    if ($_SESSION['username'] === $result){
      unset($_SESSION['username']);
      header("Location: ./index.php");
    }
  }
  if (isset($_POST['edit'])) { //&& $_POST['username'] !== $_SESSION['username']

    $sql = "SELECT * from users WHERE username = '" . $_SESSION['username'] . "'";
    $result = $conn->query($sql);
    // $conn->close();

    while($row = $result->fetch_assoc()) {
      $oldUsername = $row['username'];
      $oldPassword = $row['password'];
    }

    $updateID = $_POST['userid'];
    $newUsername = $_POST['username'];
    $newPassword = $_POST['password'];

    echo "<p>NewUser: " . $newUsername . "</p>";
    echo "<p>OldUser: " . $oldUsername . "</p>";

    if ($oldUsername != $newUsername){
      // $sql = "UPDATE users SET username = '" . $newUsername . "' WHERE userid = " . $updateID;
      // $conn->query($sql);
      // $conn->close();
      // //unset($_SESSION['username']);
      echo "Username Updated! ";
    }
    echo "<p>NewPass: " . $newPassword . "</p>";
    echo "<p>OldPass: " . $oldPassword . "</p>";
    if ($newPassword !== $oldPassword) {
      // if (!password_verify($newPassword,$oldPassword)) {
        // $newPassword = password_hash($newPassword, PASSWORD_BCRYPT);
        // $sql = "UPDATE users SET password = '" . $newPassword . "' WHERE userid = " . $updateID;
        // $conn->query($sql);
        // $conn->close();

        echo "Password Updated! ";

    }
    //header("Location: ./index.php");
  }
}
 ?>

 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <?php $_SESSION['title'] = "Users"; head(); ?>
   </head>
   <body>
     <?php navbar(); ?>
     <div style="margin: auto; padding: 20px; width: 700px; height: 200px; border: 1px solid black;">
     <table style="text-align:left">
       <tr>
         <th>User Id</th>
         <th>Username</th>
         <th>Password Hash</th>
         <th colspan="2">Actions</th>
       </tr>

       <?php


       //Create the SQL query
       $sql = "SELECT * FROM users";
       //Execute the SQL query
       $result = $conn->query($sql);
       //var_dump($result);
       //Close Connection
       $conn->close();
       //Loop through all table records
       while($row = $result->fetch_assoc()) {
         echo "<tr>";
         if ($row['username'] === $_SESSION['username']){
       ?>

          <form action="" method="get">
             <td><input name="disableduserid" type="text" disabled value=<?php echo $row['userid']; ?> ></td>
             <input name="userid" type="hidden" value=<?php echo $row['userid']; ?> >
             <td><input name="username" type="text" value="<?php echo $row['username']; ?>"></td>
             <td><input name='password' type="password" value=" <?php echo $row['password']; ?> "></td>
             <td><input name="edit" type="submit" value="Edit"></td>
             <td><input name="delete" type="submit" value="Delete"></td>
           </form>


      <?php
          }
        }
      echo "</tr>";
      ?>

     </table>
   </div>
     <?php foot(); ?>
   </body>
 </html> -->
