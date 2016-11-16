<?php

  if(!isset($_POST["username"]) || !isset($_POST["password"])){
    echo "INTERNAL ERROR!";
    exit();
  }

  if(($handle = fopen("profiles.txt", "r")) !== FALSE){
    while($line = fgets($handle)){
      if(trim($line) == "MS_ID:")
        $cuid = (int)trim(fgets($handle));
      if(trim($line) == "Username:")
        $cusn = trim(fgets($handle));
      if(trim($line) == "HashPass:")
        $chps = trim(fgets($handle));
      if(trim($line) == "Picture:")
        $cpic = trim(fgets($handle));
      if(trim($line) == "Friends:"){
        $cfds = trim(fgets($handle));
        if(trim($_POST["username"]) == $cusn && md5(trim($_POST["password"])) == $chps){
          session_start();
          $_SESSION["UID"]      = $cuid;
          $_SESSION["Username"] = $cusn;
          $_SESSION["Picture"]  = $cpic;
          $_SESSION["Friends"]  = $cfds;
          echo "<script type=\"text/javascript\">document.location=\"home.php\"</script>";
          exit();
        }
      }
    }
  }else{
    echo "INTERNAL ERROR!";
    exit();
  }

  echo "<script type=\"text/javascript\">document.location=\"loginfail.html\"</script>";

 ?>
