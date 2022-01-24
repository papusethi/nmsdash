<?php include "includes/db_con.php"; ?>
<?php
if ($_POST['dist_name']) {
    $dist_name = $_POST['dist_name'];
    $query = "SELECT * FROM noise_value WHERE district_name = '$dist_name'";
    $result = mysqli_query($connection, $query);

    if ($result->num_rows > 0) {
        $sum = 0;
        $no_of_records = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            $sum += $row['night_value'];
            $no_of_records++;
        }
        $night_value = round($sum / $no_of_records, 2);
        echo "<h3>" . $night_value . "</h3>";
    } else {
        echo "<h3>NA</h3>";
    }
}
?>