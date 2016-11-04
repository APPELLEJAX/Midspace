<?php

  $profilelist = array();
  if(($handle = fopen("../../db/profiles.csv", "r")) !== FALSE){
    while(($profile = fgetcsv($handle, 1000, ",")) !== FASLE){
      $profilelist[count($profilelist)] = $profile;
    }
    fclose($handle);
  }else{
    echo "ERROR";
    exit();
  }

  #profilelist[i][0] - user id
  #profilelist[i][1] - username
  #profilelist[i][2] - link to posts page
  #profilelist[i][3] - link to image

  $postlist = array();
  if(($handle = fopen("../../db/posts.csv", "r")) !== FALSE){
    while(($post = fgetcsv($handle, 1000, ",")) !== FALSE){
      $postlist[count($postlist)] = $post;
    }
    fclose($handle);
  }else{
    echo "ERROR";
    exit();
  }

  #postlist[i][0] - user id
  #postlist[i][1] - mood
  #postlist[i][2] - message

  echo "<div class=\"postlist\">";

  for($i = count($postlist) - 1; $i >= count($postlist) - 10; $i--){
    $mood     = $postlist[$i][1];
    $msg      = $postlist[$i][2];
    $username = "";
    $img      = "";
    for($ii = 0; $ii < count($profilelist); $ii++){
      if($postlist[$i][0] == $profilelist[$ii][0]){
        $username = $profilelist[$ii][1];
        $img = $profilelist[$ii][3];
      }
    }
    echo "<div class=\"post\">";
    echo "<img src=\"$img\" alt=\"image for $username\" />";
    echo "<b>$username</b><br />";
    echo "<p>$msg - feeling: $mood</p>";
    echo "</div>";
  }

  echo "</div>";

 ?>
