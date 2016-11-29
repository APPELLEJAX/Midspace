<?php

  //Page will generate viewable content.
  require_once("page.inc.php");

  //Check if a user is logged in. If not, redirect to login page.
  if(isset($_COOKIE["PHPSESSID"])){
    session_start();
  }
  else{
    echo "<script type=\"text/javascript\">document.location=\"login.html\"</script>";
    exit();
  }

  //Start this profile page.
  $page = new Page("Profile");

  //Two vains here, one if we are querying a user in this page, the other if it's nonqueried (ie self-lookup);
  if(isset($_GET["proid"])){

    //paramatize proid
    $proid = $_GET["proid"];

    //Open profiles for reading.
    if(($handle = fopen("profiles.txt", "r")) === FALSE){
      echo "INTERNAL ERROR!";
      exit();
    }

    //Iterate over each line and profile object.
    while($line = fgets($handle)){
      if(trim($line) == "MS_ID:"){

        //Read in profile params
        $cuid = (int)trim(fgets($handle));
        $junk = trim(fgets($handle));
        $cusn = trim(fgets($handle));
        $junk = trim(fgets($handle));
        $junk = trim(fgets($handle));
        $junk = trim(fgets($handle));
        $cpic = trim(fgets($handle));
        $junk = trim(fgets($handle));
        $cfds = trim(fgets($handle));
        $junk = trim(fgets($handle));
        $class= trim(fgets($handle));
        $junk = trim(fgets($handle));
        $comp = trim(fgets($handle));
        $junk = trim(fgets($handle));
        $bio  = trim(fgets($handle));
        $junk = trim(fgets($handle));
        $full = trim(fgets($handle));
        $cfds = explode("\t", $cfds);

        //Filter for queried profile.
        if(trim($proid) == trim($cuid)){

          //Generate Profile info: Name, Picture, and FriendList
          $page->content .= "<div class=\"proinfo\"><h2>$full @$cusn</h2>";
          $page->content .= "<img src=\"$cpic\" alt=\"$cpic pic\" />";
          $page->content .= "<h3>Company $comp Class of $class</h3>";
          $page->content .= "<p>Bio: <br /><br />$bio</p>";
          $page->content .= "<div class=\"friendlist\"><h2>Friends</h2>";

          //Open profiles to read for friends...
          if(($handlee = fopen("profiles.txt", "r")) === FALSE){
            echo "INTERNAL ERROR!";
            exit();
          }

          //Iterate over each line and profile object.
          while($linee = fgets($handlee)){
            if(trim($linee) == "MS_ID:"){

              //Instantiate relevant friend-profile info.
              $_cuid = (int)trim(fgets($handlee));
              $junk  = trim(fgets($handlee));
              $_cusn = trim(fgets($handlee));
              $junk  = trim(fgets($handlee));
              $junk  = trim(fgets($handlee));
              $junk  = trim(fgets($handlee));
              $_cpic = trim(fgets($handlee));

              //filter for query's friends.
              foreach($cfds as &$cfd){
                if((int)trim($cfd) == $_cuid){

                  //Generate frienditem content.
                  $page->content .= "<div class=\"frienditem\">";
                  $page->content .= "<img src=\"$_cpic\" alt=\"$_cusn pic\" />";
                  $page->content .= "<h4>$_cusn</h4>";
                  $page->content .= "</div>";

                }

              }

            }

          }

          //close friendlist div
          $page->content .= "</div>";

          //close profileinfo div
          $page->content .= "</div>";

          //Close profiles
          fclose($handlee);

          //>THIS IS WHERE TEXTBOX GOES

          //Generate post list for query.
          $page->content .= "<div class=\"postlist\">";

          //Open posts for reading.
          if(($handlee = fopen("posts.txt", "r")) === FALSE){
            echo "INTERNAL ERROR!";
            exit();
          }

          //Iterate over each line and post object.
          while($line = fgets($handlee)){
            if(trim($line) == "MS_ID:"){

              //Instantiate post params.
              $_cuid = (int)trim(fgets($handlee));
              $junk  = trim(fgets($handlee));
              $_cusn = trim(fgets($handlee));
              $junk  = trim(fgets($handlee));
              $_cpic = trim(fgets($handlee));
              $junk  = trim(fgets($handlee));
              $_cpst = trim(fgets($handlee));
              $junk  = trim(fgets($handlee));
              $_cemt = trim(fgets($handlee));
              $junk  = trim(fgets($handlee));
              $_ctim = trim(fgets($handlee));

              //Filter for own posts.
              if($_cuid == $cuid){

                //Generate postitem.
                $page->content .= "<div class=\"postitem\">";
                $page->content .= "<h4>$_ctim</h4><p>$_cpst<b> -feeling $_cemt</b></p>";
                $page->content .= "</div>";

              }

            }

          }

          //Close postlist div
          $page->content .= "</div>";

          //Close posts.
          fclose($handlee);

        }

      }

    }

    /* BELOW IS THE TRANSITION TO VIEWING YOUR OWN PROFILE.
       Should mirror above.
    */

  }else{
    //save appropiate profile info to be used later
    $proname    = $_SESSION["Username"];
    $proimg     = $_SESSION["Picture"];
    $profriends = $_SESSION["Friends"];
    $proclass   = $_SESSION["Class"];
    $procompany = $_SESSION["Company"];
    $probio     = $_SESSION["Bio"];
    $proFullname= $_SESSION["Fullname"];

    //Generate Profile info: Name, Picture, class, company, bio
    //proinfo class needs subclasses h2, h3, img, and p
    $page->content .= "<div class=\"proinfo\"><h2>$proFullname @$proname</h2>";
    $page->content .= "<img src=\"$proimg\" alt=\"$proimg pic\" />";
    $page->content .= "<h3>Company $procompany Class of $proclass</h3>";
    $page->content .= "<p>Bio: <br /><br />$probio</p>";
    //generate friend list
    if(trim($profriends) != ""){
      $profriends = explode("\t", $profriends);
      $page->content .= "<div class=\"friendlist\"><h2>Friends</h2>";

      //Open profiles for reading one friend at a time.
      if(($handle = fopen("profiles.txt", "r")) === FALSE){
        echo "INTERNAL ERROR!";
        exit();
      }
      //below displays info for each friend
      while($line = fgets($handle)){
        if(trim($line) == "MS_ID:")
          $cuid = (int)trim(fgets($handle));
        if(trim($line) == "Username:")
          $cusn = trim(fgets($handle));
        if(trim($line) == "Picture:"){
          $cpic = trim(fgets($handle));
          foreach($profriends as &$profriend){
            if($cuid == (int)trim($profriend) && trim($profriend) != ""){
              $page->content .= "<div class=\"frienditem\">";
              $page->content .= "<img src=\"$cpic\" alt=\"$cusn pic\" />";
              $page->content .= "<h4>$cusn</h4>";
              $page->content .= "</div>";
            }
          }
        }
      }
    fclose($handle);
    $page->content .= "</div>";
    }
    $page->content .= "</div>";

    //transition in page from friends list to posts
    $page->content .= "</div>";
    $page->content .= "<div class=\"postbox\"><form method=\"post\" action=\"createpost.php\">";
    $page->content .= "<textarea name=\"posttext\" placeholder=\"Tell us what you think...\"></textarea>";
    $page->content .= "<b>-feeling</b><select name=\"emote\"><option value=\"Happy\">Happy</option><option value=\"Angry\">Angry</option><option value=\"Sad\">Sad</option><option value=\"Anxious\">Anxious</option></select>";
    $page->content .= "<input type=\"submit\" value=\"Post\" />";
    $page->content .= "</form></div>";
    $page->content .= "<div class=\"postlist\"><h2>Posts</h2>";

    //Open posts for reading.
    if(($handle = fopen("posts.txt", "r")) === FALSE){
      echo "INTERNAL ERROR!";
      exit();
    }
    //read and put post info into contents of page to be displayed
    while($line = fgets($handle)){
      if(trim($line) == "MS_ID:")
        $cuid = (int)trim(fgets($handle));
      if(trim($line) == "Username:")
        $cusn = trim(fgets($handle));
      if(trim($line) == "Picture:")
        $cpic = trim(fgets($handle));
      if(trim($line) == "Post:")
        $cpst = trim(fgets($handle));
      if(trim($line) == "Emotion:")
        $cemt = trim(fgets($handle));
      if(trim($line) == "Timestamp:"){
        $ctim = trim(fgets($handle));
        if(isset($_COOKIE["PHPSESSID"])){
          if($cuid == (int)trim($_SESSION["UID"])){
            $page->content .= "<div class=\"propost\">";
            $page->content .= "<h4>$ctim</h4b>";
            $page->content .= "<p>$cpst<b> - feeling $cemt</b></p>";
            $page->content .= "</div>";
            }
          }
        }
      }
    fclose($handle);
  }

  //Generate content.
  $page->display();

 ?>
