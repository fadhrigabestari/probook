function addPopUp() {
  document.getElementById('orderpopup').classList.remove('hiddencontent');
  document.getElementById('orderbackdrop').classList.remove('hiddencontent');
};
function removePopUp() {
  document.getElementById('orderpopup').classList.add('hiddencontent');
  document.getElementById('orderbackdrop').classList.add('hiddencontent');
};
function addErrPopUp() {
  document.getElementById('errorpopup').classList.remove('hiddencontent');
  document.getElementById('orderbackdrop').classList.remove('hiddencontent');
}
function removeErrPopUp() {
  document.getElementById('errorpopup').classList.add('hiddencontent');
  document.getElementById('orderbackdrop').classList.add('hiddencontent');
};
function addOrder(orderurl) {
  http = new XMLHttpRequest();
  http.open('POST', orderurl, true)

  // build SOAP request
  content =
  '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ser="http://services/">' +
    '<soapenv:Header/>' +
    '<soapenv:Body>' +
      '<ser:buyBook>' +
        '<arg0>' + idBook + '</arg0>' +
        '<arg1>' + quantity + '</arg1>' +
        '<arg2>' + senderCard + '</arg2>' +
      '</ser:buyBook>' +
    '</soapenv:Body>' +
  '</soapenv:Envelope>' +
  });
  
  http.onreadystatechange = function () {
    if(this.readyState == 4 && this.status == 200) {
      responsemsg = JSON.parse(this.responseText);
      document.getElementById('ntransactionmsg').innerHTML = "Nomor Transaksi : " + responsemsg['idTransaction'];
      addPopUp();
    } else if(this.status != 200) {
      addErrPopUp();
    }
  }

  http.setRequestHeader('Content-type', 'text/xml');
  http.send(content);
}
