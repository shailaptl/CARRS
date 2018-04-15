$(function () {
	$(".NavigationBar").load("header.html");
});

function getTimeandDate() {
	getTime();
	getDate();
}

function getTime() {
	var d = new Date();
	var print = document.getElementById('time');
	print.innerHTML = "Time: " + d.toTimeString();
	setTimeout("getTime()", 1000);
}

function getDate() {
	var d = new Date();
	var print = document.getElementById('date');
	print.innerHTML = "Date: " + d.toLocaleDateString();
}

/*function drawMultSeries()
		{
			google.charts.load('current', {packages: ['corechart', 'bar']});
			google.charts.setOnLoadCallback(drawMultSeries);
			
			var totalResponse;
			var total_T1;
			var total_T1_Int = 0;

			var totalRequest = new XMLHttpRequest();
			totalRequest.open("get", "number_of_cars.php?", true);
			totalRequest.send();
			
			totalRequest.onreadystatechange = function()
			{
				if (this.readyState == 4 && this.status == 200)
				{
					totalResponse = this.responseText;
					total_T1 = totalResponse;
					total_T1_Int = parseInt(total_T1);

				var data = google.visualization.arrayToDataTable([
					['Light', 'Today',{ role: 'style' }],
					['T1 - Museum Rd/Reitz Union Dr', total_T1_Int, 'blue'],
					['T2 - Museum Rd/Gale Lemerand', 20, 'color: #FF8000'],
					['T3 - Museum Rd/Radio Rd', 110, 'blue'],
					['T4 - Museum Rd/Memorial Rd', 112, 'color: #FF8000']
				]);

				var options = {
					title: 'Traffic Light Statistics',
					chartArea: {width: '50%'},
					hAxis: {
						title: 'Number of Cars At Light',
						minValue: 0
					},
					vAxis: {
						title: 'Traffic Lights'
					}
				};

				var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
				chart.draw(data, options);
					}
				};
			
		}
		*/