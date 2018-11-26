const mysql = require('mysql');
const config = require('./config.js'); // config file

const con = mysql.createConnection({
  host: config.host,
  user: config.user,
  password: config.password,
  database: config.database,
  port: config.port
});

module.exports = con;
