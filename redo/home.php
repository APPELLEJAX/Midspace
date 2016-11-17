<?php

  //Page will generate viewable content.
  require_once("page.inc.php");

  //Check if a user is logged in.
  if(isset($_COOKIE["PHPSESSID"]))
    session_start();

  //Start our home page.
  $page = new Page("Home");


  //If user a user is logged in, give the post form.
  if(isset($_COOKIE["PHPSESSID"])){
    $page->content .= "<div class=\"postbox\"><form method=\"post\" action=\"createpost.php\">";
    $page->content .= "<textarea name=\"posttext\" placeholder=\"Tell us what you think...\"></textarea>";
    $page->content .= "<select name=\"emote\"><option value=\"Happy\">Happy</option><option value=\"Angry\">Angry</option><option value=\"Sad\">Sad</option><option value=\"Anxious\">Anxious</option></select>";
    $page->content .= "<input type=\"submit\" value=\"Post\" />";
    $page->content .= "</form></div>";
  }else{
    $page->content .= "<div class=\"advisory\">You are viewing all posts on Midspace as a guest. To access more functionality, <a href=\"login.html\">log in</a> or <a hraf=\"signup.html\">sign up</a></div>"
  }

  //Open posts for reading.
  if(($handle = fopen("posts.txt", "r")) === FALSE){
    echo "INTERNAL ERROR";
    exit();
  }

  //Generate the post listings.
  $page->content .= "<div class=\"postlist\">";
  //Iterate over each line and post object.
  while($line = fgets($handle)){
    if(trim($line) == "MS_ID:"){
      //Instantiate post data.
      $cuid = (int)trim(fgets($handle));
      $junk = trim(fgets($handle));
      $cusn = trim(fgets($handle));
      $junk = trim(fgets($handle));
      $cpic = trim(fgets($handle));
      $junk = trim(fgets($handle));
      $cpst = trim(fgets($handle));
      $junk = trim(fgets($handle));
      $cemt = trim(fgets($handle));
      //If user is signed in, filter in only friend's and own posts.
      if(isset($_COOKIE["PHPSESSID"])){
        $friends = explode("\t", $_SESSION["Friends"]);
        foreach($friends as &$friend)
        if($cuid == (int)trim($friend) || $cuid == (int)trim($_SESSION["UID"])){
          $page->content .= "<div class=\"postitem\">";
          $page->content .= "<img src=\"$cpic\" />";
          $page->content .= "<h4><b>$cusn</b> feeling $cemt</h4>";
          $page->content .= "<p>$cpst</p>";
          $page->content .= "</div>";
        }
      }else{
        $page->content .= "<div class=\"postitem\">";
        $page->content .= "<img src=\"$cpic\" />";
        $page->content .= "<h4><b>$cusn</b> feeling $cemt</h4>";
        $page->content .= "<p>$cpst</p>";
        $page->content .= "</div>";
      }
    }
  }
  $page->content .= "</div>";

  //Close posts
  fclose($handle);

  //Generate content.
  $page->display();

 ?>
