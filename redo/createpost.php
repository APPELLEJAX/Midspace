<?php

  //Check for active session. Else send to login page.
  if(isset($_COOKIE["PHPSESSID"]))
    session_start();
  else{
    echo "<script type=\"text/javascript\">document.location=\"login.html\"</script>";
    exit();
  }

  //Should be getting posttext and emote from the post form.
  if(!isset($_POST["posttext"]) || !isset($_POST["emote"])){
    echo "INTERNAL ERROR!";
    exit();
  }

  //Open up posts for reading.
  if(($handle = fopen("posts.txt", "r")) === FASLE){
    echo "INTERNAL ERROR!";
    exit();
  }

  //Put ALL OF THE POSTS into the old variable.
  $old = fread($handle, filesize("posts.txt"));

  //Cloase posts.
  fclose($handle);

  //Open up posts to write, delete all data.
  if(($handle = fopen("posts.txt", "w")) === FALSE){
    echo "INTERNAL ERROR!";
    exit();
  }

  //Generate post data, and write it into the page.
  $uid  = $_SESSION["UID"];
  $un   = $_SESSION["Username"];
  $pic  = $_SESSION["Picture"];
  $post = $_POST["posttext"];
  $emtn = $_POST["emote"];
  $time = date("d M, Y h:i");
  //$post = trim($post);
  fwrite($handle, "\nMS_ID:\n$uid\nUsername:\n$un\nPicture:\n$pic\nPost:\n$post\nEmotion:\n$emtn\nTimestamp:\n$time\n");

  //Replace all old data.
  fwrite($handle, $old);

  //Close posts.
  fclose($handle);

  //Redirect back to user's profile page or home page depending on where they came from.

  $camefrom = $_SERVER['HTTP_REFERER'];
  $camefrom = "/".substr($camefrom, -8, -1)."/";
  if(preg_match(trim($camefrom), "home.ph"))
    echo "<script type=\"text/javascript\">document.location=\"home.php\"</script>";
  else
    echo "<script type=\"text/javascript\">document.location=\"profile.php\"</script>";

  ?>
