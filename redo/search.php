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

  if(!isset($_SESSION["Friends"]) || !isset($_SESSION["UID"])){
    $_SESSION["Friends"] = "";
  }


  $search = $_GET["search"];
  $pals   = $_SESSION["Friends"];
  $pals   = explode("\t", $pals);

  if(($handle = fopen("profiles.txt", "r")) !== FALSE){
    $page->content .= "<div class=\"searchlist\">";
    while($line = fgets($handle)){
      if(trim($line) == "MS_ID:")
        $cuid = trim(fgets($handle));
      if(trim($line) == "Username:")
        $cusn = trim(fgets($handle));
      if(trim($line) == "Picture:"){
        $cpic = trim(fgets($handle));
        if(preg_match("/".trim($search)."/i", $cusn) && $cusn != trim($_SESSION["Username"])){
          $page->content .= "<div class=\"searchitem\">";
          $page->content .= "<a href=\"profile.php?proid=$cuid\">";
          $page->content .= "<img src=\"$cpic\" alt=\"$cusn pic\" />";
          $page->content .= "<h4>$cusn</h4>";
          $page->content .= "</a>";
          $wegud = FALSE;
          foreach($pals as &$pal){
            if(trim($pal) == $cuid){ $wegud = TRUE; }
            if(trim($_SESSION["uid"]) == $cuid){ $wegud = TRUE; }
          }
          if(!$wegud){
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
