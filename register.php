<?php
  $x = $_POST;
  for ($i=0; $i<strlen($x["Username"]); $i++) {
    if ($x["Username"][$i] == "\"" or $x["Username"][$i] == "@" or $x["Username"][$i] == "#" or $x["Username"][$i] == "%" or $x["Username"][$i] == "&" or $x["Username"][$i] == "^" or $x["Username"][$i] == "*" or $x["Username"][$i] == "(" or $x["Username"][$i] == ")" or $x["Username"][$i] == "+" or $x["Username"][$i] == "=" or $x["Username"][$i] == "{" or $x["Username"][$i] == "}" or $x["Username"][$i] == "[" or $x["Username"][$i] == "]" or $x["Username"][$i] == "-" or $x["Username"][$i] == ";" or $x["Username"][$i] == ":" or $x["Username"][$i] == "'" or $x["Username"][$i] == "<" or $x["Username"][$i] == ">" or $x["Username"][$i] == "?" or $x["Username"][$i] == "/") {
      setcookie("login_failed",true);
      header("Location: registration.php");
      exit();
    }
  }
  setcookie("Username",$x["Username"]);
  header("Location: index.php");
?>