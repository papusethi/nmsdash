<?php include "includes/db_con.php"; ?>
<?php include "functions.php"; ?>

<?php

$district_array = array();
$num_of_dist = 0;
$district_avg_value_array = array();

$query = "SELECT DISTINCT district_name FROM noise_value";
$result = mysqli_query($connection, $query);
if ($result == true) {
    while ($row = mysqli_fetch_assoc($result)) {
        $district_array[] = $row['district_name'];
        $num_of_dist++;
    }
}

for ($i = 0; $i < $num_of_dist; $i++) {
    $sum = 0;
    $no_of_records = 0;
    $q = "SELECT * FROM noise_value WHERE district_name = '$district_array[$i]'";
    $r = mysqli_query($connection, $q);

    if ($r == true) {
        while ($row = mysqli_fetch_assoc($r)) {
            $sum += $row['average'];
            $no_of_records++;
        }
    }
    $district_avg_value_array[] = $sum / $no_of_records;
}

// below code for the overview default value
$query = "SELECT * FROM noise_value WHERE district_name = 'Ganjam'";
$result = mysqli_query($connection, $query);

$day_value = 0.0;
$night_value = 0.0;
$avg_value = 0.0;

if ($result->num_rows > 0) {
    $no_of_records = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        $day_value += $row['day_value'];
        $night_value += $row['night_value'];
        $avg_value += $row['average'];
        $no_of_records++;
    }
    $day_value = round($day_value / $no_of_records, 2);
    $night_value = round($night_value / $no_of_records, 2);
    $avg_value = round($avg_value / $no_of_records, 2);
} else {
    echo "<h3>NA</h3>";
}

header("refresh:60");


?>

<!-- Navigation Header -->
<?php include "includes/header.php"; ?>

<!-- Start of main content -->
<div class="home-content">

    <!-- Start Short District Overview -->
    <div>
        <form action="" method="post">
            <span class="text-border-left">Noise Overview | </span>
            <label for="" class="d-inline">Select a District</label>
            <select name="district" id="district" class="d-inline" onchange="showDist(this.value); showDayValue(this.value);showNightValue(this.value);showAvgValue(this.value);" required>
                <option value="Ganjam">Ganjam</option>
                <?php getDistrictInOptionForm(); ?>
            </select>
        </form>

    </div>

    <div class="row p-3">
        <div class="col m-1 mycard">
            <small>Showing Results of</small>
            <h3 id="ov_dist">Ganjam</h3>
        </div>
        <div class="col m-1 mycard">
            <small>Noise at Daytime</small>
            <h3 id="ov_day"><?php echo $day_value; ?> <small>dB</small></h3>
        </div>
        <div class="col m-1 mycard">
            <small>Noise at Night</small>
            <h3 id="ov_night"><?php echo $night_value; ?> <small>dB</small></h3>
        </div>

        <div class="col m-1 mycard">
            <small>Average Noise</small>
            <h3 id="ov_avg"><?php echo $avg_value; ?> <small>dB</small></h3>
        </div>
    </div>
    <!-- End Short District Overview -->

    <!-- Start of Top 10 District Bar Graph -->
    <div class="mt-2">

        <h2 class="text-border-left">Top 10 Districts</h2>
        <div class="card p-2">
            <div class="row">
                <div class="col">
                    <canvas id="myChart"></canvas>
                </div>
                <div class="col">
                    <small>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>District</th>
                                    <th>Daytime</th>
                                    <th>Nighttime</th>
                                    <th>Average</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php getDistrictAvgTable($district_array, $num_of_dist); ?>
                            </tbody>
                        </table>
                    </small>
                </div>
            </div>
        </div>

        <hr>
        <div class="mt-4">
            <h2 class="text-border-left mt-3">Odisha State Dashboard</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>Name of District</th>
                        <th>Avg Noise at Daytime (in dB)</th>
                        <th>Avg Noise at Nighttime (in dB)</th>
                        <th>Average Noise (in dB)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php getDistrictAvgTable($district_array, $num_of_dist); ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Here we include our JavaScript files -->
<script type="text/javascript" src="assets/js/jquery.min.js"></script>
<script type="text/javascript" src="assets/js/chart.min.js"></script>


<!-- real time data from mysqli for mychart -->
<script>
    // for fist graph

    const ctx = document.getElementById('myChart').getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($district_array); ?>,
            datasets: [{
                label: 'Noise in dB',
                data: <?php echo json_encode($district_avg_value_array); ?>,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

<!-- show overview -->
<script type="text/javascript">
    function showDist(id) {
        $('#ov_dist').html('');
        $.ajax({
            type: 'post',
            url: 'show_dist_ajax.php',
            data: {
                dist_name: id
            },
            success: function(data) {
                $('#ov_dist').html(data);
            }
        })

    }

    function showDayValue(id) {
        $('#ov_day').html('');
        $.ajax({
            type: 'post',
            url: 'show_day_ajax.php',
            data: {
                dist_name: id
            },
            success: function(data) {
                $('#ov_day').html(data);
            }
        })
    }

    function showNightValue(id) {
        $('#ov_night').html('');
        $.ajax({
            type: 'post',
            url: 'show_night_ajax.php',
            data: {
                dist_name: id
            },
            success: function(data) {
                $('#ov_night').html(data);
            }
        })
    }

    function showAvgValue(id) {
        $('#ov_avg').html('');
        $.ajax({
            type: 'post',
            url: 'show_avg_ajax.php',
            data: {
                dist_name: id
            },
            success: function(data) {
                $('#ov_avg').html(data);
            }
        })
    }
</script>

<?php include "includes/footer.php" ?>