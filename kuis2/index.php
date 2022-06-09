<?php 
include ('koneksi.php'); 
	$produk = mysqli_query($koneksi,"select * from tb_barang"); 
	while ($row = mysqli_fetch_array($produk) ) {
		$nama_produk[] = $row['barang']; 

		$query = mysqli_query($koneksi,"select sum(jumlah) as jumlah from tb_penjualan where id_barang='". $row['id_barang']."'"); 
		$row = $query->fetch_array(); 
		$jumlah_produk[] = $row['jumlah']; 
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
				labels: <?php echo json_encode($nama_produk); ?>, 
				datasets: [{
					label: 'Grafik Penjualan', 
					data: <?php echo json_encode($jumlah_produk);?>,

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
