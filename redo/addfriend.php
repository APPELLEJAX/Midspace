<?php

  //Check if a user is logged in. If not, redirect to login page.
  if(isset($_COOKIE["PHPSESSID"]))
    session_start();
  else{
    echo "<script type=\"text/javascript\">document.location=\"login.html\"</script>";
    exit();
  }

  //Should be getting a "proid" to add a user.
  if(!isset($_SESSION["UID"]) || !isset($_POST["proid"])){
    echo "INTERNAL ERROR! 1";
    exit();
  }

  //Make proid and userid variables
  $uid = (int)trim($_SESSION["UID"]);
  $pid = (int)trim($_POST["proid"]);

  //Open profiles for reading.
  if(($handle = fopen("profiles.txt", "r")) === FALSE){
    echo "INTERNAL ERROR! 2";
    exit();
  }

  //Place all the data into old as an array split over newlines.
  $old = fread($handle, filesize("profiles.txt"));
  $old = explode("\n", $old);

  //Close profiles.
  fclose($handle);

  //Open profiles for writing, erase current content.
  if(($handle = fopen("profiles.txt", "w")) === FALSE){
    echo "INTERNAL ERROR! 3";
    exit();
  }

  //Iterate over each line. Writeback irrelevant lines, append to affected lines.
  foreach($old as &$line){

    //Pull current id information from file as we iterate over each line.
    if(trim($lastline) == "MS_ID:")
      $cuid = (int)trim($line);

    //Append to lines affected by add-friend
    if(trim($lastline) == "Friends:" && $cuid == $pid)
      $line = trim($line)."\t$uid";
    if(trim($lastline) == "Friends:" && $cuid == $uid)
      $line = trim($line)."\t$pid";

    //Set lastline for iteration framework.
    $lastline = $line;

    //Writeback line.
    fwrite($handle, $line."\n");

  }

  //Update session with new friend.
  $_SESSION["Friends"] .= "\t".$pid;

  //Redirect to new friend's profile.
  echo "<script type=\"text/javascript\">document.location=\"profile.php?proid=$pid\"</script>";

 ?>
