<?php
/*The general purpose of this php file is to read in the whole
 *profiles.txt file and rewrite it with the added friends.
 *created (for all intents and purposes) 15NOV16 - Woods, Jake
 */

if(isset($_COOKIE["PHPSESSID"]))
  session_start();

//this if statement taks in the text from profiles.txt and makes old
$old = "";
if(($handle = fopen("profiles.txt", "r")) !== FASLE){
  $old = fread($handle, filesize("profiles.txt"));
  fclose($handle);
}else{
  echo "INTERNAL ERROR!";
  exit();
}

//makes an array of the contents of old split up by newlines
$old = explode("\n", $old);

if(($handle = fopen("profiles.txt", "w")) !== FALSE){
  //this for loop iterates through elements of the array $old
  for($x = 0; $x <= count($old); $x++){
    if($old[$x]=="MS_ID:"){
      fwrite($handle, $old[$x]);            //writes "MS_ID:"
      $cuid = (int)trim($old[$x + 1]);    //takes in the MS ID
    }
    if($cuid == (int)trim($_SESSION["UID"]){ //if the current id is the user's add the freind
      if($old[$x - 1]=="Friends:"){
        fwrite($handle, $old[$x]);
        fwrite($handle, "\t");
        fwrite($handle, $_POST["proid"]);
      }
    }
    if($cuid == (int)$_POST["proid"]){ //if the current id is the id of the added friend
      if($old[$x - 1]=="Friends:"){
        fwrite($handle, $old[$x]);
        fwrite($handle, "\t");
        fwrite($handle, $_SESSION["UID"]);
      }
    }
    if(!($x = 0; $x <= count($old) && !($cuid == (int)trim($_SESSION["UID"]) && !($cuid == (int)$_POST["proid"])){
      fwrite($handle, $old[$x]);
    }
  fclose("profiles.txt");
  }
}else{
  echo "INTERNAL ERROR!";
  exit();
}



echo "<script type=\"text/javascript\">document.location=\"home.php\"</script>";

 ?>
