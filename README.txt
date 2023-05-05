ml-lab-4d78f073-aa49-4f0e-bce2-31e5254052c7.ukwest.cloudapp.azure.com:52852/index.php

all:
  Navbar containing selected emoji avatar and leaderboard if registered, link to register if not
  Centred background image that fills window width

index.php:
  Register now button if unregistered user, click here to play button if not

register.php:
  Form for user to input username and create avatar by choosing skin, eyes and mouth
  Live avatar preview that updates as user selects skin/eyes/mouth
  Registration fails with appropriate error message username is blank or contains special characters
  If user decides to re-register later, existing avatar is hidden from navbar during registration, and existing previous highscores are cleared

pairs.php:
  'Points this round' shows how many points can still be earned when the level is completed, and goes down over time, slower as the round goes on. Selecting a wrong pair reduces points. Points go down slower on harder levels to compensate for there being more cards and more cards needed to form a 'pair'. 'Previous highscore for this level' shows the best score accomplished in the past by the user, or says 'none' if they haven't completed this level before.

  Clicking on a card reveals its emoji at 80% opacity, the card can't then be flipped back over until a different card is clicked
  The emoji on the next card clicked is also revealed. If the cards don't match, they all hide again after 400 ms (unless clicked on again). Otherwise they remain flipped. If all the matches have been found, the emojis show at 100% opacity and a completion sound is played.
  Emoji images can't be dragged to prevent a user creating a ghost copy of an emoji following their mouse

  Emoji images are randomly generated and ordered, such that there's always the correct number of matching cards to complete a level
  Once all pairs have been matched, round ends, round completion sound is played and round points freezes. Backgrouentnd turns gold if previous highscore for that level has been beaten and it's not the first time the level has been played.
  Once all the levels are complete, cards and round points disappear and play again, submit score, and create level buttons appears.

  Create level provides a form allowing the user to create a custom level with their choice of matches in a pair, rows, and columns. Appropriate error messages are displayed if non-numeric values are given, there's less than 2 cards or 2 matches, or if the total number of cards would be indivisible by that number of matches.

leaderboard.php:
  Displays message if leaderboard empty
  Otherwise, displays ordered top 10 scores and their respective users for total score across all levels and score per levels
  Leaderboard is stored on the virtual machine and so is the same for everyone who accesses the game
  Users can submit new scores at any time and this will get added to the leaderboard