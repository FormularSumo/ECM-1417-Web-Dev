<ul id='navbar' style="font-size:0px">
  <li name="home"><a href="index.php">Home</a></li>
  <li name="memory" style="float:right"><a href="pairs.php">Play Pairs</a></li>
  <?php if(isset($_COOKIE["username"])) : ?>
    <li name="leaderboard" style="float:right"><a href="leaderboard.php">Leaderboard</a></li>
    <li name="avatar">
      <div class=avatar style="margin:-18px">
        <img id="skin" src="emoji assets/skin/green.png" height=50px style="grid-column: 1; grid-row: 1; z-index: 0; opacity: 0;">
        <img id="eyes" src="emoji assets/eyes/closed.png" height=50px style="grid-column: 1; grid-row: 1; z-index: 1; opacity: 0;">
        <img id="mouth" src="emoji assets/mouth/open.png" height=50px style="grid-column: 1; grid-row: 1; z-index: 2; opacity: 0;">
      </div>
    </li>
  <?php else : ?>
    <li name="register" style="float:right"><a href="registration.php">Register</a></li>
  <?php endif; ?>
</ul>

<?php if(isset($_COOKIE["username"])) : ?>
  <script>
    function getCookie(cname) {
      let name = cname + "=";
      let decodedCookie = decodeURIComponent(document.cookie);
      let ca = decodedCookie.split(';');
      for(let i = 0; i <ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == ' ') {
          c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
          return c.substring(name.length, c.length);
        }
      }
      return "";
    }
    window.onload = function() {
      document.getElementById("skin").src = 'emoji assets/skin/' + getCookie("skin") + '.png';
      document.getElementById("eyes").src = 'emoji assets/eyes/' + getCookie("eyes") + '.png';
      document.getElementById("mouth").src = 'emoji assets/mouth/' + getCookie("mouth") + '.png';
      document.getElementById("skin").style.opacity = 1;
      document.getElementById("eyes").style.opacity = 1;
      document.getElementById("mouth").style.opacity = 1;
    };
  </script>
<?php endif; ?>