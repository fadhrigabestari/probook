const connection = require('../database');

exports.newCustomer = function(req, res) {
    const reqCard = req.body.cardNumber;
    const mysqlQuery = 'select idCustomer from customers where cardNumber = ?';

    connection.query(mysqlQuery, reqCard, function(errdb, resdb) {
      if(errdb) {
        res.status(401).json({message: 'Authentication failed'});
        return;
      }

      if(resdb.length === 0) {
        res.status(401).json({message: 'Authentication failed, card number is invalid'});
        return;
      }
      res.status(200).json({message: 'Authentication successful'});
  })
};

exports.transfer = async function(req, res) {
  const senderCard = req.body.senderCard;
  const receiverCard = req.body.receiverCard;
  const amount = req.body.amount;

  const cardQuery = 'select idCustomer from customers where cardNumber = ?';
  const balanceQuery = 'select balance from customers where cardNumber = ?';
  const subtractQuery = 'update customers set balance = balance - ? where cardNumber = ?';
  const addQuery = 'update customers set balance = balance + ? where cardNumber = ?';

  connection.query(cardQuery, senderCard, function(errdb, resdb) {
    if(errdb) {
      res.status(400).json({message: 'Transfer failed'});
      return;
    }

    if(resdb.length === 0) {
      res.status(404).json({message: 'Transfer failed, sender card number is invalid'});
      return;
    }

    connection.query(cardQuery, receiverCard, function(errdb, resdb) {
      if(errdb) {
        res.status(400).json({message: 'Transfer failed'});
        return;
      }

      if(resdb.length === 0) {
        res.status(404).json({message: 'Transfer failed, receiver card number is invalid'});
        return;
      }

      connection.query(balanceQuery, senderCard, function(errdb, resdb) {
        if(errdb) {
          res.status(400).json({message: 'Transfer failed'});
          return;
        }

        if(resdb.balance < amount) {
          res.status(400).json({message: 'Transfer failed, insufficient balance'});
          return;
        }

        connection.query(subtractQuery, [amount, senderCard], function(errdb, resdb) {
          if(errdb) {
            res.status(400).json({message: 'Transfer failed'});
            return;
          }

          connection.query(addQuery, [amount, receiverCard], function(errdb, resdb) {
            if(errdb) {
              res.status(400).json({message: 'Transfer failed'});
              return;
            }

            res.status(200).json({message: 'Transfer successful'});
          });
        });
      });
    });
  });
}
