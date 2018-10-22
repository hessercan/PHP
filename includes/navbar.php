    <table class="navbar">
      <tr>
        <?php
        echo "<td class=\"navbar\">";
        echo (basename($_SERVER['PHP_SELF']) == "index.php")
        ? "<a href=\"index.php\"><strong>Home</strong></a>"
        : "<a href=\"index.php\">Home</a>";
        echo "</td>";

        if (isset($_SESSION['username'])){
          echo "<td class=\"navbar\">";
          echo (basename($_SERVER['PHP_SELF']) == "login.php")
          ? "<a href=\"./login.php?logout=true\"><strong>Logout</strong></a>"
          : "<a href=\"./login.php?logout=true\">Logout</a>";
          echo "</td>";

          if (basename($_SERVER['PHP_SELF']) == "login.php"){
            echo "<td class=\"navbar\">";
            echo "<a href=\"register.php\">Register</a>";
            echo "</td>";
          }
        }
        else {
          echo "<td class=\"navbar\">";
          echo (basename($_SERVER['PHP_SELF']) == "login.php")
          ? "<a href=\"login.php\"><strong>Login</strong></a>"
          : "<a href=\"login.php\">Login</a>";
          echo "</td>";

          if (basename($_SERVER['PHP_SELF']) == "login.php"){
            echo "<td class=\"navbar\">";
            echo "<a href=\"register.php\">Register</a>";
            echo "</td>";
          }
        }


        if (basename($_SERVER['PHP_SELF']) == "register.php"){
          echo "<td class=\"navbar\">";
          echo "<a href=\"register.php\"><strong>Register</strong></a>";
          echo "</td>";
        }

        if( isset($_SESSION['username']) ) {

          //Upload
          echo "<td class=\"navbar\">";
          echo (basename($_SERVER['PHP_SELF']) == "upload.php")
          ? "<a href=\"upload.php\"><strong>Upload</strong></a>"
          : "<a href=\"upload.php\">Upload</a>";
          echo "</td>";

          //Users
          echo "<td class=\"navbar\">";
          echo (basename($_SERVER['PHP_SELF']) == "users.php")
          ? "<a href=\"users.php\"><strong>Users</strong></a>"
          : "<a href=\"users.php\">Users</a>";
          echo "</td>";

          //Cookies
          echo "<td class=\"navbar\">";
          echo (basename($_SERVER['PHP_SELF']) == "cookies.php")
          ? "<a href=\"cookies.php\"><strong>Cookies</strong></a>"
          : "<a href=\"cookies.php\">Cookies</a>";
          echo "</td>";

          //Shell Exec
          echo "<td class=\"navbar\">";
          echo (basename($_SERVER['PHP_SELF']) == "shell_exec.php")
          ? "<a href=\"shell_exec.php\"><strong>Shell</strong></a>"
          : "<a href=\"shell_exec.php\">Shell</a>";
          echo "</td>";
          
        }
	//FollowMe
          echo "<td class=\"navbar\">";
          echo (basename($_SERVER['PHP_SELF']) == "followme")
          ? "<a href=\"followme\"><strong>Follow Me</strong></a>"
          : "<a href=\"followme\">Follow Me</a>";
          echo "</td>";

	?>
      </tr>
    </table>
