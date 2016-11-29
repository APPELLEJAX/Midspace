<?php

  //Should be recieving username, password, and image from the signup page.
  if(!isset($_POST["username"]) || !isset($_POST["password"]) || !isset($_POST["img"])){
    echo "INTERNAL ERROR!";
    exit();
  }

  //Open up profiles to read.
  if(($handle = fopen("profiles.txt", "r")) === FALSE){
    echo "INTERNAL ERROR!";
    exit();
  }

  //Parse file to find 1) If username is taken. 2) What the new uid should be.
  $nextUID = 1;
  while($line = fgets($handle)){
    if(trim($line) == "MS_ID:")
    $nextUID = (int)trim(fgets($handle)) + 1;
    if(trim($line) == "Username:")
    if(trim($_POST["username"]) == trim(fgets($handle))){
      fclose($handle);
      echo "<script type=\"text/javascript\">document.location=\"alreadytaken.html\"</script>";
      exit();
    }
  }

  //Close profiles.
  fclose($handle);

  //Set new profile variables
  $uid        = $nextUID;
  $fullname   = trim($_POST["realname"]);
  $username   = trim($_POST["username"]);
  $hashpass   = md5(trim($_POST["password"]));
  $profilepic = trim($_POST["img"]);
  $classYear  = trim($_POST["class"]);
  $company    = trim($_POST["comp"]);
  $bio        = trim($_POST["bio"]);
  if($profilepic == ""){ $profilepic = "./default.jpg"; }

  //Open up profiles to append.
  if(($handle = fopen("profiles.txt", "a")) === FALSE){
    echo "INTERNAL ERROR!";
    exit();
  }

  //Append in our new profile.
  fwrite($handle, "\nMS_ID:\n$uid\nUsername:\n$username\nHashPass:\n$hashpass\nPicture:\n$profilepic\nFriends:\n\nClass:\n$classYear\nCompany:\n$company\nBio:\n$bio\nFull Name:\n$fullname\n\n");

  //Close profiles.
  fclose($handle);

  //Redirect back to the login page.
  echo "<script type=\"text/javascript\">document.location=\"login.html\";</script>";

 ?>
