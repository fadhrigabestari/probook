module.exports = function(app) {
  const bank = require('../controllers/bankControllers');

  // bank routes
  // app.route('/api/bank/customer')
  //   .get(bank.newCustomer);
  app.route('/api/bank/customer/')
    .post(bank.newCustomer);

  app.route('/api/bank/transfer')
    .post(bank.transfer);
};
