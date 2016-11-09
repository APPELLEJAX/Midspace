<?php

  require_once("../controllers/page.inc.php");

  $page = new Page("Posts");

  $page->content .= "<br /><br /><br /><br /><br /><br />";
  $page->content .= "<div class=\"postbox\"><form method=\"get\" action=\"postSubmit.php\">";
  $page->content .= "<textarea id=\"postbox\" name=\"postbox\" placeholder=\"Tell us what you think...\"></textarea>";
  $page->content .= "<input type=\"submit\" value=\"Post\" />";
  $page->content .= "</form></div>";

  $postlist = array();
  if(($handle = fopen("../../db/posts.csv", "r")) !== FALSE){
    while(($post = fgets($handle)) !== FALSE){
      $postlist[count($postlist)] = $post;
    }
    fclose($handle);
  }else{
    $page->content .= "DATABASE ERROR";
    $page->display();
    exit();
  }

  $page->content .= "<div class=\"postlist\">";

  for($i = count($postlist) - 1 ; ($i >= 0 && $i >= count($postlist) - 20) ; $i--){
    $post = explode("~", $postlist[$i]);
    $page->content .= "<h4>$post[0]</h4>";
    $page->content .= "<p>$post[1]</p>";
  }

  $page->content .= "</div>";

  $page->display();

 ?>
