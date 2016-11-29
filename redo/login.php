<?php

  //Should be getting username and password from login.
  if(!isset($_POST["username"]) || !isset($_POST["password"])){
    echo "INTERNAL ERROR! 1";
    exit();
  }

  //Open profiles for reading.
  if(($handle = fopen("profiles.txt", "r")) === FALSE){
    echo "INTERNAL ERROR! 2";
    exit();
  }

  //Parse through each line, for each profile.
  while($line = fgets($handle)){
    if(trim($line) == "MS_ID:"){
      //Read in profile params.
      $cuid = (int)trim(fgets($handle));
      $junk = trim(fgets($handle));
      $cusn = trim(fgets($handle));
      $junk = trim(fgets($handle));
      $chps = trim(fgets($handle));
      $junk = trim(fgets($handle));
      $cpic = trim(fgets($handle));
      $junk = trim(fgets($handle));
      $cfds = trim(fgets($handle));
      $junk = trim(fgets($handle));
      $class= trim(fgets($handle));
      $junk = trim(fgets($handle));
      $comp = trim(fgets($handle));
      $junk = trim(fgets($handle));
      $bio  = trim(fgets($handle));
      $junk = trim(fgets($handle));
      $full = trim(fgets($handle));

      //Check if this is our user. If so, start the session, then go to homepage.
      if(trim($_POST["username"]) == $cusn && md5(trim($_POST["password"])) == $chps){
        fclose($handle);
        session_start();
        $_SESSION["UID"]      = $cuid;
        $_SESSION["Username"] = $cusn;
        $_SESSION["Picture"]  = $cpic;
        $_SESSION["Friends"]  = $cfds;
        $_SESSION["Class"]    = $class;
        $_SESSION["Company"]  = $comp;
        $_SESSION["Bio"]      = $bio;
        $_SESSION["Fullname"] = $full;
        echo "<script type=\"text/javascript\">document.location=\"home.php\"</script>";
        exit();
      }
    }
  }

  //Close profiles.
  fclose($handle);

  //If reached, login was a failure. Redirect back to login page.
  echo "<script type=\"text/javascript\">document.location=\"loginfail.html\"</script>";

 ?>
