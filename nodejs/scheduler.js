var cron = require('node-cron');
var request = require('request');
var os = require("os");
var url = 'http://'+os.hostname()+'/athena/scheduler/save_hourly_demand/cresting';

cron.schedule('0 0 */1 * * *', () => {
	request(url, function (error, response, body) {
		if (!error && response.statusCode == 200) {
 			console.log('success');
 		}
 	});
},{
	timezone: "America/Chicago"
});