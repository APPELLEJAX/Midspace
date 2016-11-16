<?php

  require_once("page.inc.php");

  if(isset($_COOKIE["PHPSESSID"]))
    session_start();
  else{
    echo "<script type=\"text/javascript\">document.location=\"login.html\"</script>";
    exit();
  }

  $page = new Page("Search");

  if(!isset($_GET["search"])){
    echo "<script type=\"text/javascript\">document.location=\"home.php\"</script>";
    exit();
  }

  $search = $_GET["search"];

  if(($handle = fopen("profiles.txt", "r")) !== FALSE){
    $page->content .= "<div class=\"searchlist\">";
    while($line = fgets($handle)){
      if(trim($line) == "MS_ID:")
        $cuid = trim(fgets($handle));
      if(trim($line) == "Username:")
        $cusn = trim(fgets($handle));
      if(trim($line) == "Picture:"){
        $cpic = trim(fgets($handle));
        if(preg_match("/".trim($search)."/i", $cusn)){
          $page->content .= "<a href=\"profile.php?proid=$cuid\" class=\"searchitem\">";
          $page->content .= "<img src=\"$cpic\" alt=\"$cusn pic\" />";
          $page->content .= "<h4>$cusn</h4>";
          $page->content .= "</a>";
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
