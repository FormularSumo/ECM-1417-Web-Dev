<!DOCTYPE html>
<html lang-en>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Pairs Minigame</title>
    <link rel="stylesheet" href="style.css">
  </head>

  <body style="font-size:0">
    <?php include('navbar.php') ?>

    <div id='main'>
      <div id='content'>
        <?php if(isset($_COOKIE["username"])) : ?>
          <p>Welcome to Pairs</p>
          <button onclick="window.location.href='pairs.php';">Click here to play</button>
        <?php else : ?>
          <p>You're not using a registered session? <a href="registration.php">Register</a> now</p>
        <?php endif; ?>
      </div>
    </div>
  </body>
</html>