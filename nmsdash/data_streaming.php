<?php include "includes/db_con.php"; ?>
<?php include "includes/header.php"; ?>
<?php include "functions.php"; ?>

<?php

$dist_name = "";
$block_name = "";
$block_status = "";

if (isset($_POST['check'])) {
    $dist_name = $_POST['district'];
    $block_name = $_POST['block'];

    $query = "SELECT * FROM block WHERE block_name = '$block_name'";
    $result = mysqli_query($connection, $query);

    if ($result->num_rows > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $block_status = $row['block_status'];
        }
    } else {
        echo "No Record Found !!!";
    }
}
?>


<div class="home-content">

    <form action="" method="post" class="form-control p-3">
        <h5 class="text-border-left">Check Block Status</h5>
        <div class="row">
            <div class="col-sm-4">
                <label for="district">Select District</label>
                <select class="form-select" name="district" id="district" onchange="fetchBlock(this.value)" required>
                    <option value="">-- Select --</option>
                    <?php getDistrictInOptionForm(); ?>
                </select>
            </div>
            <div class="col-sm-4">
                <label for="block">Select Block</label>
                <select class="form-select" name="block" id="block" required>
                    <option value="">-- Select --</option>
                </select>
            </div>
            <div class="col-sm-4">
                <br>
                <button type="submit" class="col btn btn-outline-success" name="check">Check</button>
                <button type="reset" class="col btn btn-outline-warning">Reset</button>
            </div>
        </div>
    </form>


    <div class="text-border-left mt-4">
        <h4>Live Data Streaming</h4>
    </div>

    <div class="row m-3">
        <div class="col-sm-3 card">
            <div class="bg-dark p-3">
                <h5 class="text-light text-center">IoT Device Status</h5>
            </div>
            <div class="p-3">
                <small>Status</small>
                <h6><?php echo $block_status; ?></h6>
                <small>Block</small>
                <h6><?php echo $block_name; ?></h6>
            </div>

        </div>
        <div id="responsecontainer" class="col-sm-9"></div>
    </div>
</div>

<!-- Here are the JavaScript files -->
<script type="text/javascript" src="assets/js/jquery.min.js"></script>
<script type="text/javascript" src="assets/js/chart.min.js"></script>

<script>
    var refreshId = setInterval(function() {
        $('#responsecontainer').load('live_line_data.php?block_name=<?php echo $block_name; ?>');
    }, 1000);
</script>

<script type="text/javascript">
    function fetchBlock(id) {
        $('#block').html('');
        $.ajax({
            type: 'post',
            url: 'ajaxdata.php',
            data: {
                dist_name: id
            },
            success: function(data) {
                $('#block').html(data);
            }
        })
    }
</script>

<script>
    const ctx = document.getElementById('myChart').getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($date_array); ?>,
            datasets: [{
                    label: 'Daytime Noise in dB',
                    data: <?php echo json_encode($day_value_array); ?>,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)'
                    ],
                    borderWidth: 1
                },
                {
                    label: 'Nighttime Noise in dB',
                    data: <?php echo json_encode($night_value_array); ?>,
                    backgroundColor: [
                        'rgba(153, 102, 255, 0.2)'
                    ],
                    borderColor: [
                        'rgba(153, 102, 255, 1)'
                    ],
                    borderWidth: 1
                }
            ]
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

<?php include "includes/footer.php"; ?>