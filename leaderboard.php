<!DOCTYPE html>
<html lang-en>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leaderboard - Pairs Minigame</title>
    <link rel="stylesheet" href="style.css">
    <?php
      include('read leaderboard.php');

      if (count($leaderboard) > 0) {
        $mergedLeaderboard = [];
        foreach ($leaderboard as $scoretype) {
          foreach ($scoretype as $array) {
            foreach ($array as $item) {
              array_push($mergedLeaderboard,$item);
            }
          }
        }
      }      
    ?>
  </head>

  <body style="font-size:0">
    <?php include('navbar.php'); ?>

    <div id='main'>
      <div id='content' style="background-color:grey; box-shadow:0px 0px 5px 5px #515151;">
        <table style="border-spacing: 2px;">
          <tr style="background-color: blue;  text-align: center;">
            <th colspan="2">Total Score</th>
            <th colspan="2">Level 1</th>
            <th colspan="2">Level 2</th>
            <th colspan="2">Level 3</th>
            <th colspan="2">Level 4</th>
          </tr>
          
          <?php 
            if ($mergedLeaderboard != null) {
              $leaderboardLength = count($mergedLeaderboard);

              for ($x = 0; $x < min($leaderboardLength/10,10); $x += 1) { //Limit visible leaderboard entries to 10
                echo "<tr>";
                for ($y = 0; $y < 10; $y += 1) {
                  $currentItem = $mergedLeaderboard[$x+$y*$leaderboardLength/10];
                  echo "<td>$currentItem</td>";
                }
                echo "</tr>";
              }
            } else {
              echo "<tr><td colspan='10'>Nobody is on the leaderboard yet :( - press on 'Play Pairs' to play and become the first!</td></tr>"; 
            }
          ?>
        </table>
      </div>
    </div>
  </body>
</html>