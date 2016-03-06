$(document).ready(function () {
	var param = $('#hdid').val();
	var dataLine, dataSpeed, dataRadar;
	$.ajax({
		url: "ajax/chartjs.php",
			type: "GET",
			data: 'userid='+param+'&po=getLineChart',
			dataType: 'json',
			cache: false,
			async:false,
			success: function(data)
			{
				if(data)
				{
					dataLine = data.cell;
					dataTimbang = data.timbang;
					
					$('#lblPankerScore').text(data.speed);
					$('#lblPankerPP').text(data.speedPP);
					$('#lblPankerCat').text(data.speedCat);
					
					$('#lblJankerScore').text(data.janker);
					$('#lblJankerPP').text(data.jankerPP);
					$('#lblJankerCat').text(data.jankerCat);
					
					$('#lblTinkerScore').text(data.tinker);
					$('#lblTinkerPP').text(data.tinkerPP);
					$('#lblTinkerCat').text(data.tinkerCat);
					// console.log(data);
				}
			}
		});
	var l = new Array();
	for(i=1; i<=45; i++)
	{
		l.push(''+i+'');
	}
	var timbang = new Array();
	for(j=1; j<=45; j++)
	{
		timbang.push(dataTimbang);
	}
	
	var lineChartData = {
		labels: l,
		datasets: [
		{
				label: "My Second dataset",
				fillColor : "#fff", //rgba(151,187,205,0.2)
				strokeColor: "rgba(3, 88, 106, 0.70)", //rgba(151,187,205,1
				pointStrokeColor: "#fff",
				data: timbang
		},
			{
				label: "My Second dataset",
				fillColor: "rgba(3, 88, 106, 0.3)", //rgba(151,187,205,0.2)
				strokeColor: "rgba(3, 88, 106, 0.70)", //rgba(151,187,205,1)
				pointColor: "rgba(3, 88, 106, 0.70)", //rgba(151,187,205,1)
				pointStrokeColor: "#fff",
				pointHighlightFill: "#fff",
				pointHighlightStroke: "rgba(151,187,205,1)",
				data: dataLine
		}
	]
	}

		new Chart(document.getElementById("canvas000").getContext("2d")).Line(lineChartData, {
			responsive: true,
				showTooltips: false,
				bezierCurve : false,
			// showScale: true,
			tooltipFillColor: "rgba(51, 51, 51, 0.55)"
		});
	

	
	$.ajax({
		url: "ajax/chartjs.php",
			type: "GET",
			data: 'userid='+param+'&po=getRadarChart',
			dataType: 'json',
			cache: false,
			async:false,
			success: function(data)
			{
				if(data)
				{
					dataRadar = data.cell;
				}
			}
		});

	$.ajax({
		url: "ajax/chartjs.php",
			type: "GET",
			data: 'userid='+param+'&po=getWPT',
			dataType: 'json',
			cache: false,
			async:false,
			success: function(data)
			{
				if(data)
				{
					$('#lblWptSkor').text(data.wptSkor);
					$('#lblWptIQ').text(data.wptIQ);
					$('#lblWptClass').text(data.wptClass);
				}
			}
		});
		
	var radarChartData = {
		/* labels: ["need to finish a task", 
				"role of hand intense worker", 
				"need to achieve", 
				"leadership role", 
				"need to control others", 
				"easy in decision making", 
				"pace", 
				"vigorous type", 
				"need to be noticed", 
				"social extension", 
				"need to belong to groups", 
				"need for closeness and affection", 
				"theoretical type", 
				"interest in working with details", 
				"organized type", 
				"need for change", 
				"emotional restrain", 
				"need to be forcefull", 
				"need to support authority", 
				"need for rules and supervision"], */
			labels: ["", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", ""],
		datasets: [
			{
				label: "My Second dataset",
				fillColor: "rgba(38, 185, 154, 0.2)",
				strokeColor: "rgba(38, 185, 154, 0.85)",
				pointColor: "rgba(38, 185, 154, 0.85)",
				pointStrokeColor: "#fff",
				pointHighlightFill: "#fff",
				pointHighlightStroke: "rgba(151,187,205,1)",
				data: dataRadar
		}
	]
	};

	
	window.myRadar = new Chart(document.getElementById("canvas_radar").getContext("2d")).Radar(radarChartData, {
		responsive: true,
		scaleBeginAtZero : true,
		scaleShowLabels : false,
		scaleLineColor: "rgba(0,0,0,.3)",
		tooltipFillColor: "rgba(51, 51, 51, 0.55)"
		
	});


	var dataLineDISC1, dataLineDISC2, dataLineDISC3;
	$.ajax({
		url: "ajax/chartjs.php",
			type: "GET",
			data: 'userid='+param+'&po=getLineDISC',
			dataType: 'json',
			cache: false,
			async:false,
			success: function(data)
			{
				if(data)
				{
					dataLineDISC1 = data.graph1;
					dataLineDISC2 = data.graph2;
					dataLineDISC3 = data.graph3;
					console.log(data);
				}
			}
		});
	var labelDISC = ['D', 'I', 'S', 'C'];
	
	var lineChartDataDISC1 = {
		labels: labelDISC,
		datasets: [
			{
				label: "My Second dataset",
				fillColor : "#fff", //rgba(151,187,205,0.2)
				strokeColor: "rgba(3, 88, 106, 0.70)", //rgba(151,187,205,1
				pointStrokeColor: "#fff",
				data: [45]
		},
		{
				label: "My Second dataset",
				fillColor: "#fff", //rgba(151,187,205,0.2)
				strokeColor: "rgba(3, 88, 106, 0.70)", //rgba(151,187,205,1)
				pointColor: "rgba(3, 88, 106, 0.70)", //rgba(151,187,205,1)
				pointStrokeColor: "#fff",
				pointHighlightFill: "#fff",
				pointHighlightStroke: "rgba(151,187,205,1)",
				data: dataLineDISC1
		}
	]
	}

		new Chart(document.getElementById("canvasDISC1").getContext("2d")).Line(lineChartDataDISC1, {
			responsive: true,
				showTooltips: false,
				bezierCurve : false,
			showScale: false,
			scaleOverride: true, scaleStartValue: 0, scaleStepWidth: 1, scaleSteps: 45,
			tooltipFillColor: "rgba(51, 51, 51, 0.55)"
		});
	var lineChartDataDISC2 = {
		labels: labelDISC,
		datasets: [
			{
				label: "My Second dataset",
				fillColor : "#fff", //rgba(151,187,205,0.2)
				strokeColor: "rgba(3, 88, 106, 0.70)", //rgba(151,187,205,1
				pointStrokeColor: "#fff",
				data: [45]
		},
		{
				label: "My Second dataset",
				fillColor: "#fff", //rgba(151,187,205,0.2)
				strokeColor: "rgba(3, 88, 106, 0.70)", //rgba(151,187,205,1)
				pointColor: "rgba(3, 88, 106, 0.70)", //rgba(151,187,205,1)
				pointStrokeColor: "#fff",
				pointHighlightFill: "#fff",
				pointHighlightStroke: "rgba(151,187,205,1)",
				data: dataLineDISC2
		}
	]
	}

		new Chart(document.getElementById("canvasDISC2").getContext("2d")).Line(lineChartDataDISC2, {
			responsive: true,
				showTooltips: false,
				bezierCurve : false,
			showScale: false,
			scaleOverride: true, scaleStartValue: 0, scaleStepWidth: 1, scaleSteps: 45,
			tooltipFillColor: "rgba(51, 51, 51, 0.55)"
		});
	var lineChartDataDISC3 = {
		labels: labelDISC,
		datasets: [
			{
				label: "My Second dataset",
				fillColor : "#fff", //rgba(151,187,205,0.2)
				strokeColor: "rgba(3, 88, 106, 0.70)", //rgba(151,187,205,1
				pointStrokeColor: "#fff",
				data: [45]
		},
		{
				label: "My Second dataset",
				fillColor: "#fff", //rgba(151,187,205,0.2)
				strokeColor: "rgba(3, 88, 106, 0.70)", //rgba(151,187,205,1)
				pointColor: "rgba(3, 88, 106, 0.70)", //rgba(151,187,205,1)
				pointStrokeColor: "#fff",
				pointHighlightFill: "#fff",
				pointHighlightStroke: "rgba(151,187,205,1)",
				data: dataLineDISC3
		}
	]
	}

		new Chart(document.getElementById("canvasDISC3").getContext("2d")).Line(lineChartDataDISC3, {
			responsive: true,
				showTooltips: false,
				bezierCurve : false,
			showScale: false,
			scaleOverride: true, scaleStartValue: 0, scaleStepWidth: 1, scaleSteps: 45,
			tooltipFillColor: "rgba(51, 51, 51, 0.55)"
		});
});

	

	
