<script>
window.onload = function () {
var chart = new CanvasJS.Chart("chartContainer",
	{
		animationEnabled: true, 
		animationDuration: 2000,   //change to 1000, 500 etc
		title:{
			text: ""
		},
		data: [
		{
			type: "pie",
			showInLegend: "true",
			legendText: "{label} - {y}%",
			indexLabel: "{y}%",
			indexLabelPlacement: "inside",
			dataPoints: [
					<?php foreach($newarray as $index=>$order):?>
						{ y: <?php echo number_format((float)(($order * 100 )/ $total_qty),'2','.','')?>, label: '<?php echo $array_name[$index];?>' },
					<?php endforeach;?>
				]
			}
		]
	});
	chart.render();
$(".canvasjs-chart-credit").remove();
}

</script>
<script src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>