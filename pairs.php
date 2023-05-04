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
      let cards_flipped;
      let current_points;
      let pairs_left;
      let pairs;
      let current_level;
      let pair_size;

      function getRandomInteger(min, max) {
        return Math.floor(Math.random() * (max - min + 1) ) + min;
      }

      function createTimeout(timeoutHandler, delay) {
        var timeoutId;
        timeoutId = setTimeout(timeoutHandler, delay);
        return {
          clear: function() {
            clearTimeout(timeoutId);
          },
        };
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

      function updatePoints() {
        total_points = total_points + current_points;
        document.getElementById("total point counter").innerHTML = "Total points: " + Math.round(total_points);
      }

      function createLevel(pair_size,rows,columns) {
        document.getElementById("cards in need of matching").innerHTML = "This round " + pair_size + " cards at a time need matching together";
        cards_flipped = []
        for (i=0;i<pair_size-1;i++) {
          cards_flipped.push(false);
        }
        pairs = [];
        pairs_left = (rows*columns) / pair_size;

        for (let i=0; i < pairs_left; i++) {
          pairs.push(arrayToEmoji([getRandomInteger(0,2),getRandomInteger(0,5),getRandomInteger(0,5)]));
        }

        pairs = cloneArray(pairs,pair_size);
        shuffleArray(pairs);

        level = document.getElementById("level");

        while (level.firstChild) {
          level.firstChild.remove()
        }

        level.style.gridTemplateRows = "repeat(rows, 1fr)";
        level.style.gridTemplateColumns = "repeat(columns, 1fr)";

        let total_cards = 0;
        for (let row=1;row<=rows;row++) {
          for (let column=1;column<=columns;column++) {
            level.insertAdjacentHTML("beforeend","<div class='card' style='grid-column: " + column + "1; grid-row: " + row + "1;'>");
            const card = level.lastChild;
            card.addEventListener("click",() => clicked(card));
            for (let img=0;img<3;img++) {
              card.insertAdjacentHTML("beforeend","<img src=\"" + pairs[total_cards][img] + "\" height=80px draggable=false style=\"grid-column: 1; grid-row: 1; z-index: 0;\">");
            }
            total_cards++;
          }
        }

        updatePoints();
        current_points = 1000;
        game_active=true;
        window.requestAnimationFrame(update);
      }

      function playLevel(level) {
        if (level === 1) {
          document.getElementById("start_button").style.display="none";
          document.getElementById("pairs").style.display="block";
          document.getElementById("round point counter").style.display="block";
          total_points=0;
          current_points=0;
          current_level=1;
          start=undefined;
          createLevel(2,2,3);
        } else if (level === 2) {
          createLevel(2,2,5);
        } else if (level === 3) {
          createLevel(3,3,4);
        } else if (level === 4) {
          createLevel(4,4,5);
        } else {
          updatePoints();
          level = document.getElementById("level");
          while (level.firstChild) {
            level.firstChild.remove();
          }
          document.getElementById("round point counter").style.display="none";
          document.getElementById("cards in need of matching").style.display="none";

          level.insertAdjacentHTML("beforeend","<button id='start_button' onclick=\"playLevel(1)\">Play Again</button>");
        }
      }

      function flipCard(card,opacity) {
        for (const child of card.children) {
          child.style.opacity=opacity;
        }
        if (card.timer) {
          card.timer.clear();
        }
      }

      function clicked(card) {
        if (game_active && cards_flipped.includes(card) === false && card.firstChild.style.opacity != 1) {
          first_flip = (cards_flipped[0] === false);

          if (first_flip == true) {
            flipCard(card,0.8);
            cards_flipped[0] = card;

          } else if (card.children[0].src === cards_flipped[0].children[0].src && card.children[1].src === cards_flipped[0].children[1].src && card.children[2].src === cards_flipped[0].children[2].src){
            
            for (let i=0;i<cards_flipped.length;i++) {
              if (cards_flipped[i] === false) {
                next_flip = i;
                break;
              } else {
                next_flip = false;
              }
            }

            if (next_flip != false) {

              flipCard(card,0.8);
              cards_flipped[next_flip] = card;

            } else {

              for (card2 of cards_flipped) {
                flipCard(card2,1)
              }
              flipCard(card,1)

              pairs_left = pairs_left - 1;
              if (pairs_left === 0) {
                game_active = false;
                current_level++;
                setTimeout(function () {playLevel(current_level)},2000);
              } else {
                for (let i=0;i<cards_flipped.length;i++) {
                  cards_flipped[i] = false
                }
              }
              
            }
          } else {
            flipCard(card,0.8);

            const card3 = card
            card.timer = createTimeout(function() {card3.timer = null; flipCard(card3,0);}, 400); //400ms delay so that user can see the card they've just flipped
            for (const card2 of cards_flipped) {
              if (card2 != false) {
                card2.timer = createTimeout(function() {card2.timer = null; flipCard(card2,0);}, 400);
                current_points = current_points * (1-0.05/current_level**3);
              }
            }
            
            for (let i=0;i<cards_flipped.length;i++) {
              cards_flipped[i] = false
            }
          }
        }
      }

      function update(timestamp) {
        if (start === undefined) {
          start = timestamp;
          previous_timestamp=timestamp
        }
        const elapsed = timestamp - start;

        if (previousTimeStamp !== timestamp) {
          current_points = current_points - (timestamp-previous_timestamp) * 0.0002 * (current_points/1000)**2.5 / current_level**3;
          document.getElementById("round point counter").innerHTML = "Points this round: " + Math.round(current_points);
        }

        previous_TimeStamp = timestamp;
        if (game_active==true) {
          window.requestAnimationFrame(update);
        }
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
          <p id='total point counter'>Total points: 0</p>
          <p id='round point counter'>Points this round: 1000</p>
          <p id='cards in need of matching'>This round 2 cards at a time need matching together</p>

          <div id='level' class='grid'></div>
        </div>
        <button id='start_button' onclick="playLevel(1)">Click here to play</button>
      </div>
    </div>
  </body>
</html>