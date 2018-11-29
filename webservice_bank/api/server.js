// ======================================
// needed packages
// ======================================
const express = require('express');
const app = express();
const bodyParser = require('body-parser');

// ======================================
// configurations
// ======================================
app.use((req,res,next) => {
	res.set("Access-Control-Allow-Origin", "*");
	res.header(
		"Access-Control-Allow-Headers",
		"Origin, X-Requested-With, Content-Type, Accept, Authorization");
	// if (req.method === 'OPTIONS'){
	// 	res.header('Access-Control-Allow-Methods', 'PUT,POST,PATCH,DELETE,GET');
	// 	return res.status(200).json({});
	// }
	next();
});

const port = 8081;
const routes = require('./routes/bankRoutes');
app.use(bodyParser.json());
app.use(bodyParser.urlencoded({extended: true}));
routes(app);

// ======================================
// listen
// ======================================
app.listen(port);
console.log('Bank server is listening to : ' + port);
