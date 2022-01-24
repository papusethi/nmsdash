<?php include "includes/db_con.php"; ?>
<?php include "admin_functions.php"; ?>
<?php include "includes/header.php"; ?>
<?php

if (isset($_POST['add_district'])) {
    $district_name = $_POST['district'];
    addNewDistrict($district_name);
    header("refresh:3");
}
?>

<div class="container-fluid">
    <?php
    if(isset($_SESSION['added_district'])){
        district_added();
    }
    ?>
    
    <div class="row mt-2">
        <div class="col-sm-6 p-5">
            <form action="" method="post" class="form-control p-4">
                <h3>Add New District</h3>
                <div class="form-group">
                    <label for="district">Enter District Name</label>
                    <input type="text" class="form-control" name="district" id="district">
                </div>
                <br>
                <button type="submit" name="add_district" class="btn btn-primary">Add District</button>
            </form>
        </div> <!-- end of col -->

        <div class="col-sm-6 p-5">
            <table class="table table-bordered table-hover text-center">
                <tr>
                    <th>District ID</th>
                    <th>District Name</th>
                </tr>

                <!-- fetch the available DISTRICTS from the database -->

                <?php getDistrictInTableForm(); ?>

            </table>
        </div>
    </div>
</div>


<?php include "includes/footer.php"; ?>