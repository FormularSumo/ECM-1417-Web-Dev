<ul id='navbar' style="font-size:0px">
  <li name="home"><a href="index.php">Home</a></li>
  <li name="memory" style="float:right"><a href="pairs.php">Play Pairs</a></li>
  <?php if(isset($_COOKIE["Username"])) : ?>
    <li name="leaderboard" style="float:right"><a href="leaderboard.php">Leaderboard</a></li>
  <?php else : ?>
    <li name="register" style="float:right"><a href="registration.php">Register</a></li>
  <?php endif; ?>
</ul>