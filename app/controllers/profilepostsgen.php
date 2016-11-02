<?php

  $search = $_POST["search"];
  $sregex = "/" . $search . "/";

  $profilelist = array();
  if(($handle = fopen("../../db/profiles.csv", "r")) !== FALSE){
    while(($profile = fgetcsv($handle, 1000, ",")) !== FASLE){
      $profilelist[count($profilelist)] = $profile;
    }
    fclose($handle);
  }

  #profilelist[i][0] - user id
  #profilelist[i][1] - username
  #profilelist[i][2] - link to posts page
  #profilelist[i][3] - link to image

  echo "<div class=\"profilelist\">";

  for($i = 0; $i < count($profilelist); $i++){
    if(preg_match($regex, $profilelist[$i][1])){
      $uid      = $profilelist[$i][0];
      $username = $profilelist[$i][1];
      $postdb   = $profilelist[$i][2];
      $img      = $profilelist[$i][0];

      echo "<div class=\"profile\">";
      echo "<img src=\"$img\" alt=\"image for $username\"/>";
      echo "<b>$username</b>";
      echo "</div>";
    }
  }

  echo "</div>";


 ?>
