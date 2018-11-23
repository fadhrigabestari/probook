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
  content = JSON.stringify({
    'idBook': document.getElementById("idBook").value,
    'quantity': document.getElementById("norder").value
  });
  http.open('POST', orderurl)
  http.setRequestHeader('Content-type', 'application/json;charset=UTF-8');
  http.onreadystatechange = function () {
    if(this.readyState == 4 && this.status == 200) {
      responsemsg = JSON.parse(this.responseText);
      document.getElementById('ntransactionmsg').innerHTML = "Nomor Transaksi : " + responsemsg['idTransaction'];
      addPopUp();
    } else if(this.status != 200) {
      addErrPopUp();
    }
  }
  http.send(content);
}
