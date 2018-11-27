const mysql = require('mysql');
const config = require('./config.js'); // config file

const con = mysql.createConnection({
  host: config.host,
  user: config.user,
  password: config.password,
  database: config.database,
  port: config.port
});

con.connect(function(err) {
  if(err) throw err;
  console.log('Connected to database');
});

module.exports = con;
