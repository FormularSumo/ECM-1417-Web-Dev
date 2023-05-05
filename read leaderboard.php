<?php
  if (file_exists("leaderboard")) {
    $leaderboard = unserialize(file_get_contents("leaderboard"));
  } else {
    $leaderboard = [
      "totalScores"=>[
        "usernames"=>[],
        "scores"=>[]
      ],
      "level1Scores"=>[
        "usernames"=>[],
        "scores"=>[]
      ],
      "level2Scores"=>[
        "usernames"=>[],
        "scores"=>[]
      ],
      "level3Scores"=>[
        "usernames"=>[],
        "scores"=>[]
      ],
      "level4Scores"=>[
        "usernames"=>[],
        "scores"=>[]
      ],
    ];
  }
?>