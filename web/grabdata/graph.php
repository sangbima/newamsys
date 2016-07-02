<!DOCTYPE html>
<html>
	<head>
		<title>chart created with amCharts | amCharts</title>
		<meta name="description" content="chart created using amCharts live editor" />

		<!-- amCharts javascript sources -->
		<script src="http://www.amcharts.com/lib/3/amcharts.js" type="text/javascript"></script>
		<script src="http://www.amcharts.com/lib/3/serial.js" type="text/javascript"></script>
		<?php

		$connect = mysqli_connect("202.149.74.163","devbawang","MataMerah1945");
		$select_db = mysqli_select_db($connect, 'amsys');

		$pilihData = "SELECT * FROM info_harga WHERE  tanggal BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE() group by tanggal";
		$eksData = mysqli_query($connect,$pilihData);

		echo '
		<!-- amCharts javascript code -->
		<script type="text/javascript">
			AmCharts.makeChart("chartdiv",
				{
					"type": "serial",
					"categoryField": "date",
					"dataDateFormat": "YYYY-MM-DD",
					"categoryAxis": {
						"parseDates": true
					},
					"chartCursor": {
						"enabled": true
					},
					"chartScrollbar": {
						"enabled": true
					},
					"trendLines": [],
					"graphs": [
						{
							"fillAlphas": 0.7,
							"id": "AmGraph-1",
							"lineAlpha": 0,
							"title": "graph 1",
							"valueField": "column-1"
						},
						
					],
					"guides": [],
					"valueAxes": [
						{
							"id": "ValueAxis-1",
							"title": "Harga dalam Rupiah"
						}
					],
					"allLabels": [],
					"balloon": {},
					"legend": {
						"enabled": true
					},
					"titles": [
						{
							"id": "Title-1",
							"size": 15,
							"text": "Data Harga Bawang dari Januari s/d April 2016"
						}
					],
					"dataProvider": [';
					while($dataHarga=mysqli_fetch_assoc($eksData)){
						echo '{
							"date": "'.$dataHarga['tanggal'].'",
							"column-1": '.$dataHarga['harga_kg'].',
							
						},';
					}
					echo '	
					]
				}
			);
		</script>';
		
		?>

	</head>
	<body>
		<div id="chartdiv" style="width: 100%; height: 400px; background-color: #FFFFFF;" ></div>
	</body>
</html>