function validateName() {
  name = document.getElementById('profile-name').value;
  return (name.length > 0 && name.length <= 50);
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

function validateCardNumber() {
  card_number = document.getElementById('profile-card-number').value;
  return (card_number.length > 0 && card_number.length <= 140);
}

function redElement(elementId, red) {
  var classList = document.getElementById(elementId).classList;
  if (red)
    classList.add('redborder');
  else
    classList.remove('redborder');
  return red;
}

function redName() {
  return redElement('profile-name', !validateName());
}

function redAddress() {
  return redElement('profile-address', !validateAddress());
}

function redPhone() {
  return redElement('profile-phone', !validatePhone());
}

function redCardNumber() {
  return redElement('profile-card-number', !validateCardNumber());
}

var checkState = {'cardnumbercheck':0};

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

function validateCard(inputId, requestKey, checkmarkId){
  input = document.getElementById(inputId).value;
  xhr = new XMLHttpRequest();
  obj = {};
  obj[requestKey] = input;
  content = JSON.stringify(obj);
  xhr.open('POST', 'http://localhost:8082/api/bank/customer');
  xhr.setRequestHeader('Content-Type', 'application/json;charset=UTF-8');
  xhr.onreadystatechange = function () {
    if(this.readyState == 4 || this.status == 200) {
      response = JSON.parse(this.responseText);
      console.log(this.responseText);
      console.log(checkState['cardnumbercheck']);
      if(response.message == 'Authentication successful') {
        showCheckmark('cardnumbercheck', 1);
      } else{
        showCheckmark('cardnumbercheck', -1);
      }
    }
  };
  xhr.send(content);
}


document.getElementById('profile-name').onblur = redName;
document.getElementById('profile-address').onblur = redAddress;
document.getElementById('profile-phone').onblur = redPhone;
document.getElementById('profile-card-number').onblur = function () {
  if (!redCardNumber()){
    validateCard('profile-card-number','cardNumber','cardnumbercheck');
  } else
    showCheckmark('cardnumbercheck', 0);
};

document.getElementById('updateform').addEventListener("submit", function(event) {
  var invalid = [
    redName(), redAddress(), redPhone(), redCardNumber(), function(){if (checkState['cardnumbercheck'] == -1) return true; return false; }()
  ];
  if (invalid.some(x => x))
    event.preventDefault();
});


document.getElementById('dp-file').onchange = function() {
  var str = this.value;
  var temp = new String(str).substring(str.lastIndexOf('/') + 1);
  var base = new String(temp).substring(temp.lastIndexOf('\\') + 1);
  document.getElementById('profile-picture').value = base;
}
