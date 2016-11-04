<?php

  $lastuid = 0;
  if(($handle = fopen("../db/profiles.csv", "r")) !== FALSE){
    while(($profile = fgetcsv($handle, 1000, ","))){
      $lastuid = $profile[0];
    }
    fclose($handle);
  }else{
    echo "ERROR";
    exit();
  }

  if(($handle = fopen("../db/profiles.csv", "a")) !== FALSE){
    $uid      = $lastuid + 1;
    $username = $_POST["name"];
    $posts    = $username . "posts.csv";
    $img      = $_POST["picture"];

    $entry = "$uid, $username, posts, $img\n";
    fwrite($handle, $entry);

    fclose($handle);
  }else{
    echo "ERROR";
    exit();
  }

 ?>
