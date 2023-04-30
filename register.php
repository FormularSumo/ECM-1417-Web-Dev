<?php
  $x = $_POST;
  for ($i=0; $i<strlen($x["username"]); $i++) {
    if ($x["username"][$i] == "\"" or $x["username"][$i] == "@" or $x["username"][$i] == "#" or $x["username"][$i] == "%" or $x["username"][$i] == "&" or $x["username"][$i] == "^" or $x["username"][$i] == "*" or $x["username"][$i] == "(" or $x["username"][$i] == ")" or $x["username"][$i] == "+" or $x["username"][$i] == "=" or $x["username"][$i] == "{" or $x["username"][$i] == "}" or $x["username"][$i] == "[" or $x["username"][$i] == "]" or $x["username"][$i] == "-" or $x["username"][$i] == ";" or $x["username"][$i] == ":" or $x["username"][$i] == "'" or $x["username"][$i] == "<" or $x["username"][$i] == ">" or $x["username"][$i] == "?" or $x["username"][$i] == "/") {
      setcookie("login_failed",true);
      header("Location: registration.php");
      exit();
    }
  }
  setcookie("username",$x["username"]);
  setcookie("skin",$x["skin"]);
  setcookie("eyes",$x["eyes"]);
  setcookie("mouth",$x["mouth"]);
  header("Location: index.php");
?>