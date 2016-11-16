<?php

  class Page{
    public $content;
    private $title = "Midspace";
    private $stylesheet = "main.css";

    public function __construct($title){
      $this->title .= " - " . $title;
    }

    public function display(){
      echo "<!DOCTYPE html><html><head><title>$this->title</title>";
      echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"$this->stylesheet\" />";
      echo "</head><body>";
      $this->displayNavbar();
      $this->displayContent();
      echo "</body></html>";
    }

    public function displayNavbar(){
      echo "<div class=\"nav\">";
      echo "<form class=\"navSRC\" method=\"get\" action=\"search.php\">";
      echo "<input id=\"search\" type=\"text\" name=\"search\" placeholder=\"Search Midspace Users...\" /><input type=\"submit\" value=\"Search\" />";
      echo "</form>";
      echo "<a class=\"navLNK\" href=\"home.php\"><img src=\"home.png\" alt=\"home\" />Home</a>";
      echo "<a class=\"navLNK\" href=\"profile.php\"><img src=\"profile.png\" alt=\"profile\" />PROFILE</a>";
      echo "<a class=\"navLNK\" href=\"logout.php\"><img src=\"exit.png\" alt=\"exit\" />Logout</a>";
      echo "</div>";
      echo "<br /><br /><br /><br /><br /><br />";
    }

    public function displayContent(){
      echo $this->content;
    }
  }

 ?>
