<?php include "includes/db_con.php"; ?>
<?php

function addNewDistrict($district_name)
{
    global $connection;
    $add_dist_query = "INSERT INTO districts (district_name) SELECT '$district_name' WHERE NOT EXISTS(select * from districts where district_name='$district_name')";
    $dist_added = mysqli_query($connection, $add_dist_query);

    if ($dist_added == true) {
        $_SESSION['added_district']='District added Successfully';
    } else {
        echo 'Error : ' . mysqli_error($connection);
    }
}

function getDistrictInTableForm()
{
    global $connection;
    $query = "SELECT * FROM districts";
    $result = mysqli_query($connection, $query);

    if ($result == true) {
        while ($district_row = mysqli_fetch_assoc($result)) {

            $dist_id = $district_row["district_id"];
            $dist_name = $district_row["district_name"];

            echo "<tr>";
            echo "<td>{$dist_id}</td>";
            echo "<td>{$dist_name}</td>";
            echo "</tr>";
        }
    } else {
        echo 'Error : ' . mysqli_error($connection);
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

function addNewBlock($dist_name, $block_name)
{
    global $connection;
    $checkin = "SELECT * FROM block WHERE district_name='$dist_name' and block_name='$block_name'";
    $checkin_q = mysqli_query($connection, $checkin);
    if (mysqli_num_rows($checkin_q) > 0) {
        $_SESSION['block_exist']="Block Already Exists";
    } else {
        $add_block_query = "INSERT INTO block (district_name, block_name) VALUES ('$dist_name', '$block_name')";
        $block_added = mysqli_query($connection, $add_block_query);
        if ($block_added == true) {
            $_SESSION['block_added']='Block Added Successfully';
        } else {
            echo 'Error : ' . mysqli_error($connection);
        }
    }
}
function getBlockInOptionForm($dist_name)
{
    global $connection;
    $query = "SELECT * FROM block WHERE district_name = '$dist_name' ORDER BY block_name";
    $result = mysqli_query($connection, $query);

    if ($result->num_rows > 0) {
        echo "<option value=''>--Select--</option>";
        while ($row = mysqli_fetch_assoc($result)) {
            $block_name = $row["block_name"];
            echo "<option value='{$block_name}'>{$block_name}</option>";
        }
    } else {
        echo "<option>No Record Found!</option>";
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

function district_added()
{
    echo '<div class="alert alert-success">';
    echo '<p>' . $_SESSION['added_district'] . '</p></div>';
    unset($_SESSION['added_district']);
}
function block_added()
{
    echo '<div class="alert alert-success">';
    echo '<p>' . $_SESSION['block_added'] . '</p></div>';
    unset($_SESSION['block_added']);
}
function block_exist()
{
    echo '<div class="alert alert-danger">';
    echo '<p>' . $_SESSION['block_exist'] . '</p></div>';
    unset($_SESSION['block_exist']);
}
?>
