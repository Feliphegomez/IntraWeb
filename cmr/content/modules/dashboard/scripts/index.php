<?php
	global $session, $site;

	$valPermission = $session->validatePermission('dashboard', 'view');
	
	if($valPermission == false){
		echo "No tienes permisos para realizar esta accion";
	}else{
		$LogsAuth = new LogsAuth(100);
		$listLogsAuth = $LogsAuth->list;
		$listLogsAuthChart = $LogsAuth->chartDays();
		
		
		?>
		
		<script src="<?php echo path_home; ?>js/demo/datatables-demo.js"></script>
		<!--<script src="<?php echo path_home; ?>js/demo/chart-area-demo.js"></script> -->
		<script>
		// Set new default font family and font color to mimic Bootstrap's default styling
		Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
		Chart.defaults.global.defaultFontColor = '#292b2c';

		// Area Chart Example
		var ctx = document.getElementById("myAreaChart");
		var myLineChart = new Chart(ctx, {
		  type: 'line',
		  data: {
			labels: <?php echo json_encode($listLogsAuthChart->fields); ?>,
			datasets: [{
			  label: " Total",
			  lineTension: 0.3,
			  backgroundColor: "rgba(2,117,216,0.2)",
			  borderColor: "rgba(2,117,216,1)",
			  pointRadius: 5,
			  pointBackgroundColor: "rgba(2,117,216,1)",
			  pointBorderColor: "rgba(255,255,255,0.8)",
			  pointHoverRadius: 5,
			  pointHoverBackgroundColor: "rgba(2,117,216,1)",
			  pointHitRadius: 50,
			  pointBorderWidth: 1,
			  data: <?php echo json_encode($listLogsAuthChart->datasets); ?>,
			}],
		  },
		  options: {
			scales: {
			  xAxes: [{
				time: {
				  unit: 'date'
				},
				gridLines: {
				  display: true
				},
				ticks: {
				  maxTicksLimit: 7
				}
			  }],
			  yAxes: [{
				ticks: {
				  min: 0,
				  max: 1000,
				  maxTicksLimit: 5
				},
				gridLines: {
				  color: "rgba(0, 0, 0, .125)",
				}
			  }],
			},
			legend: {
			  display: true
			}
		  }
		});

		</script>
		<script src="<?php echo path_home; ?>js/sb-admin.min.js"></script>
		<?php
	}
?>
