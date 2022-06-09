<?php 
include ('koneksi.php'); 
	$covid = mysqli_query($koneksi,"select * from tb_covid"); 
	while ($row = mysqli_fetch_array($covid) ) {
		$nama_negara[] = $row['negara']; 

		$query = mysqli_query($koneksi,"select sum(kasus) as kasus from tb_covid where id_kasus='". $row['id_kasus']."'"); 
		$row = $query->fetch_array(); 
		$jumlah_kasus[] = $row['kasus']; 
	}
?> 

<!DOCTYPE html> 
<html> 
<head>
	<title>Membuat Grafik Menggunakan Chart JS</title>
	<script type="text/javascript" src="Chart.js"></script>
</head> 
<body>
	<div style="width: 800px; height: 800px">
		<canvas id="myChart"></canvas>
	</div> 

	<script> 
		var ctx = document.getElementById("myChart").getContext('2d'); 
		var myChart = new Chart (ctx, { 
			type: 'bar', 
			data: { 
				labels: <?php echo json_encode($nama_negara); ?>, 
				datasets: [{
					label: 'Grafik Kasus Covud', 
					data: <?php echo json_encode($jumlah_kasus);?>,

					backgroundcolor: 'rgba(255, 99, 132, 0.2)', 
					bordercolor: 'rgba(255, 99, 132, 1)', 
					borderWidth: 1 
				}]
			}, 
			options: { 
				scales: {
					YAxes: [{
						ticks : { 
							beginAtZero:true 
						}
					}]
				}
			} 
		});
	</script>
</body> 
</html> 
