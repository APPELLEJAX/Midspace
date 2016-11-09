<?php

  class Page{
    public $content;
    private $title = "Midspace";
    private $stylesheet = "../views/mainpage.css";

    public function __construct($title){
      $this->title .= " - " . $title;
    }

    public function __set($name, $value){
      $value = trim($value);
      $value = strip_tags($value);
      $this->$name = $value;
    }

    public function display(){
      echo "<!DOCTYPE html>";
      echo "<html><head>";
      echo "<title>$this->title</title>";
      echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"$this->stylesheet\" />";
      echo "</head><body>";
      $this->displayNavbar();
      $this->displayContent();
      echo "</body></html>";
    }

    public function displayNavbar(){

      echo "<div class=\"nav\">";

      echo "<form class=\"navSRC\" method=\"get\" action=\"\">";
      echo "<input id=\"mysearch\" type=\"text\" size=\"20\" name=\"search\" placeholder=\"Search Midspace Users...\" />";
      echo "<input type=\"submit\" value=\"Search\" />";
      echo "</form>";

      echo "<a class=\"navLNK\" href=\"posts.php\"><img src=\"../resources/home.png\" />Home</a>";

      echo "<a class=\"navLNK\" href=\"profile.php\"><img src=\"../resources/profile.png\" />Profile</a>";

      echo "</div>";
     }

    public function displayContent(){
      echo $this->content;
    }
  }

 ?>
