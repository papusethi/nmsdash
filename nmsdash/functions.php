<?php include "includes/db_con.php"; ?>
<?php

function getDistrictAvgTable($district_array, $num_of_dist)
{
    global $connection;

    for ($j = 0; $j < $num_of_dist; $j++) {

        $dname = $district_array[$j];

        $query = "SELECT * FROM noise_value WHERE district_name = '$dname'";
        $result = mysqli_query($connection, $query);

        $day_sum = 0;
        $night_sum = 0;
        $avg_sum = 0;
        $count = 0;

        if ($result->num_rows > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $day_sum += $row['day_value'];
                $night_sum += $row['night_value'];
                $avg_sum += $row['average'];
                $count++;
            }

            echo "<tr>";
            echo "<td>" . $dname . "</td>";
            echo "<td>" . round($day_sum / $count, 2) . "</td>";
            echo "<td>" . round($night_sum / $count, 2) . "</td>";
            echo "<td>" . round($avg_sum / $count, 2) . "</td>";
            echo "</tr>";
        } else {
            echo "No Data Found!!! " . mysqli_error($connection);
        }
    }
}

function getDistrictInOptionForm()
{
    global $connection;
    $query = "SELECT * FROM districts ORDER BY district_name";
    $result = mysqli_query($connection, $query);

    if ($result == true) {
        while ($row = mysqli_fetch_assoc($result)) {
            $d_name = $row['district_name'];
            echo "<option value='{$d_name}'>{$d_name}</option>";
        }
    } else {
        echo 'Error : ' . mysqli_error($connection);
    }
}

function getBlockInTableForm()
{
    global $connection;
    $query = "SELECT * FROM block ORDER BY district_name";
    $result = mysqli_query($connection, $query);

    if ($result->num_rows > 0) {
        while ($block_row = mysqli_fetch_assoc($result)) {

            $dist_name = $block_row["district_name"];
            $block_name = $block_row["block_name"];

            echo "<tr>";
            echo "<td>{$dist_name}</td>";
            echo "<td>{$block_name}</td>";
            echo "</tr>";
        }
    } else {
        echo 'Error while showing Blocks: ' . mysqli_error($connection);
    }
}

function getBlockWiseDataTable($block_name)
{
    global $connection;    
    $query = "SELECT * FROM noise_value WHERE block_name = '$block_name' ORDER BY date DESC";
    $result = mysqli_query($connection, $query);


    if ($result->num_rows > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['date'] . "</td>";
            echo "<td>" . $row['day_value'] . "</td>";
            echo "<td>" . $row['night_value'] . "</td>";
            echo "<td>" . $row['average'] . "</td>";
            echo "</tr>";
        }
    } else {
        echo "No Record Found !!!";
    }
}


function data_exists()
{
    echo '<div class="alert alert-danger">';
    echo '<p>' . $_SESSION['exist'] . '</p></div>';
    unset($_SESSION['exist']);
}

function data_added()
{
    echo '<div class="alert alert-success">';
    echo '<p>' . $_SESSION['added'] . '</p></div>';
    unset($_SESSION['added']);
}
function admin_error()
{
    echo '<div style="text:align-center" class="alert alert-danger">';
    echo '<p>' . $_SESSION['admin_error'] . '</p></div>';
    unset($_SESSION['admin_error']);
}
?>