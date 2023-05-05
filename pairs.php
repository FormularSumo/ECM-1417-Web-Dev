<!DOCTYPE html>
<html lang-en>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Memory - Pairs Minigame</title>
    <link rel="stylesheet" href="style.css">

    <script>
      "use strict";
      let totalPoints;
      let gameActive;
      let start, previousTimestamp;
      let cardsFlipped;
      let currentPoints;
      let pairsLeft;
      let pairs;
      let currentLevel;
      let pairSize;
      let totalCards;
      let scores;

      function getRandomInteger(min, max) {
        return Math.floor(Math.random() * (max - min + 1) ) + min;
      }

      function createTimeout(timeouthandler, delay) {
        const timeoutId = setTimeout(timeouthandler, delay);
        return {
          clear: function() {
            clearTimeout(timeoutId);
          },
        };
      }

      function playSound (id) { //Creates an audio element of the sound effect and plays it, then deletes the element upon completion
        let audio = document.createElement("audio");
        audio.src = "sound effects/" + id + ".mp3";
        audio.addEventListener("ended", function () {
          this.remove();
        });
        audio.play()
      }

      function cloneArray(array, clone_amount){
        let temporaryArray = [];
        for(let i=0; i<array.length; i++){
          for(let j=0; j<clone_amount; j++){
            temporaryArray.push(array[i]);
          }
        }
        return temporaryArray;
      }

      function shuffleArray(array) {
        for (let i = array.length - 1; i > 0; i--) {
          const j = Math.floor(Math.random() * (i + 1));
            [array[i], array[j]] = [array[j], array[i]];
        }
      }

      function arrayToEmoji(array) {
        let newArray=[];

        if (array[0] === 0) {
          newArray.push('emoji assets/skin/green.png');
        } else if (array[0] === 1) {
          newArray.push('emoji assets/skin/red.png');
        } else if (array[0] === 2) {
          newArray.push('emoji assets/skin/yellow.png');
        }

        if (array[1] === 0) {
          newArray.push('emoji assets/eyes/closed.png');
        } else if (array[1] === 1) {
          newArray.push('emoji assets/eyes/laughing.png');
        } else if (array[1] === 2) {
          newArray.push('emoji assets/eyes/long.png');
        } else if (array[1] === 3) {
          newArray.push('emoji assets/eyes/normal.png');
        } else if (array[1] === 4) {
          newArray.push('emoji assets/eyes/rolling.png');
        } else if (array[1] === 5) {
          newArray.push('emoji assets/eyes/winking.png');
        }

        if (array[2] === 0) {
          newArray.push('emoji assets/mouth/open.png');
        } else if (array[2] === 1) {
          newArray.push('emoji assets/mouth/sad.png');
        } else if (array[2] === 2) {
          newArray.push('emoji assets/mouth/smiling.png');
        } else if (array[2] === 3) {
          newArray.push('emoji assets/mouth/straight.png');
        } else if (array[2] === 4) {
          newArray.push('emoji assets/mouth/surprise.png');
        } else if (array[2] === 5) {
          newArray.push('emoji assets/mouth/teeth.png');
        }

        return newArray;
      }

      function updatePoints() {
        totalPoints = totalPoints + currentPoints;
        scores.push(currentPoints);

        if (currentLevel != -1) {
          let currentHighscore = currentLevel + "Highscore";
          if (getCookie(currentHighscore) != "") {
            if (getCookie(currentHighscore) < currentPoints) {
              if (getCookie(currentHighscore) != 0) {
                document.getElementById("content").style.backgroundColor = "#FFD700";
                setTimeout(function () {document.getElementById("content").style.backgroundColor = "grey";}, 1800)
              }
              document.cookie=currentHighscore + "=" + currentPoints;
            }
          } else {
            document.cookie=currentHighscore + "=" + currentPoints;
          }
        }
      }

      function redrawPoints() {
        let currentHighscore = currentLevel + "Highscore";
        if (getCookie(currentHighscore) == "") {
          document.getElementById("level highscore").innerHTML = "Previous highscore for this level: none";
        } else {
          document.getElementById("level highscore").innerHTML = "Previous highscore for this level: " + Math.round(getCookie(currentHighscore));
        }

        document.getElementById("total point counter").innerHTML = "Total points: " + Math.round(totalPoints);
      }

      function createLevel(size,rows,columns) {
        pairSize = size;
        document.getElementById("cards in need of matching").innerHTML = "This round " + pairSize + " cards at a time need matching together";
        cardsFlipped = [];
        for (let i=0;i<pairSize-1;i++) {
          cardsFlipped.push(false);
        }
        pairs = [];
        pairsLeft = (rows*columns) / pairSize;

        for (let i=0; i < pairsLeft; i++) {
          pairs.push(arrayToEmoji([getRandomInteger(0,2),getRandomInteger(0,5),getRandomInteger(0,5)]));
        }

        pairs = cloneArray(pairs,pairSize);
        shuffleArray(pairs);

        level = document.getElementById("level");

        while (level.firstChild) {
          level.firstChild.remove();
        }

        level.style.gridTemplateRows = "repeat(rows, 1fr)";
        level.style.gridTemplateColumns = "repeat(columns, 1fr)";

        totalCards = 0;
        for (let row=1;row<=rows;row++) {
          for (let column=1;column<=columns;column++) {
            level.insertAdjacentHTML("beforeend","<div class='card' style='grid-column: " + column + "1; grid-row: " + row + "1;'>");
            const card = level.lastChild;
            card.addEventListener("click",() => clicked(card));
            for (let img=0;img<3;img++) {
              card.insertAdjacentHTML("beforeend","<img src=\"" + pairs[totalCards][img] + "\" height=80px draggable=false style=\"grid-column: 1; grid-row: 1; z-index: 0;\">");
            }
            totalCards++;
          }
        }

        redrawPoints()
        start=undefined;
        currentPoints = 1000;
        gameActive=true;
        window.requestAnimationFrame(update);
      }

      function createCustomLevel(form) {
        if (form.rows.value === "" || form.columns.value === "" || form.pairSize.value === "") {
          if (document.getElementById("error message") === null) {
            document.getElementById("custom level").insertAdjacentHTML("afterend","<p id='error message'>None of the values can be empty..</p>");
          } else if (document.getElementById("error message").innerHTML != "None of the values can be empty..") {
            document.getElementById("error message").innerHTML = "None of the values can be empty";
          }
        } else if (Number.isInteger(form.rows.value) === false || Number.isInteger(form.columns.value) === false || Number.isInteger(form.pairSize.value) === false) {
          if (document.getElementById("error message") === null) {
            document.getElementById("custom level").insertAdjacentHTML("afterend","<p id='error message'>Non-numeric values are not allowed..</p>");
          } else if (document.getElementById("error message").innerHTML != "Non-numeric values are not allowed") {
            document.getElementById("error message").innerHTML = "Non-numeric values are not allowed";
          }
        } else if (form.rows.value < 1 || form.columns.value < 1 || form.pairSize.value < 1) {
          if (document.getElementById("error message") === null) {
            document.getElementById("custom level").insertAdjacentHTML("afterend","<p id='error message'>None of the values can be less than 1..</p>");
          } else if (document.getElementById("error message").innerHTML != "None of the values can be less than 1..") {
            document.getElementById("error message").innerHTML = "None of the values can be less than 1..";
          }
        } else if (form.rows.value * form.columns.value < 2) {
          if (document.getElementById("error message") === null) {
            document.getElementById("custom level").insertAdjacentHTML("afterend","<p id='error message'>Have to have at least 2 cards</p>");
          } else if (document.getElementById("error message").innerHTML != "error message'>Have to have at least 2 cards") {
            document.getElementById("error message").innerHTML = "Have to have at least 2 cards";
          }
        } else if (form.pairSize.value < 2) {
          if (document.getElementById("error message") === null) {
            document.getElementById("custom level").insertAdjacentHTML("afterend","<p id='error message'>Pair size can't be less than 2</p>");
          } else if (document.getElementById("error message").innerHTML != "Pair size can't be less than 2") {
            document.getElementById("error message").innerHTML = "Pair size can't be less than 2";
          }
        } else if ((form.rows.value*form.columns.value)%form.pairSize.value != 0) {
          if (document.getElementById("error message") === null) {
            document.getElementById("custom level").insertAdjacentHTML("afterend","<p id='error message'>Total cards (rows * columns) must be divisible by pair size</p>");
          } else if (document.getElementById("error message").innerHTML != "Total cards (rows * columns) must be divisible by pair size") {
            document.getElementById("error message").innerHTML = "Total cards (rows * columns) must be divisible by pair size";
          }
        } else {
          document.getElementById("total point counter").style.display="block";
          document.getElementById("round point counter").style.display="block";
          document.getElementById("cards in need of matching").style.display="block";

          createLevel(form.pairSize.value,form.rows.value,form.columns.value);
        }
      }

      function customLevel() {
        document.getElementById("start button").remove();
        document.getElementById("total point counter").style.display="none";
        
        totalPoints = 0;
        currentLevel = -1;

        level.insertAdjacentHTML("beforeend",`
        
        <form id='custom level' action="javascript:createCustomLevel(this);" method="post">
          <label for="pairSize">Pair size: </label>
          <input type="text" id="pairSize" name="pairSize"><br>

          <label for="rows">Number of rows: </label>
          <input type="text" id="rows" name="rows"><br>

          <label for="columns">Number of columns: </label>
          <input type="text" id="columns" name="columns"><br><br>

          <input type="submit" value="Play">
        </form>`
        )
      }

      function playLevel(level) {
        if (level === 1) {
          document.getElementById("start button").remove();
          document.getElementById("pairs").style.display="block";
          document.getElementById("level highscore").style.display="block";
          
          totalPoints=0;
          currentPoints=0;
          currentLevel=1;
          scores = [];
          redrawPoints()
          createLevel(2,2,3);
        } else if (level === 2) {
          createLevel(2,2,5);
        } else if (level === 3) {
          createLevel(2,3,4);
        } else if (level === 4) {
          createLevel(2,4,5);
        } else {
          level = document.getElementById("level");
          while (level.firstChild) {
            level.firstChild.remove();
          }
          document.getElementById("round point counter").style.display="none";
          document.getElementById("total point counter").style.display="block";
          document.getElementById("cards in need of matching").style.display="none";
          document.getElementById("level highscore").style.display="none";
          document.getElementById("total point counter").innerHTML = "Total points: " + Math.round(totalPoints);
          currentPoints=0;

          level.insertAdjacentHTML("beforeend","<button id='start button' onclick=\"replay('playLevel(1)')\">Play Again</button><br><br>");
          level.insertAdjacentHTML("beforeend","<button id='custom level button' onclick=\"replay('customLevel()')\">Create level</button>");
          if (currentLevel != 0) {
            level.insertAdjacentHTML("beforeend","<button id='submit score' onclick=\"updateLeaderboard()\">Submit scores to leaderboard</button>");
          }
        }
      }

      function replay(play) {
        document.getElementById("custom level button").remove();
        if (document.getElementById("submit score")) {document.getElementById("submit score").remove()};
        
        if (play != 'customLevel()') {
          document.getElementById("round point counter").style.display="block";
        }
        document.getElementById("total point counter").innerHTML = "Total points: 0";

        eval(play);
      }

      function updateLeaderboard () {
        document.getElementById("submit score").remove()

        level.insertAdjacentHTML("beforeend","<p id='submit score'>Scores submitted<br>Open leaderboard to see</p>");

        fetch('submit score.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
          },
          body: "totalPoints=" + Math.round(totalPoints) + "&level1Points=" + Math.round(scores[0]) + "&level2Points=" + Math.round(scores[1]) + "&level3Points=" + Math.round(scores[2]) + "&level4Points=" + Math.round(scores[3]),
        })
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
        if (gameActive && cardsFlipped.includes(card) === false && card.firstChild.style.opacity != 1) {
          const firstFlip = (cardsFlipped[0] === false);

          if (firstFlip == true) {
            flipCard(card,0.8);
            cardsFlipped[0] = card;

          } else if (card.children[0].src === cardsFlipped[0].children[0].src && card.children[1].src === cardsFlipped[0].children[1].src && card.children[2].src === cardsFlipped[0].children[2].src) {
            let nextFlip;
            for (let i=0;i<cardsFlipped.length;i++) {
              if (cardsFlipped[i] === false) {
                nextFlip = i;
                break;
              } else {
                nextFlip = false;
              }
            }

            if (nextFlip != false) {
              flipCard(card,0.8);
              cardsFlipped[nextFlip] = card;

            } else {

              for (const card2 of cardsFlipped) {
                flipCard(card2,1);
              }
              flipCard(card,1);

              pairsLeft = pairsLeft - 1;
              if (pairsLeft === 0) {
                document.getElementById("Level complete").play(); //No need for multiple Level complete sounds to play at once as the pause after completing a level is longer than the sound
                gameActive = false;
                updatePoints();
                currentLevel++;
                setTimeout(function () {playLevel(currentLevel);},1800);
              } else {
                playSound("Match"); //Creating a new copy of the sound allows it to be played multiple times if a user is very quick at matching cards
                for (let i=0;i<cardsFlipped.length;i++) {
                  cardsFlipped[i] = false;
                }
              }
            }
          } else {
            flipCard(card,0.8);

            const card3 = card;
            card.timer = createTimeout(function() {card3.timer = null; flipCard(card3,0);}, 400); //400ms delay so that user can see the card they've just flipped
            for (const card2 of cardsFlipped) {
              if (card2 != false) {
                card2.timer = createTimeout(function() {card2.timer = null; flipCard(card2,0);}, 400);
                currentPoints = currentPoints * (1-0.05/(totalCards/6*pairSize/2));
              }
            }
            
            for (let i=0;i<cardsFlipped.length;i++) {
              cardsFlipped[i] = false;
            }
          }
        }
      }

      function update(timestamp) {
        if (start === undefined) {
          start = timestamp;
          previousTimestamp=timestamp;
        }
        const elapsed = timestamp - start;

        if (previousTimestamp !== timestamp) {
          currentPoints = currentPoints - (timestamp-previousTimestamp) * 0.05 * (currentPoints/1000)**2.5 / (totalCards/6*pairSize/2);
          document.getElementById("round point counter").innerHTML = "Points this round: " + Math.round(currentPoints);
        }

        previousTimestamp = timestamp;
        if (gameActive==true) {
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
        <?php if(isset($_COOKIE["username"])) : ?>
          <div id='pairs' style="display:none; width=80%;">
            <p id='total point counter'>Total points: 0</p>
            <p id='round point counter'>Points this round: 1000</p>
            <p id='level highscore'>Previous highscore for this level: none</p>
            <p id='cards in need of matching'>This round 2 cards at a time need matching together</p>

            <div id='level' class='grid'></div>
          </div>
          <button id='start button' onclick="playLevel(1);">Click here to play</button>

          <audio id="Level complete" controls style="display:none">
            <source src="sound effects/Level complete.mp3" type="audio/mp3">
          </audio>
        <?php else: ?>
          <p>Please register before playing</p>
        <?php endif;?>
      </div>
    </div>
  </body>
</html>