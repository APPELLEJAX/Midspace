<?php

  require_once("page.inc.php");

  if(isset($_COOKIE["PHPSESSID"]))
    session_start();
  else{
    echo "<script type=\"text/javascript\">document.location=\"login.html\"</script>";
    exit();
  }

  if(!isset($_POST["posttext"]) || !isset($_POST["emote"])){
    echo "INTERNAL ERROR!";
    exit();
  }

  $old = "";
  if(($handle = fopen("posts.txt", "r")) !== FASLE){
    $old = fread($handle, filesize("posts.txt"));
    fclose($handle);
  }else{
    echo "INTERNAL ERROR!";
    exit();
  }

  if(($handle = fopen("posts.txt", "w")) !== FALSE){
    $uid  = $_SESSION["UID"];
    $un   = $_SESSION["Username"];
    $pic  = $_SESSION["Picture"];
    $post = $_POST["posttext"];
    $emtn = $_POST["emote"];
    fwrite($handle, "\nMS_ID:\n$uid\nUsername:\n$un\nPicture:\n$pic\nPost:\n$post\nEmotion:\n$emtn\n");
    fwrite($handle, $old);
  }else{
    echo "INTERNAL ERROR!";
    exit();
  }



  echo "<script type=\"text/javascript\">document.location=\"home.php\"</script>";

 ?>
