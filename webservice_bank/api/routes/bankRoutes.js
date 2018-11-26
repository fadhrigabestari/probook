module.exports = function(app) {
  const bank = require('../controllers/bankControllers');

  // bank routes
  app.route('/api/bank/customers')
    .get(bank.getAllCustomers);

  app.route('/api/bank/transfers')
    .get(bank.getAllTransfers);

  app.route('/api/bank/customer')
    .get(bank.getCustomer)
    .post(bank.newCustomer);

  app.route('/api/bank/transfer')
    .get(bank.getTransfer)
    .post(bank.newTransfer);
};
