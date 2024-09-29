<!DOCTYPE html>
<html lang-en>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Memory - Pairs Minigame</title>
    <link rel="stylesheet" href="style.css">
  </head>

  <body style="font-size:0">
    <?php 
      include('navbar.php');
    ?>

    <div id='main'>
      <div id='content' style="background-color:grey; box-shadow:0px 0px 5px 5px #515151;">
        <?php if(isset($_COOKIE["username"])) : ?>
          <script type="text/javascript" src="pairs.js"></script>
          <div id='pairs' style="display:none; width=80%;">
            <p id='total point counter'>Total points: 0</p>
            <p id='round point counter'>Points this round: 1000</p>
            <p id='level highscore'>Previous highscore for this level: none</p>
            <p id='cards in need of matching'>This round 2 cards at a time need matching together</p>

            <div id='level' class='grid'></div>
          </div>
          <button id='start button' onclick="playLevel(1);">Start the game</button>

          <audio id="Level complete" controls style="display:none">
            <source src="sound effects/Level complete.mp3" type="audio/mp3">
          </audio>
        <?php else: ?>
          <p>Please register before playing</p>
        <?php endif;?>
      </div>
    </div>
  </body>
</html>