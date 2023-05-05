ml-lab-4d78f073-aa49-4f0e-bce2-31e5254052c7.ukwest.cloudapp.azure.com:52852/index.php

all:
  Navbar that contains selected emoji avatar and leaderboard if registered user, link to register if not
  Centered background image that fill window width
  Clearing cookies/using a different browser/private browsing causes username, avatar and individual previous best scores to be reset

index.php:
  Register now button if unregistered user
  Click here to play button if registered user

register.php:
  Form that allows user to input username and create avatar by choosing skin eyes and mouth of it
  Live avatar preview that updates as user selects skin/eyes/mouth
  Registration fails with appropriate error message username is blank or contains special charaters
  If user decides to re-register later (eg they want to change their username or avatar), existing avatar is hidden from navbar, and existing previous highscores are cleared

pairs.php:
  'Points this round' shows how many points can still be earnt when the level is completed. These points go down over time - proportionally slower as the round goes on. Selecting a wrong pair also reduces points slightly. Points go down slower on harder levels to compensate for there being more cards and more cards needed to form a 'pair'. 'Previous highscore for this level' shows the best score accomplished in the past by the user, or says 'none' if they haven't completed this level before. 'Total points' accumlates as the user completes levels, and 'This round [x] cards at a time need matching together' tells the user how many cards are needed to form a pair.

  Clicking on a card reveals its emoji at 80% opacity, the card then can't be flipped back over until a different card is chosen
  The emoji on the next card clicked is also revealed. If the cards don't match, they all hide again after 400 ms. Otherwise they remain flipped. If all the matches have been found, the emojis show at 100% opacity and a completion sound is played to indicate a completed pair.
  Clicking on a card that's scedulded to be flipped back over cancels that flip and keeps the card flipped up until it next needs to be flipped back over (eg click on a couple of incorrect cards then within the 400ms window click on one of those cards again before it flips back over)
  Emoji images can't be dragged to prevent a user creating a ghost copy of an emoji following their mouse, as that would defeat the point of the game (memory!)

  Emoji images are randomly generated and ordered, such that there's always the correct number of matching cards to complete a level
  Once all pairs have been matched, round ends, round completion sound is played and round points freezes. Background turns gold if previous highscore for that level has been beaten and it's not the first time the level has been played. After 1.8 seconds the next round starts - cards are replaced and round points added to total points.
  Once all the levels are complete, cards and round points disappear and play again, submit score, and create level buttons appears.

  Create level provides a form allowing the user to create a custom level with their choice of matches in a pair, rows, and columns. Appropriate error messages are displayed if non-numeric values are given, there's less than 2 cards or 2 matches, or if the total number of cards would be individible by that number of matches.

leaderboard.php:
  Displays message if leaderboard empty
  Otherwise, displays ordered top 10 scores and their respecitve users for total score across all levels and score per levels
  Leaderboard is stored on apache server as text file and so is the same for anyone who accesses the game, regardless of cookies or other locally stored data
  Users can submit new scores at any time and this will get added to the leaderboard.