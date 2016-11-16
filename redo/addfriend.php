<?php
/*The general purpose of this php file is to read in the whole
 *profiles.txt file and rewrite it with the added friends.
 *created (for all intents and purposes) 15NOV16 - Woods, Jake
 */

if(isset($_COOKIE["PHPSESSID"]))
  session_start();
else{
  echo "<script type=\"text/javascript\">document.location=\"login.html\"</script>";
  exit();
}

if(!isset($_SESSION["UID"]) || !isset($_POST["proid"])){
  echo "INTERNAL ERROR! 1";
  exit();
}

//echo "<h1>".$_SESSION["UID"].":".$_POST["proid"]."</h1>";

//this if statement taks in the text from profiles.txt and makes old
$old = "";
if(($handle = fopen("profiles.txt", "r")) !== FASLE){
  $old = fread($handle, filesize("profiles.txt"));
  fclose($handle);
}else{
  echo "INTERNAL ERROR! 2";
  exit();
}

//makes an array of the contents of old split up by newlines
$old = explode("\n", $old);

if(($handle = fopen("profiles.txt", "w")) !== FALSE){
  for($i = 0; $i < count($old); $i++){
    if(trim($old[$i]) == "MS_ID:"){
      $cuid = (int)trim($old[++$i]);
      fwrite($handle, "\nMS_ID:\n$cuid\n");
    }
    if(trim($old[$i]) == "Username:")
      fwrite($handle, "Username:\n".trim($old[++$i])."\n");
    if(trim($old[$i]) == "HashPass:")
      fwrite($handle, "HashPass:\n".trim($old[++$i])."\n");
    if(trim($old[$i]) == "Picture:")
      fwrite($handle, "Picture:\n".trim($old[++$i])."\n");
    if(trim($old[$i]) == "Friends:"){
      fwrite($handle, "Friends:\n".trim($old[++$i]));
      if($cuid == trim($_SESSION["UID"]))
        fwrite($handle, "\t".trim($_POST["proid"]));
      if($cuid == trim($_POST["proid"]))
        fwrite($handle, "\t".trim($_SESSION["UID"]));
      fwrite($handle, "\n");
    }
  }
}else{
  echo "INTERNAL ERROR! 3";
  exit();
}

$goto = trim($_POST["proid"]);

$_SESSION["Friends"] .= "\t".$goto;

echo "<script type=\"text/javascript\">document.location=\"profile.php?proid=$goto\"</script>";

 ?>
