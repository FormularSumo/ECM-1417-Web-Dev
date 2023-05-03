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
      let current_point;
      let pairs_left;
      let pairs;

      function getRandomInteger(min, max) {
        return Math.floor(Math.random() * (max - min + 1) ) + min;
      }

      function cloneArray(array, cloneAmount){
        var temporary_array = [];
        for(i=0; i<array.length; i++){
          for(j=0; j<cloneAmount; j++){
            temporary_array.push(array[i]);
          }
        }
        return temporary_array;
      }

      function shuffleArray(array) {
        for (let i = array.length - 1; i > 0; i--) {
          const j = Math.floor(Math.random() * (i + 1));
            [array[i], array[j]] = [array[j], array[i]];
        }
      }

      function arrayToEmoji(array) {
        array2=[]

        if (array[0] === 0) {
          array2.push('emoji assets/skin/green.png')
        } else if (array[0] === 1) {
          array2.push('emoji assets/skin/red.png')
        } else if (array[0] === 2) {
          array2.push('emoji assets/skin/yellow.png')
        }

        if (array[1] === 0) {
          array2.push('emoji assets/eyes/closed.png')
        } else if (array[1] === 1) {
          array2.push('emoji assets/eyes/laughing.png')
        } else if (array[1] === 2) {
          array2.push('emoji assets/eyes/long.png')
        } else if (array[1] === 3) {
          array2.push('emoji assets/eyes/normal.png')
        } else if (array[1] === 4) {
          array2.push('emoji assets/eyes/rolling.png')
        } else if (array[1] === 5) {
          array2.push('emoji assets/eyes/winking.png')
        }

        if (array[2] === 0) {
          array2.push('emoji assets/mouth/open.png')
        } else if (array[2] === 1) {
          array2.push('emoji assets/mouth/sad.png')
        } else if (array[2] === 2) {
          array2.push('emoji assets/mouth/smiling.png')
        } else if (array[2] === 3) {
          array2.push('emoji assets/mouth/straight.png')
        } else if (array[2] === 4) {
          array2.push('emoji assets/mouth/surprise.png')
        } else if (array[2] === 5) {
          array2.push('emoji assets/mouth/teeth.png')
        }

        return array2;
      }

      function createLevel(pairSize,rows,columns) {
        pairs = [];
        pairs_left = (rows*columns) / pairSize;

        for (let i=0; i < pairs_left; i++) {
          pairs.push(arrayToEmoji([getRandomInteger(0,2),getRandomInteger(0,5),getRandomInteger(0,5)]));
        }

        pairs = cloneArray(pairs,pairSize);
        shuffleArray(pairs);

        level = document.getElementById("level");

        delete level.children;

        level.style.gridTemplateRows = "repeat(rows, 1fr)";
        level.style.gridTemplateColumns = "repeat(columns, 1fr)";

        let cards = 0;
        for (let row=1;row<=rows;row++) {
          for (let column=1;column<=columns;column++) {
            level.insertAdjacentHTML("beforeend","<div class='card' style='grid-column: " + column + "1; grid-row: " + row + "1;'>");
            const card = level.lastChild;
            card.addEventListener("click",() => clicked(card));
            for (let img=0;img<3;img++) {
              card.insertAdjacentHTML("beforeend","<img src=\"" + pairs[cards][img] + "\" height=80px draggable=false style=\"grid-column: 1; grid-row: 1; z-index: 0;\">");
            }
            cards++;
          }
        }
      }

      function level1() {
        document.getElementById("start_button").style.display="none";
        document.getElementById("pairs").style.display="block";
        total_points=0;
        game_active=true;
        window.requestAnimationFrame(update);

        createLevel(2,2,3);
      }

      function clicked(card) {
        if (card_flipped == false) {
          card_flipped = card;
          for (const child of card_flipped.children) {
            child.style.opacity=0.8;
          }
          if (card_flipped.timer) {
            card_flipped.timer.clear();
          }
        } else {
          for (const child of card.children) {
            child.style.opacity=0.8;
          }
          if (card.timer) {
            card.timer.clear();
          } else if (card_flipped != card) {
            if (card_flipped != card && card.children[0].src === card_flipped.children[0].src && card.children[1].src === card_flipped.children[1].src && card.children[2].src === card_flipped.children[2].src) {
              for (const child of card_flipped.children) {
                child.style.opacity=1;
              }
              for (const child of card.children) {
                child.style.opacity=1;
              }
              pairs_left = pairs_left - 1;
              if (pairs_left === 0) {
                game_active = false;
              }
            } else {
              const card_to_be_cleared = card; //Consts are used so that card_flipped can be cleared and this function can be run again
              card.timer = createTimeout(function() {card_to_be_cleared.timer = null; for (const child of card_to_be_cleared.children) {child.style.opacity=0;}}, 400); //400ms delay so that user can see the card they've just flipped
              const card_to_be_cleared2 = card_flipped;
              card_flipped.timer = createTimeout(function() {card_to_be_cleared2.timer = null;for (const child of card_to_be_cleared2.children) {child.style.opacity=0;}}, 400);
              current_points = current_points * 0.95;
            }
            card_flipped = false;
          }
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
          document.getElementById("round point counter").innerHTML = "Points this round: " + Math.round(current_points);
        }

        previous_TimeStamp = timestamp;
        if (game_active==true) {
          window.requestAnimationFrame(update);
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
          <p id='point counter'>Total points: 0</p>
          <p id='round point counter'>Points this round: 1000</p>

          <div id='level' class='grid'></div>
        </div>
        <button id='start_button' onclick="level1()">Click here to play</button>
      </div>
    </div>
  </body>
</html>