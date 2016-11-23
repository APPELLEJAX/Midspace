function validateUN(){
  var val = document.getElementById("username");
  if(val.value == null || val.value == ""){
    document.getElementById("usernamemsg").innerHTML = "Username Required.";
    return false;
  }
  document.getElementById("usernamemsg").innerHTML = null;
  return true;
}

function validateRN(){
  var val = document.getElementById("realname");
  if(val.value == null || val.value == ""){
    document.getElementById("realnamemsg").innerHTML = "Name Required.";
    return false;
  }
  document.getElementById("realnamemsg").innerHTML = null;
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

function validatePS2(){
  var val = document.getElementById("password2");
  if(val.value == null || val.value == ""){
    document.getElementById("password2msg").innerHTML = "Verify Password.";
    return false;
  }
  if(val.value != document.getElementById("password").value){
    document.getElementById("password2msg").innerHTML = "Does not match!";
    return false;
  }
  document.getElementById("password2msg").innerHTML = null;
  return true;
}

function validateIMG(){
  var val = document.getElementById("img");
  if(val.value == null || val.value == ""){

  }
  return true;
}

function validateBIO(){
  var val = document.getElementById("img");
  if(val.value == null || val.value == ""){

  }
  return true;
}


function validate(){
  validateUN() || validateRN() || validatePSS() || validatePS2() || validateIMG() || validateBIO();
  return validateUN() && validateRN() && validatePSS()  && validatePS2() && validateIMG() && validateBIO();
}
