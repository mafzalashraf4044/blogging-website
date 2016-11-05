<?php
  session_start();

  $_SESSION["login"] = 0;
  $_SESSION["username"] = "";

  //$url = "http://" . $_SERVER['HTTP_HOST'];
  $url=  $_SERVER['SCRIPT_NAME'];
  $url = substr(rtrim(dirname($_SERVER['PHP_SELF']), '/\\'), 0, 33);
  $url .= "/login";
  header('Location: ' . $url, true, 302);
  die();


?>
