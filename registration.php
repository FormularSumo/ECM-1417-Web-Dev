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
            echo "<br>Userame can't contain the following special characters: : ! @ # % ^ & * ( ) + = { } [ ] — ; : \" ' < > ? /<br>";
            setcookie("login_failed",false);
          }
        ?>
        <p>Create your avatar:</p>
        <label>Eyes</label><br><br>
        <img src="emoji assets/eyes/closed.png" height=36px style="filter: invert(1)">
        <img src="emoji assets/eyes/laughing.png" height=36px style="filter: invert(1)">
        <br>
        <input type="radio" id="closed" name="eyes" value="Closed">
        <label for="closed">Closed</label><br>
        <input type="radio" id="laughing" name="eyes" value="Laughing">
        <label for="laughing">Laughing</label><br>
        <input type="radio" id="long" name="eyes" value="Long">
        <label for="long">Long</label><br>
        <input type="radio" id="normal" name="eyes" value="Normal">
        <label for="normal">Normal</label><br>
        <input type="radio" id="rolling" name="eyes" value="Rolling">
        <label for="rolling">Rolling</label><br>
        <input type="radio" id="winking" name="eyes" value="Winking">
        <label for="winking">Winking</label><br><br>

        <label>Mouth</label><br>
        <input type="radio" id="open" name="eyes" value="Open">
        <label for="open">Open</label><br>
        <input type="radio" id="sad" name="eyes" value="Sad">
        <label for="sad">Sad</label><br>
        <input type="radio" id="smiling" name="eyes" value="Smiling">
        <label for="smiling">Smiling</label><br>
        <input type="radio" id="straight" name="eyes" value="Straight">
        <label for="straight">Straight</label><br>
        <input type="radio" id="surprise" name="eyes" value="Surprise">
        <label for="surprise">Surprise</label><br>
        <input type="radio" id="teeth" name="eyes" value="Teeth">
        <label for="teeth">Teeth</label><br><br>

        <label>Skin</label><br>
        <input type="radio" id="green" name="eyes" value="Green">
        <label for="green">Green</label><br>
        <input type="radio" id="red" name="eyes" value="Red">
        <label for="red">Red</label><br>
        <input type="radio" id="yellow" name="eyes" value="Yellow">
        <label for="yellow">Yellow</label><br><br>

        <input type="submit" value="Register">     
      </form>
    </div>
  </body>
</html>
