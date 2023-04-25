<!DOCTYPE html>
<html>
  <head>
    <title>Pairs Minigame</title>
  </head>
  <body>

  <?php if(isset($_COOKIE["username"])) : ?>
    <p>Welcome to Pairs</p>
    <button onclick="window.location.href='pairs.php';">Click here to play</button>
  <?php else : ?>
    <p>You're not using a registered session? <a href="registration.php">Register</a> now</p>
  <?php endif; ?>

  </body>
</html>
