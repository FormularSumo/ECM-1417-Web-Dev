ml-lab-4d78f073-aa49-4f0e-bce2-31e5254052c7.ukwest.cloudapp.azure.com:52852/index.php

all:
  Navbar that contains selected emoji avatar and leaderboard if registered user, link to register if not
  Centered background image that fill window width

index.php:
  Register now button if unregistered user
  Click here to play button if registered user

register.php:
  Form that allows user to input username and create avatar by choosing skin eyes and mouth of it
  Live avatar preview that updates as user selects skin/eyes/mouth
  Registration fails and message explaining why if special charater used in username
  If user decides to re-register later (eg they want to change their username or avatar), existing avatar is hidden from navbar

pairs.php
  Start button that disppears when pressed to reveal game
  Points go down over time - proportionally slower as the round goes on. Selecting a wrong pair also reduces points, by 5%
  Clicking on a card reveals the emoji at 80% opacity, the card then can't be flipped back over until a different card is chosen
  The emoji on the 2nd card is also revealed. If the cards match, the emojis show at 100% opacity, if not they hide again after 400 ms
  Clicking on a card that's scedulded to be flipped back over cancels that flip and keeps the card flipped up until it next needs to be flipped back over (eg click on a couple of incorrect cards then very quickly click on one of those cards again before it flips back over)
  Emojis can't be dragged to prevent a user creating a ghost copy of an emoji following their mouse, which defeats the point of the game (memory!)

  Card images are randomly generated and ordered, such that there's always 2 (or very rarely, 4, 6 etc) of each card
  Once all pairs have been matched, round ends and round points pauses