$(document).ready(function () {
	var param = $('#hdid').val();
	var dataLine, dataSpeed, dataTimbang, dataRadar;
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
					
					//kecepatan
					$('#lblPankerScore').text(data.speed);
					$('#lblPankerPP').text(data.speedPP);
					$('#lblPankerCat').text(data.speedCat);
					
					//ketelitian
					$('#lblJankerScore').text(data.janker);
					$('#lblJankerPP').text(data.jankerPP);
					$('#lblJankerCat').text(data.jankerCat);
					
					//keajekan
					$('#lblTinkerScore').text(data.tinker);
					$('#lblTinkerPP').text(data.tinkerPP);
					$('#lblTinkerCat').text(data.tinkerCat);

					$('#lblTotalScore').text(data.total);
					$('#lblSSScore').text(data.ss);
					$('#lblKesalahanScore').text(data.salah);
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

	var ctxRadar = document.getElementById("canvas_radar").getContext("2d");
	window.myRadar = new Chart(ctxRadar).Radar(radarChartData, {
		responsive: true,
		scaleBeginAtZero : true,
		scaleShowLabels : false,
		scaleLineColor: "rgba(0,0,0,.3)",
		tooltipFillColor: "rgba(51, 51, 51, 0.55)",
		showTooltips : false
		
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
	var labelDISC = [' ', ' ', ' ', ' '];
	
	var lineChartDataDISC1 = {
		labels: labelDISC,
		datasets: [
			{
				label: "My Second dataset",
				fillColor : "#fff", //rgba(151,187,205,0.2)
				strokeColor: "rgba(3, 88, 106, 0.70)", //rgba(151,187,205,1
				pointStrokeColor: "#fff",
				pointColor: "#fff",
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
		
		var ctxDisc1 = document.getElementById("canvasDISC1").getContext("2d");
		new Chart(ctxDisc1).Line(lineChartDataDISC1, {
			responsive: true,
			showTooltips: false,
			bezierCurve : false,
			datasetFill : false,
			scaleFontColor: "#fff",
			showScale: true,
			scaleOverride: true, scaleStartValue: 0, scaleStepWidth: 1, scaleSteps: 45,
			tooltipFillColor: "rgba(51, 51, 51, 0.55)"
			// ,
			 // onAnimationComplete:function(){
				// var tcanvas=document.createElement('canvas');
				// var tctx=tcanvas.getContext('2d');
				// tcanvas.width=270;
				// tcanvas.height=440;
				// // tctx.fillStyle='white';
				// // tctx.fillRect(0,0,tcanvas.width,tcanvas.height);
				// var bgimg = new Image();
				// bgimg.src = "images/bg-disc-1.jpg";
				// tctx.drawImage(bgimg,0,0);
				// tctx.drawImage(canvasDisc1,0,0);
				// var img=new Image();
				// img.src=tcanvas.toDataURL();
				// img.onload=function(){
				  // document.body.appendChild(img);
				// }
			  // }
		});
	var lineChartDataDISC2 = {
		labels: labelDISC,
		datasets: [
			{
				label: "My Second dataset",
				fillColor : "#fff", //rgba(151,187,205,0.2)
				strokeColor: "rgba(3, 88, 106, 0.70)", //rgba(151,187,205,1
				pointStrokeColor: "#fff",
				pointColor: "#fff",
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
		var ctxDisc2 = document.getElementById("canvasDISC2").getContext("2d");
		// var canvasDisc2 = document.getElementById("canvasDISC2");
		new Chart(ctxDisc2).Line(lineChartDataDISC2, {
			responsive: true,
			showTooltips: false,
			bezierCurve : false,
			datasetFill : false,
			scaleFontColor: "#fff",
			showScale: true,
			scaleOverride: true, scaleStartValue: 0, scaleStepWidth: 1, scaleSteps: 45,
			tooltipFillColor: "rgba(51, 51, 51, 0.55)"
			// ,
			 // onAnimationComplete:function(){
				// var tcanvas=document.createElement('canvas');
				// var tctx=tcanvas.getContext('2d');
				// tcanvas.width=270;
				// tcanvas.height=440;
				// // tctx.fillStyle='white';
				// // tctx.fillRect(0,0,tcanvas.width,tcanvas.height);
				// var bgimg = new Image();
				// bgimg.src = "images/bg-disc-2.jpg";
				// tctx.drawImage(bgimg,0,0);
				// tctx.drawImage(canvasDisc2,0,0);
				// var img=new Image();
				// img.src=tcanvas.toDataURL();
				// img.onload=function(){
				  // document.body.appendChild(img);
				// }
			  // }
		});
	var lineChartDataDISC3 = {
		labels: labelDISC,
		datasets: [
			{
				label: "My Second dataset",
				fillColor : "#fff", //rgba(151,187,205,0.2)
				strokeColor: "rgba(3, 88, 106, 0.70)", //rgba(151,187,205,1
				pointStrokeColor: "#fff",
				pointColor: "#fff",
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
		var ctxDisc3 = document.getElementById("canvasDISC3").getContext("2d");
		// var canvasDisc3 = document.getElementById("canvasDISC3");
		new Chart(ctxDisc3).Line(lineChartDataDISC3, {
			responsive: true,
			showTooltips: false,
			bezierCurve : false,
			datasetFill : false,
			scaleFontColor: "#fff",
			showScale: true,
			scaleOverride: true, scaleStartValue: 0, scaleStepWidth: 1, scaleSteps: 45,
			tooltipFillColor: "rgba(51, 51, 51, 0.55)"
			// ,
			 // onAnimationComplete:function(){
				// var tcanvas=document.createElement('canvas');
				// var tctx=tcanvas.getContext('2d');
				// tcanvas.width=270;
				// tcanvas.height=440;
				// // tctx.fillStyle='white';
				// // tctx.fillRect(0,0,tcanvas.width,tcanvas.height);
				// var bgimg = new Image();
				// bgimg.src = "images/bg-disc-3.jpg";
				// tctx.drawImage(bgimg,0,0);
				// tctx.drawImage(canvasDisc3,0,0);
				// var img=new Image();
				// img.src=tcanvas.toDataURL();
				// img.onload=function(){
				  // document.body.appendChild(img);
				// }
			  // }
		});
});

function localJsPrintReport(id)
{	
	// kraeplin
	canvas = document.getElementById("canvas000");
	var tcanvaskr=document.createElement('canvas');
	var tctxkr=tcanvaskr.getContext('2d');
	tcanvaskr.width=350;
	tcanvaskr.height=175;
	tctxkr.drawImage(canvas,0,0,350,175);
	var dataurl1 = tcanvaskr.toDataURL("image/png");
	// window.location.href=dataurl1; return false;
	
	// papi
	var ctxRadar = document.getElementById("canvas_radar").getContext("2d");
	var canvasRadar = document.getElementById("canvas_radar");
	var tcanvasrad=document.createElement('canvas');
	var tctxrad=tcanvasrad.getContext('2d');
	tcanvasrad.width=300;
	tcanvasrad.height=300;
	var bgimgrad = new Image();
	bgimgrad.src = "images/bg-papi.jpg";
	tctxrad.drawImage(bgimgrad,0,0,300,300);
	tctxrad.drawImage(canvasRadar,-89,30,480,240);
	var dataurl2=tcanvasrad.toDataURL();
	// window.location = dataurl2; return false;
	
	// disc1
	var canvasDisc1 = document.getElementById("canvasDISC1");
	var tcanvasd1=document.createElement('canvas');
	var tctxd1=tcanvasd1.getContext('2d');
	tcanvasd1.width=166;
	tcanvasd1.height=270;
	var bgimgd1 = new Image();
	bgimgd1.src = "images/bg-disc-1.jpg";
	tctxd1.drawImage(bgimgd1,0,0,166,270);
	tctxd1.drawImage(canvasDisc1,0,0,166,270);
	var dataurl3=tcanvasd1.toDataURL();
	 // window.location = dataurl3;  return false;
	
	// disc2
	var canvasDisc2 = document.getElementById("canvasDISC2");
	var tcanvasd2=document.createElement('canvas');
	var tctxd2=tcanvasd2.getContext('2d');
	tcanvasd2.width=166;
	tcanvasd2.height=270;
	var bgimgd2 = new Image();
	bgimgd2.src = "images/bg-disc-2.jpg";
	tctxd2.drawImage(bgimgd2,0,0,166,270);
	tctxd2.drawImage(canvasDisc2,0,0,166,270);
	var dataurl4=tcanvasd2.toDataURL();
	
	// disc3
	var canvasDisc3 = document.getElementById("canvasDISC3");
	var tcanvasd3=document.createElement('canvas');
	var tctxd3=tcanvasd3.getContext('2d');
	tcanvasd3.width=166;
	tcanvasd3.height=270;
	var bgimgd3 = new Image();
	bgimgd3.src = "images/bg-disc-3.jpg";
	tctxd3.drawImage(bgimgd3,0,0,166,270);
	tctxd3.drawImage(canvasDisc3,0,0,166,270);
	var dataurl5=tcanvasd3.toDataURL();
	
	var params = {
	  imgkr:	dataurl1,
	  imgrd:	dataurl2,
	  imgd1:	dataurl3,
	  imgd2:	dataurl4,
	  imgd3:	dataurl5
	}
	var json = JSON.stringify(params);
	var mapForm = document.createElement("form");
    mapForm.target = "Map";
    mapForm.method = "POST"; // or "post" if appropriate
    mapForm.action = "ajax/chartjs.php?po=localAjPrintReport&id="+id;
	var imglink;
	// for (var i = 0; i < keyParams.length; i++){
            var mapInput = document.createElement("input");
            mapInput.setAttribute("type", "hidden");
            mapInput.setAttribute("name", 'img');
            mapInput.setAttribute("value", json);

            mapForm.appendChild(mapInput);
    // }
	
    document.body.appendChild(mapForm);

    map = window.open("", "Map", '_blank', 'toolbar=yes, scrollbars=yes, resizable=yes, top=50, left=50, width=1000, height=600');

	if (map) {
		mapForm.submit();
	} else {
		alert('You must allow popups for this map to work.');
	}
}

function post(path, params, method) {
    method = method || "post"; // Set method to post by default if not specified.

    // The rest of this code assumes you are not using a library.
    // It can be made less wordy if you use one.
    var form = document.createElement("form");
    form.setAttribute("method", method);
    form.setAttribute("action", path);

    for(var key in params) {
        if(params.hasOwnProperty(key)) {
            var hiddenField = document.createElement("input");
            hiddenField.setAttribute("type", "hidden");
            hiddenField.setAttribute("name", key);
            hiddenField.setAttribute("value", params[key]);

            form.appendChild(hiddenField);
         }
    }

    document.body.appendChild(form);
    form.submit();
}

function convertCanvasToImage(canvas) {
	canvas = document.getElementById("canvas000");
	// var image = new Image();
	var dataurl = canvas.toDataURL("image/png");
	window.location = dataurl;
}

	
