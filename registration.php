<!DOCTYPE html>
<html lang-en>
  <head>
    <title>Registration - Pairs Minigame</title>
    <link rel="stylesheet" href="style.css">
  </head>

  <body>
    <div id='main'>
      <form action="register.php" method="post">
        <label for="Username">Username:</label>
        <input type="text" id="Username" name="Username"><br>
        <?php
          if (isset($_COOKIE["login_failed"]) and $_COOKIE["login_failed"] == true) {
            echo "Userame can't contain the following special characters: : ! @ # % ^ & * ( ) + = { } [ ] — ; : \" ' < > ? /<br>";
            setcookie("login_failed",false);
          }
        ?>

        <input type="submit" value="Register">            
      </form>
    </div>
  </body>
</html>
