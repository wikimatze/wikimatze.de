document.querySelector("#form-email").addEventListener("invalid", function(){
  document.getElementById('form-email').setAttribute("class","input is-danger");
});

document.querySelector("#form-email").addEventListener('input', function () {
  if (document.querySelector("#form-email").validity.valid) {
    document.getElementById('form-email').setAttribute("class","input is-success");
  }
});

document.querySelector("#form-subject").addEventListener("invalid", function(){
  document.getElementById('form-subject').setAttribute("class","input is-danger");
});

document.querySelector("#form-subject").addEventListener('input', function () {
  if (document.querySelector("#form-subject").validity.valid) {
    document.getElementById('form-subject').setAttribute("class","input is-success");
  }
});

document.querySelector("#form-message").addEventListener("invalid", function(){
  document.getElementById('form-message').setAttribute("class","textarea is-danger");
});

document.querySelector("#form-message").addEventListener('input', function () {
  if (document.querySelector("#form-message").validity.valid) {
    document.getElementById('form-message').setAttribute("class","textarea is-success");
  }
});

