function validateUsername() {
  username = document.getElementById('username').value;
  return (username.length > 0 && username.length <= 20);
}

function validatePassword() {
  password = document.getElementById('password').value;
  return (password.length > 0 && password.length <= 50);
}

function redElement(elementId, red) {
  var classList = document.getElementById(elementId).classList;
  if (red)
    classList.add('redborder');
  else
    classList.remove('redborder');
  return red;
}

function redUsername() {
  return redElement('username', !validateUsername());
}

function redPassword() {
  return redElement('password', !validatePassword());
}

document.getElementById('username').onblur = redUsername;
document.getElementById('password').onblur = redPassword;

document.getElementById('loginform').addEventListener("submit", function(event) {
  var invalid = [
    redUsername(), redPassword()
  ];
  if (invalid.some(x => x))
    event.preventDefault();
});
