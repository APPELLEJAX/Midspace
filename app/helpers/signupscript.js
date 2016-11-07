//Scripts used on singup page.

function validate(){
  return validateUN() && validatePSS() && validateIMG();
}

function validateUN(){
  var field = document.getElementById("username");
  if(field.value == null || field.value == ""){
    field.style = "background: #ffaaaa;";
    return false;
  }
  field.style = "";
  return true;
}

function validatePSS(){
  var field = document.getElementById("password");
  if(field.value == null || field.value == ""){
    field.style = "background: #ffaaaa;";
    return false;
  }
  if(field.value.length < 8){
    field.value = null;
    field.placeholder = "8+ characters"
    field.style = "background: #ffaaaa;";
    return false;
  }
  field.style = "";
  return true;
}

function validateIMG(){
  var field = document.getElementById("img");
  if(field.value == null || field.value == ""){
    field.style = "background: #ffaaaa;";
    return false;
  }
  field.style = "";
  return true;
}

document.write("OH SHIT");
