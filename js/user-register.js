function redElement(elementId, red) {
  var classList = document.getElementById(elementId).classList;
  if (red)
    classList.add('redborder');
  else
    classList.remove('redborder');
  return red;
}

var checkState = {'usercheck': 0, 'emailcheck': 0};

function showCheckmark(checkmarkId, show) {
  // show is tri-state: 1=check, 0=hidden, -1=cross
  var element = document.getElementById(checkmarkId);
  checkState[checkmarkId] = show;
  if (show == 0)
    element.src = probookStaticBase + 'img/clear.png';
  else if (show == 1)
    element.src = probookStaticBase + 'img/checklist.png';
  else if (show == -1)
    element.src = probookStaticBase + 'img/crossmark.png';
}

function checkUnique(inputId, requestKey, checkmarkId) {
  input = document.getElementById(inputId).value;
  xhr = new XMLHttpRequest();
  obj = {};
  obj[requestKey] = input;
  content = JSON.stringify(obj);
  xhr.open('POST', probookPageBase + 'register/validate');
  xhr.setRequestHeader('Content-Type', 'application/json;charset=UTF-8');
  xhr.onreadystatechange = function () {
    if(this.readyState == 4 && this.status == 200) {
      response = JSON.parse(this.responseText);
      showCheckmark(checkmarkId, response[requestKey] ? 1 : -1);
    }
  };
  xhr.send(content);
}

function validateName() {
  name = document.getElementById('profile-name').value;
  return (name.length > 0 && name.length <= 50);
}

function validateUsername() {
  username = document.getElementById('profile-username').value;
  return (username.length > 0 && username.length <= 20);
}

function validateEmail() {
  regex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  email = document.getElementById('profile-email').value;
  return (email.length > 0 && email.length <= 50 && email.match(regex));
}

function validatePassword() {
  password = document.getElementById('profile-password').value;
  return (password.length > 0 && password.length <= 50);
}

function validateConfirmPassword() {
  password = document.getElementById('profile-password').value;
  confirmpassword = document.getElementById('profile-confirm-password').value;
  return (confirmpassword.length > 0 && password === confirmpassword);
}

function validateAddress() {
  address = document.getElementById('profile-address').value;
  return (address.length > 0 && address.length <= 140);
}

function validatePhone() {
  regex = /^[+\-\*#0-9]{9,12}$/;
  phone = document.getElementById('profile-phone').value;
  return phone.match(regex);
}

function redName() {
  return redElement('profile-name', !validateName());
}

function redUsername() {
  return redElement('profile-username', !validateUsername());
}

function redEmail() {
  return redElement('profile-email', !validateEmail());
}

function redPassword() {
  return redElement('profile-password', !validatePassword());
}

function redConfirmPassword() {
  return redElement('profile-confirm-password', !validateConfirmPassword());
}

function redAddress() {
  return redElement('profile-address', !validateAddress());
}

function redPhone() {
  return redElement('profile-phone', !validatePhone());
}

document.getElementById('profile-name').onblur = redName;
document.getElementById('profile-username').onblur = function () {
  if (!redUsername())
    checkUnique('profile-username', 'username', 'usercheck');
  else
    showCheckmark('usercheck', 0);
};
document.getElementById('profile-email').onblur = function () {
  if (!redEmail())
    checkUnique('profile-email', 'email', 'emailcheck');
  else
    showCheckmark('emailcheck', 0);
};
document.getElementById('profile-password').onblur = function () {
  redPassword();
  if (document.getElementById('profile-confirm-password').value.length > 0)
    redConfirmPassword();
};
document.getElementById('profile-confirm-password').onblur = redConfirmPassword;
document.getElementById('profile-address').onblur = redAddress;
document.getElementById('profile-phone').onblur = redPhone;

document.getElementById('registerform').addEventListener("submit", function(event) {
  var invalid = [
    redName(), redUsername(), redEmail(), redPassword(), redConfirmPassword(),
    redAddress(), redPhone(), function () { for (var k in checkState) if (checkState[k] == -1) return true; return false; }()
  ];
  if (invalid.some(x => x))
    event.preventDefault();
});
