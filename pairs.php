<!DOCTYPE html>
<html lang-en>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Memory - Pairs Minigame</title>
    <link rel="stylesheet" href="style.css">

    <script>
      let total_points;
      let game_active;
      let start, previousTimeStamp;
      let card_flipped = false;

      function begin() {
        document.getElementById("start_button").style.display="none";
        document.getElementById("pairs").style.display="block";
        total_points=0;
        game_active=true;
        window.requestAnimationFrame(update);
        for (const child of document.getElementById('level 1').children) {
          child.addEventListener("click",() => clicked(child));
        }
      }

      function update(timestamp) {
        if (start === undefined) {
          start = timestamp;
          current_points = 1000;
          previous_timestamp=timestamp
        }
        const elapsed = timestamp - start;

        if (previousTimeStamp !== timestamp) {
          current_points = current_points - (timestamp-previous_timestamp) * 0.0002 * (current_points/1000)**2.5;
          document.getElementById("point counter").innerHTML = "Points: " + Math.round(current_points);
        }

        previous_TimeStamp = timestamp;
        if (game_active==true) {
          window.requestAnimationFrame(update);
        }
      }

      function clicked(card) {
        if (card_flipped == false) {
          card_flipped = card;
          for (const child of card_flipped.children) {
            child.style.opacity=1;
          }
          if (card_flipped.timer) {
            card_flipped.timer.clear();
          }
        } else {
          for (const child of card.children) {
            child.style.opacity=1;
          }
          if (card.timer) {
            card.timer.clear();
          }
          if (card_flipped == card) {
            for (const child of card_flipped.children) {child.style.opacity=0;} //If same card is clicked again to cancel, flip instantly as player has already seen it
          } else if (card_flipped != card && card.children[0].src === card_flipped.children[0].src && card.children[1].src === card_flipped.children[1].src && card.children[2].src === card_flipped.children[2].src) {
            game_active = false;
          } else {
            const card_to_be_cleared = card; //Consts are used so that card_flipped can be cleared and this function can be run again
            card.timer = createTimeout(function() {card_to_be_cleared.timer = null; for (const child of card_to_be_cleared.children) {child.style.opacity=0;}}, 400) //400ms delay so that user can see the card they've just flipped
            const card_to_be_cleared2 = card_flipped;
            card_flipped.timer = createTimeout(function() {card_to_be_cleared2.timer = null;for (const child of card_to_be_cleared2.children) {child.style.opacity=0;}}, 400)
          }
          card_flipped = false;
        }
      }

    function createTimeout(timeoutHandler, delay) {
      var timeoutId;
      timeoutId = setTimeout(timeoutHandler, delay);
      return {
        clear: function() {
          clearTimeout(timeoutId);
        },
        trigger: function() {
          clearTimeout(timeoutId);
          return timeoutHandler();
        }
      };
    }
    </script>
  </head>

  <body style="font-size:0">
    <?php 
      include('navbar.php');
    ?>

    <div id='main'>
      <div id='content' style="background-color:grey; box-shadow:0px 0px 5px 5px #515151;">
        <div id='pairs' style="display:none; width=80%;">
          <p id='point counter'>Points: 1000</p>
          <div id='level 1' class='grid' style='grid-template-columns: repeat(3, 1fr)'>
            <div class='card' style='grid-column: 1; grid-row: 1;'>
              <img src="emoji assets/skin/yellow.png" height=80px style="grid-column: 1; grid-row: 1; z-index: 0;">
              <img src="emoji assets/eyes/closed.png" height=80px style="grid-column: 1; grid-row: 1; z-index: 1;">
              <img src="emoji assets/mouth/open.png" height=80px style="grid-column: 1; grid-row: 1; z-index: 2;">
            </div>
            <div class='card' style='grid-column: 2; grid-row: 1;'>
              <img src="emoji assets/skin/green.png" height=80px style="grid-column: 1; grid-row: 1; z-index: 0;">
              <img src="emoji assets/eyes/closed.png" height=80px style="grid-column: 1; grid-row: 1; z-index: 1;">
              <img src="emoji assets/mouth/open.png" height=80px style="grid-column: 1; grid-row: 1; z-index: 2;">
            </div>
            <div class='card' style='grid-column: 3; grid-row: 1;'>
              <img src="emoji assets/skin/red.png" height=80px style="grid-column: 1; grid-row: 1; z-index: 0;">
              <img src="emoji assets/eyes/closed.png" height=80px style="grid-column: 1; grid-row: 1; z-index: 1;">
              <img src="emoji assets/mouth/open.png" height=80px style="grid-column: 1; grid-row: 1; z-index: 2;">
            </div>
            <div class='card' style='grid-column: 1; grid-row: 2;'>
              <img src="emoji assets/skin/green.png" height=80px style="grid-column: 1; grid-row: 1; z-index: 0;">
              <img src="emoji assets/eyes/closed.png" height=80px style="grid-column: 1; grid-row: 1; z-index: 1;">
              <img src="emoji assets/mouth/open.png" height=80px style="grid-column: 1; grid-row: 1; z-index: 2;">
            </div>
            <div class='card' style='grid-column: 2; grid-row: 2;'>
              <img src="emoji assets/skin/green.png" height=80px style="grid-column: 1; grid-row: 1; z-index: 0;">
              <img src="emoji assets/eyes/closed.png" height=80px style="grid-column: 1; grid-row: 1; z-index: 1;">
              <img src="emoji assets/mouth/open.png" height=80px style="grid-column: 1; grid-row: 1; z-index: 2;">
            </div>
            <div class='card' style='grid-column: 3; grid-row: 2;'>
              <img src="emoji assets/skin/green.png" height=80px style="grid-column: 1; grid-row: 1; z-index: 0;">
              <img src="emoji assets/eyes/closed.png" height=80px style="grid-column: 1; grid-row: 1; z-index: 1;">
              <img src="emoji assets/mouth/open.png" height=80px style="grid-column: 1; grid-row: 1; z-index: 2;">
            </div>
          </div>
        </div>
        <button id='start_button' onclick="begin()">Click here to play</button>
      </div>
    </div>
  </body>
</html>