// ======================================
// needed packages
// ======================================
const express = require('express');
const app = express();

// ======================================
// configurations
// ======================================
const port = 8082;
const routes = require('./routes/bankRoutes');
routes(app);

// ======================================
// listen
// ======================================
app.listen(port);
console.log('Bank server is listening to : ' + port);
