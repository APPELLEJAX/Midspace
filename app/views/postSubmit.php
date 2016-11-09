<?php
require_once('../controllers/page.inc.php');

$page = new Page("Post created");

$thepost = $_COOKIE['username'];
$thepost .= "~" . $_GET['postbox'] . "\n";
$postlist = array();
if(($handle = fopen("../../db/posts.csv", "a")) !== FALSE){
  fwrite($handle, $thepost);
  fclose($handle);
}else{
  $page->content .= "DATABASE ERROR";
  $page->display();
  exit();
}
$page->content .= "<script>window.location = \"posts.php\";</script>";
$page->display();
?>
