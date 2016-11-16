<?php

  require_once("page.inc.php");

  if(isset($_COOKIE["PHPSESSID"]))
    session_start();

  $page = new Page("Profile");

  if(isset($_GET["proid"])){
    if(($handle = fopen("profiles.txt", "r")) !== FALSE){
      while($line = fgets($handle)){
        if(trim($line) == "MS_ID:")
          $cuid = (int)trim(fgets($handle));
        if(trim($line) == "Username:")
          $cusn = trim(fgets($handle));
        if(trim($line) == "Picture:")
          $cpic = trim(fgets($handle));
        if(trim($line) == "Friends:"){
          $cfds = trim(fgets($handle));
          $proid = $_GET["proid"];
          if(trim($proid) == trim($cuid)){
            $page->content .= "<div class=\"proinfo\">";
            $page->content .= "<img src=\"$cpic\" alt=\"profile pic\" />";
            $page->content .= "<h3>$cusn</h3>";
            $page->content .= "<div class=\"friendlist\">";
          }
        }
      }
    }

  }else{
    $proname    = $_SESSION["Username"];
    $proimg     = $_SESSION["Picture"];
    $profriends = $_SESSION["Friends"];
    $profriends = explode("\t", $profriends);


    $page->content .= "<div class=\"proinfo\">";
    $page->content .= "<img src=\"$proimg\" alt=\"profile pic\" />";
    $page->content .= "<h3>$proname</h3>";
    $page->content .= "<div class=\"friendlist\">";
    if(($handle = fopen("profiles.txt", "r")) !== FALSE){
      while($line = fgets($handle)){
        if(trim($line) == "MS_ID:")
          $cuid = (int)trim(fgets($handle));
        if(trim($line) == "Username:")
          $cusn = trim(fgets($handle));
        if(trim($line) == "Picture:"){
          $cpic = trim(fgets($handle));
          foreach($profriends as &$profriend){
            if($cuid == (int)trim($profriend)){
              $page->content .= "<div class=\"frienditem\">";
              $page->content .= "<img src=\"$cpic\" alt=\"$cusn pic\" />";
              $page->content .= "<h4>$cusn</h4>";
              $page->content .= "</div>";
            }
          }
        }
      }
      fclose($handle);
    }
    $page->content .= "</div>";

  }

  $page->display();

 ?>
