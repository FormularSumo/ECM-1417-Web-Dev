<?php
  include('read leaderboard.php');

  array_push($leaderboard['totalScores']['usernames'], $_COOKIE["username"]);
  array_push($leaderboard['totalScores']['scores'], $_POST["totalPoints"]);
  array_push($leaderboard['level1Scores']['usernames'], $_COOKIE["username"]);
  array_push($leaderboard['level1Scores']['scores'], $_POST["level1Points"]);
  array_push($leaderboard['level2Scores']['usernames'], $_COOKIE["username"]);
  array_push($leaderboard['level2Scores']['scores'], $_POST["level2Points"]);
  array_push($leaderboard['level3Scores']['usernames'], $_COOKIE["username"]);
  array_push($leaderboard['level3Scores']['scores'], $_POST["level3Points"]);
  array_push($leaderboard['level4Scores']['usernames'], $_COOKIE["username"]);
  array_push($leaderboard['level4Scores']['scores'], $_POST["level4Points"]);

  array_multisort($leaderboard["totalScores"]["scores"], SORT_DESC, $leaderboard["totalScores"]["usernames"]);
  array_multisort($leaderboard["level1Scores"]["scores"], SORT_DESC, $leaderboard["level1Scores"]["usernames"]);
  array_multisort($leaderboard["level2Scores"]["scores"], SORT_DESC, $leaderboard["level2Scores"]["usernames"]);
  array_multisort($leaderboard["level3Scores"]["scores"], SORT_DESC, $leaderboard["level3Scores"]["usernames"]);
  array_multisort($leaderboard["level4Scores"]["scores"], SORT_DESC, $leaderboard["level4Scores"]["usernames"]);

  file_put_contents("leaderboard", serialize($leaderboard));
?>