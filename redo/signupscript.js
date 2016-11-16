function validateUN(){
  var val = document.getElementById("username");
  if(val.value == null || val.value == ""){
    document.getElementById("usernamemsg").innerHTML = "Username Required.";
    return false;
  }
  document.getElementById("usernamemsg").innerHTML = null;
  return true;
}

function validatePSS(){
  var val = document.getElementById("password");
  if(val.value == null || val.value == ""){
    document.getElementById("passwordmsg").innerHTML = "Password Required.";
    return false;
  }
  if(val.value.length < 8){
    document.getElementById("passwordmsg").innerHTML = "Password must be at least 8 characters.";
    return false;
  }
  document.getElementById("passwordmsg").innerHTML = null;
  return true;
}

function validateIMG(){
  var val = document.getElementById("img");
  if(val.value != null || val.value != ""){

  }

  return true;
}

function validate(){
  validateUN() || validatePSS() || validateIMG();
  return validateUN() && validatePSS() && validateIMG()
}
