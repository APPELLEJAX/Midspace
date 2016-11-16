<?php

  require_once("page.inc.php");

  if(isset($_COOKIE["PHPSESSID"]))
    session_start();

  $page = new Page("Home");

  if(isset($_COOKIE["PHPSESSID"])){
    $page->content .= "<div class=\"postbox\"><form method=\"post\" action=\"createpost.php\">";
    $page->content .= "<textarea name=\"posttext\" placeholder=\"Tell us what you think...\"></textarea>";
    $page->content .= "<select name=\"emote\"><option value=\"Happy\">Happy</option><option value=\"Angry\">Angry</option><option value=\"Sad\">Sad</option><option value=\"Anxious\">Anxious</option></select>";
    $page->content .= "<input type=\"submit\" value=\"Post\" />";
    $page->content .= "</form></div>";
  }

  if(($handle = fopen("posts.txt", "r")) !== FASLE){
    while($line = fgets($handle)){
      if(trim($line) == "MS_ID:")
        $cuid = (int)trim(fgets($handle));
      if(trim($line) == "Username:")
        $cusn = trim(fgets($handle));
      if(trim($line) == "Picture:")
        $cpic = trim(fgets($handle));
      if(trim($line) == "Post:")
        $cpst = trim(fgets($handle));
      if(trim($line) == "Emotion:"){
        $cemt = trim(fgets($handle));
        if(isset($_COOKIE["PHPSESSID"])){
          $friends = explode("\t", $_SESSION["Friends"]);
          foreach($friends as &$friend)
            if($cuid == (int)trim($friend)){
              $page->content .= "<div class=\"postlist\">";
              $page->content .= "<img class=\"propic\" src=\"$cpic\" />";
              $page->content .= "<h4><b>$cusn</b> feeling $cemt</h4>";
              $page->content .= "<p>$cpst</p>";
              $page->content .= "</div>";
            }
          if($cuid == (int)trim($_SESSION["UID"]) && $cuid != ""){
            $page->content .= "<div class=\"postlist\">";
            $page->content .= "<img class=\"propic\" src=\"$cpic\" />";
            $page->content .= "<h4><b>$cusn</b> feeling $cemt</h4>";
            $page->content .= "<p>$cpst</p>";
            $page->content .= "</div>";
          }
        }else{
          $page->content .= "<div class=\"postlist\">";
          $page->content .= "<img class=\"propic\" src=\"$cpic\" />";
          $page->content .= "<h4><b>$cusn</b> feeling $cemt</h4>";
          $page->content .= "<p>$cpst</p>";
          $page->content .= "</div>";
        }
      }
    }
  }else{
    echo "INTERNAL ERROR";
    exit();
  }

  $page->display();

 ?>
