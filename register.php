<?php
  $x = $_POST;
  if ($x["username"] == "") {
    setcookie("login_failed",'empty');
    header("Location: registration.php");
    exit();
  }
  for ($i=0; $i<strlen($x["username"]); $i++) {
    if ($x["username"][$i] == "\"" or $x["username"][$i] == "@" or $x["username"][$i] == "#" or $x["username"][$i] == "%" or $x["username"][$i] == "&" or $x["username"][$i] == "^" or $x["username"][$i] == "*" or $x["username"][$i] == "(" or $x["username"][$i] == ")" or $x["username"][$i] == "+" or $x["username"][$i] == "=" or $x["username"][$i] == "{" or $x["username"][$i] == "}" or $x["username"][$i] == "[" or $x["username"][$i] == "]" or $x["username"][$i] == "-" or $x["username"][$i] == ";" or $x["username"][$i] == ":" or $x["username"][$i] == "'" or $x["username"][$i] == "<" or $x["username"][$i] == ">" or $x["username"][$i] == "?" or $x["username"][$i] == "/") {
      setcookie("login_failed",'special characters');
      header("Location: registration.php");
      exit();
    }
  }
  foreach ($_COOKIE as $key => $value) { //Clear cookies in case user has played before and is reregistering, and clear now unneeded login_failed cookie
    setcookie($key, $value, 1);
  }
  setcookie("username",$x["username"]);
  setcookie("skin",$x["skin"]);
  setcookie("eyes",$x["eyes"]);
  setcookie("mouth",$x["mouth"]);
  header("Location: index.php");
?>