<!DOCTYPE html>
<html lang-en>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration - Pairs Minigame</title>
    <link rel="stylesheet" href="style.css">

    <script>
      window.onload = function() {
        document.getElementById("skin").src = 'emoji assets/skin/' + document.forms.register.elements.skin.value + '.png';
        document.getElementById("eyes").src = 'emoji assets/eyes/' + document.forms.register.elements.eyes.value + '.png';
        document.getElementById("mouth").src = 'emoji assets/mouth/' + document.forms.register.elements.mouth.value + '.png';
        document.getElementById("skin").style.opacity = 1;
        document.getElementById("eyes").style.opacity = 1;
        document.getElementById("mouth").style.opacity = 1;
      };
    </script>
  </head>

  <body style="font-size:0">
    <?php include('navbar.php') ?>

    <div id='main'>
      <div id='content'>
        <form id='register' action="register.php" method="post">
          <label for="username">username:</label>
          <input type="text" id="username" name="username">
          <?php
            if (isset($_COOKIE["login_failed"]) and $_COOKIE["login_failed"] == true) {
              echo "<br>Userame can't contain the<br>following special characters:<br>: ! @ # % ^ & * ( ) + = { } [ ]<br>— ; : \" ' < > ? /<br>";
              setcookie("login_failed",false);
            }
          ?>
          <p>Create your avatar:</p>

          <div class=avatar>
            <img id="skin" src="emoji assets/skin/green.png" height=50px style="grid-column: 2; grid-row: 1; z-index: 0; opacity: 0;">
            <img id="eyes" src="emoji assets/eyes/closed.png" height=50px style="grid-column: 2; grid-row: 1; z-index: 1; opacity: 0;">
            <img id="mouth" src="emoji assets/mouth/open.png" height=50px style="grid-column: 2; grid-row: 1; z-index: 2; opacity: 0;">
          </div>

          <label>Skin</label><br>
          <input type="radio" id="green" name="skin" value="green" onclick='document.getElementById("skin").src = "emoji assets/skin/green.png"' checked>
          <label for="green">Green</label><br>
          <input type="radio" id="red" name="skin" value="red" onclick='document.getElementById("skin").src = "emoji assets/skin/red.png"'>
          <label for="red">Red</label><br>
          <input type="radio" id="yellow" name="skin" value="yellow" onclick='document.getElementById("skin").src = "emoji assets/skin/yellow.png"'>
          <label for="yellow">Yellow</label><br><br>

          <label>Eyes</label><br>
          <input type="radio" id="closed" name="eyes" value="closed" onclick='document.getElementById("eyes").src = "emoji assets/eyes/closed.png"' checked>
          <label for="closed">Closed</label><br>
          <input type="radio" id="laughing" name="eyes" value="laughing" onclick='document.getElementById("eyes").src = "emoji assets/eyes/laughing.png"'>
          <label for="laughing">Laughing</label><br>
          <input type="radio" id="long" name="eyes" value="long" onclick='document.getElementById("eyes").src = "emoji assets/eyes/long.png"'>
          <label for="long">Long</label><br>
          <input type="radio" id="normal" name="eyes" value="normal" onclick='document.getElementById("eyes").src = "emoji assets/eyes/normal.png"'>
          <label for="normal">Normal</label><br>
          <input type="radio" id="rolling" name="eyes" value="rolling" onclick='document.getElementById("eyes").src = "emoji assets/eyes/rolling.png"'>
          <label for="rolling">Rolling</label><br>
          <input type="radio" id="winking" name="eyes" value="winking" onclick='document.getElementById("eyes").src = "emoji assets/eyes/winking.png"'>
          <label for="winking">Winking</label><br><br>

          <label>Mouth</label><br>
          <input type="radio" id="open" name="mouth" value="open" onclick='document.getElementById("mouth").src = "emoji assets/mouth/open.png"' checked>
          <label for="open">Open</label><br>
          <input type="radio" id="sad" name="mouth" value="sad" onclick='document.getElementById("mouth").src = "emoji assets/mouth/sad.png"'>
          <label for="sad">Sad</label><br>
          <input type="radio" id="smiling" name="mouth" value="smiling" onclick='document.getElementById("mouth").src = "emoji assets/mouth/smiling.png"'>
          <label for="smiling">Smiling</label><br>
          <input type="radio" id="straight" name="mouth" value="straight" onclick='document.getElementById("mouth").src = "emoji assets/mouth/straight.png"'>
          <label for="straight">Straight</label><br>
          <input type="radio" id="surprise" name="mouth" value="surprise" onclick='document.getElementById("mouth").src = "emoji assets/mouth/surprise.png"'>
          <label for="surprise">Surprise</label><br>
          <input type="radio" id="teeth" name="mouth" value="teeth" onclick='document.getElementById("mouth").src = "emoji assets/mouth/teeth.png"'>
          <label for="teeth">Teeth</label><br><br>

          <input type="submit" value="Register">     
        </form>
      </div>
    </div>
  </body>
</html>
