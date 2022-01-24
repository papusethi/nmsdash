<?php include "includes/db_con.php"; ?>

<?php
$block_name = "";
if (isset($_GET['block_name'])) {
	$block_name = $_GET['block_name'];
}


$x_tanggal  = mysqli_query($connection, 'SELECT date_time FROM ( SELECT * FROM temp_noise_data ORDER BY id DESC LIMIT 24) Var1 ORDER BY ID ASC');

$y_ppur   = mysqli_query($connection, "SELECT value FROM ( SELECT * FROM temp_noise_data WHERE block_name = '$block_name' ORDER BY id DESC LIMIT 24) Var1 ORDER BY ID ASC");

?>

<!-- for line graph -->
<div class="card">
	<div class="card-body">
		<canvas id="myLiveChart"></canvas>
	</div>
</div>

<script>
	var mydata = {
		labels: [
			<?php while ($b = mysqli_fetch_array($x_tanggal)) {
				echo '"' . $b['date_time'] . '",';
			} ?>
		],
		datasets: [{
			label: "<?php echo $block_name; ?>",
			backgroundColor: "rgba(192, 96, 20,1)",
			borderColor: 'rgba(192, 96, 20,0.4)',
			data: [<?php while ($b = mysqli_fetch_array($y_ppur)) {
						echo  $b['value'] . ',';
					} ?>],
		}]
	};

	var config = {
		type: 'line',
		data: mydata,
		options: {
			animation: {
				duration: 0
			}
		}
	};

	var myLiveChart = new Chart(
		document.getElementById('myLiveChart'),
		config
	);
</script>