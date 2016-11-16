<?php

  if(isset($_COOKIE["PHPSESSID"]))
    session_start();

  session_unset();
  session_destroy();

  setcookie("PHPSESSID", "", time() - 3600, "/");

  echo "<script type=\"text/javascript\">document.location=\"login.html\"</script>";

 ?>
