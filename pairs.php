<!DOCTYPE html>
<html lang-en>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Memory - Pairs Minigame</title>
    <link rel="stylesheet" href="style.css">

    <script>
      function begin() {
        document.getElementById("start_button").style.display="none";
        document.getElementById("pairs").style.display="block";
        var attempts=0;
      }
    </script>
  </head>

  <body style="font-size:0">
    <?php 
      include('navbar.php');
    ?>

    <div id='main'>
      <div id='content' style="background-color:grey; box-shadow:0px 0px 5px 8px #515151;">
        <div id='pairs' style="display:none">
          <p>Pairs</p>
        </div>
        <button id='start_button' onclick="begin()">Click here to play</button>
      </div>
    </div>
  </body>
</html>