// ======================================
// needed packages
// ======================================
const express = require('express');
const app = express();
const bodyParser = require('body-parser');

// ======================================
// configurations
// ======================================
const port = 8082;
const routes = require('./routes/bankRoutes');
app.use(bodyParser.json());
app.use(bodyParser.urlencoded({extended: true}));
routes(app);

// ======================================
// listen
// ======================================
app.listen(port);
console.log('Bank server is listening to : ' + port);
