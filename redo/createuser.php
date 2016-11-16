<?php

  class User{
    var $uid;
    var $username;
    var $hashpass;
    var $profilepic;
    var $friends;

    function __construct(){
      $uid = "";
      $username = "";
      $hashpass = "";
      $profilepic = "";
      $friends = "";
    }
  }

  if(!isset($_POST["username"]) || !isset($_POST["password"]) || !isset($_POST["img"])){
    echo "INTERNAL ERROR!";
    exit();
  }

  $nextUID = 000;
  if(($handle = fopen("profiles.txt", "r")) !== FALSE){
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
    fclose($handle);
  }else{
    echo "INTERNAL ERROR!";
    exit();
  }

  if(trim($_POST["img"]) == ""){
    $_POST["img"] = "./default.jpg";
  }

  $newUser             = new User();
  $newUser->uid        = $nextUID;
  $newUser->username   = trim($_POST["username"]);
  $newUser->hashpass   = md5(trim($_POST["password"]));
  $newUser->profilepic = trim($_POST["img"]);
  $newUser->friends    = "";

  if(($handle = fopen("profiles.txt", "a")) !== FALSE){
    fwrite($handle, "\nMS_ID:\n$newUser->uid\nUsername:\n$newUser->username\nHashPass:\n$newUser->hashpass\nPicture:\n$newUser->profilepic\nFriends:\n$newUser->friends\n");
  }else{
    echo "INTERNAL ERROR!";
    exit();
  }

  echo "<script type=\"text/javascript\">document.location=\"login.html\";</script>";

 ?>
