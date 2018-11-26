const connection = require('../database');

validateCardNumber = function(reqCard) {
  const mysqlQuery = 'select idCustomer from customers where cardNumber = "${reqCard}"'

  connection.query(mysqlQuery, function(errdb, resdb) {
    if(errdb) {
      return false;
    }

    if(resdb.length === 0) {
      return false;
    }

    return true;
  })
};

validateBalance = function(reqCard, amount) {
  const mysqlQuery = 'select balance from customers where cardNumber = "${reqCard}"'

  connection.query(mysqlQuery, function(errdb, resdb) {
    if(errdb) {
      return false;
    }

    if(resdb.balance < amount) {
      return false;
    }

    return true;
  })
};

exports.newCustomer = function(req, res) {
  const reqCard = req.body.cardNumber;

  if(!validateCardNumber(reqCard)) {
    res.status(401).json({message: 'Authentication failed, card number is invalid'});
    return;
  }

  res.status(200).json({message: 'Authentication successful'});
};

exports.transfer = function(req, res) {
  const senderCard = req.body.senderCardNumber;
  const receiverCard = req.body.receiverCardNumber;
  const amount = req.body.amount;

  if(!validateCardNumber(senderCard) || !validateCardNumber(receiverCard)) {
    res.status(401).json({message: 'Transfer failed, card number is invalid'});
    return;
  }

  if(!validateBalance(senderCard, amount)) {
    res.status(401).json({message: 'Transfer failed, insufficient balance'});
    return;
  }

  res.status(200).json({message: 'Transfer successful'})
}
