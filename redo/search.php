<?php

  require_once("page.inc.php");
  //user is required to be logged into use search other redirect to login page
  if(isset($_COOKIE["PHPSESSID"]))
    session_start();
  else{
    echo "<script type=\"text/javascript\">document.location=\"login.html\"</script>";
    exit();
  }

  $page = new Page("Search");
  //if they somehow to get search.php without having a search actually set from the
  //form then they will be redirected to home page
  if(!isset($_GET["search"])){
    echo "<script type=\"text/javascript\">document.location=\"home.php\"</script>";
    exit();
  }

  /*this may be unnecessary come back to later */
  if(!isset($_SESSION["Friends"]) || !isset($_SESSION["UID"])){
    $_SESSION["Friends"] = "";
  }

  //search is the string that was typed by user
  //pals is the long string of all pals with tab delimiter
  $search = $_GET["search"];
  $pals   = $_SESSION["Friends"];
  $pals   = explode("\t", $pals);

  //open profiles for reading users for search
  if(($handle = fopen("profiles.txt", "r")) !== FALSE){
    $page->content .= "<div class=\"searchlist\">";
    while($line = fgets($handle)){
      if(trim($line) == "MS_ID:")
        $cuid = trim(fgets($handle));
      if(trim($line) == "Username:")
        $cusn = trim(fgets($handle));
      if(trim($line) == "Picture:"){
        $cpic = trim(fgets($handle));
        //we do regular expression matching with the search and the username while ignoring the
        //user that is doing the searching (we don't want to display themselves on the search)
        if(preg_match("/".trim($search)."/i", $cusn) && $cusn != trim($_SESSION["Username"])){
          //displays user information in div format for each person who matches search
          $page->content .= "<div class=\"searchitem\">";
          $page->content .= "<a href=\"profile.php?proid=$cuid\">";
          $page->content .= "<img src=\"$cpic\" alt=\"$cusn pic\" />";
          $page->content .= "<h4>$cusn</h4>";
          $page->content .= "</a>";
          $wegud = FALSE;
          //wegud is changed to True and thus not displayed if the person that matches
          //is themselves or already a friend
          foreach($pals as &$pal){
            if(trim($pal) == $cuid){ $wegud = TRUE; }
            if(trim($_SESSION["uid"]) == $cuid){ $wegud = TRUE; }
          }
          if(!$wegud){ //wegud is false so there is a match and it isn't a friend already so display that person's info
            $page->content .= "<form method=\"post\" action=\"addfriend.php\">";
            $page->content .= "<input type=\"submit\" value=\"+ Friend\" />";
            $page->content .= "<input type=\"hidden\" name=\"proid\" value=\"$cuid\" />";
            $page->content .= "</form>";
          }
          $page->content .= "</div>";
        }
      }
    }
    $page->content .= "</div>";
  }else{
    echo "INTERNAL ERROR!";
    exit();
  }

  $page->display();

 ?>
