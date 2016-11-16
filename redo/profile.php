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
          $cfds = explode("\t", $cfds);
          $proid = $_GET["proid"];
          if(trim($proid) == trim($cuid)){
            $page->content .= "<div class=\"proinfo\">";
            $page->content .= "<img src=\"$cpic\" alt=\"profile pic\" />";
            $page->content .= "<h3>$cusn</h3>";
            $page->content .= "</div>";
          }
        }
      }
    }
    fclose($handle);
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
      $page->content .= "</div>";
      $page->content .= "</div>";
      fclose($handle);
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
            if($cuid == (int)trim($_SESSION["UID"])){
              $page->content .= "<div class=\"propost\">";
              $page->content .= "<img class=\"propic\" src=\"$cpic\" />";
              $page->content .= "<h4><b>$cusn</b> feeling $cemt</h4>";
              $page->content .= "<p>$cpst</p>";
              $page->content .= "</div>";
            }
          }
        }
      }
    }
  }
  if(isset($_GET["proid"])){
    $proid = $_GET["proid"];
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
            if($cuid == trim($proid)){
              $page->content .= "<div class=\"propost\">";
              $page->content .= "<img class=\"propic\" src=\"$cpic\" />";
              $page->content .= "<h4><b>$cusn</b> feeling $cemt</h4>";
              $page->content .= "<p>$cpst</p>";
              $page->content .= "</div>";
            }
          }
        }
      }
    }
  }

  $page->display();

 ?>
