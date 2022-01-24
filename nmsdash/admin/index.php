<?php include "includes/db_con.php"; ?>
<?php include "includes/header.php"; ?>
<?php include "admin_functions.php"; ?>
<?php if(!isset($_SESSION['district_name'])){
    header('location:../index.php');
}?>
<?php

if (isset($_POST['upload'])) {

    $dist_name = $_SESSION['district_name'];
    $block_name = $_POST['card_block'];
    $date = $_POST['card_date'];

    $day_value = rand(400, 600) / 10;
    $night_value = rand(340, 450) / 10;
    $average = ($day_value + $night_value) / 2;

    /* query for cheecking the value is exists or not */
    $rtq = "SELECT * FROM noise_value where district_name='$dist_name' and block_name='$block_name' and date='$date'";

    $wrq = mysqli_query($connection, $rtq);
    if (mysqli_num_rows($wrq) > 0) {
        $_SESSION['exist'] = 'Data Already Exists';
        data_exists();
        header('refresh:2');
        
    } else {
   
        $query = "INSERT INTO noise_value (district_name, block_name, day_value, night_value, date, average) VALUES ('$dist_name','$block_name','$day_value', '$night_value', '$date', '$average')";

        $result = mysqli_query($connection, $query);

        if ($result == true) {
            $_SESSION['added'] = "Data Successfully Added";
            header('refresh:2');
            data_added();
        } else {
            echo "Query failed " . mysqli_error($connection);
        }
    }
}
?>


<?php

if ($_SESSION['district_name'] == "Admin") {
    include "admin_control_panel.php";
} else {
    $dname = $_SESSION['district_name'];
    $query = "SELECT * FROM block WHERE district_name = '$dname' ORDER BY block_name";
    $result = mysqli_query($connection, $query);

    if ($result->num_rows > 0) {
?>
        <div class="row m-5">
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                $block_name = $row['block_name'];
            ?>
                <div class='col-sm-3 mt-2'>
                    <form action='' method='post'>
                        <div class='card'>
                            <div class='card-body'>
                                <h4><?php echo $block_name; ?></h4>
                                <hr>
                                <input type='text' name='card_block' value=<?php echo $block_name; ?> class="form-control" readonly>
                                <br>
                                <input type='date' name='card_date' id='date' class="form-control">
                                <br>

                                <input type='submit' name="upload" class="btn btn-sm btn-primary" value='Upload'>

                            </div>
                        </div>
                    </form>
                </div>

            <?php

            } ?>

        </div>
<?php
    } else {
        echo "No Data Found!!! " . mysqli_error($connection);
    }
}
?>


<?php include "includes/footer.php"; ?>