$(document).ready(function(){
	google.charts.load('current', {'packages':['corechart']});
	google.charts.setOnLoadCallback(drawChart);
	getLista();
	
	$("#frmBuscar").submit(function(){
		getLista();
	});
	
	function getLista(){
		$("#frmBuscar").find("[type=submit]").prop("disabled", true);
		drawChart();
	}
	
	function drawChart() {
		$.post("creportes", {
			"sucursal": $("#selSucursal").val(),
			"action": "getResumen"
		}, function( datos ){
			var array = new Array();
			
			array.push(["Nombre", "Total"]);
			$.each(datos.estados, function(i, estado){
				var el = new Array();
				
				el.push(estado.nombre);
				el.push(parseInt(estado.total));
				//el.push(parseInt(estado.idEstado));
				
				array.push(el);
 			});
 			try{
				data = google.visualization.arrayToDataTable(array);
			}catch(e){
				console.log(array);
			}
			
			var options = {
				title: "Estado de ODT's"
			};
			
			function selectHandler() {
				var selectedItem = chart.getSelection()[0];
				if (selectedItem) {
					var topping = data.getValue(selectedItem.row, 1);
					listaOrdenes(datos.estados[selectedItem.row].idEstado);
				}
			}
			
			var chart = new google.visualization.PieChart(document.getElementById('piechart'));
	        google.visualization.events.addListener(chart, 'select', selectHandler);    


			$("#frmBuscar").find("[type=submit]").prop("disabled", false);
			chart.draw(data, options);
		}, "json");
	}
	
	function listaOrdenes(estado){
		$("#listaOrdenes").html('<i class="fa fa-cog fa-spin fa-3x fa-fw"></i> Estamos actualizando la lista');
		$.post("listaOrdenesReportes", {
			"sucursal": $("#selSucursal").val(),
			"estado": estado
		}, function( datos ){
			$("#listaOrdenes").html(datos);
		});
	}
});