var cron = require('node-cron');
var request = require('request');
var os = require("os");
var cresting_url = 'http://'+os.hostname()+'/athena/scheduler/save_hourly_demand/cresting';
var moda_url = 'http://'+os.hostname()+'/athena/scheduler/save_hourly_demand/moda';
var modb_url = 'http://'+os.hostname()+'/athena/scheduler/save_hourly_demand/modb';

cron.schedule('0 0 */1 * * *', () => {
	console.log('--Call Updates--');
	request(cresting_url, function (error, response, body) {
		if (!error && response.statusCode == 200) {
 			console.log('Cresting Update success');
 		}
 	});

 	request(moda_url, function (error, response, body) {
		if (!error && response.statusCode == 200) {
 			console.log('MOD-A Update success');
 		}
 	});

 	request(modb_url, function (error, response, body) {
		if (!error && response.statusCode == 200) {
 			console.log('MOD-B Update success');
 		}
 	});
},{
	timezone: "America/Chicago"
});