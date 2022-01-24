<?php include "includes/db_con.php"; ?>
<?php
if ($_POST['dist_name']) {
    $dist_name = $_POST['dist_name'];
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
?>