<?php include "includes/db_con.php"; ?>
<?php include "includes/header.php"; ?>
<?php

if (isset($_POST['register'])) {

    $username = $_POST['username'];
    $passwd = $_POST['passwd'];
    $dist_name = $_POST['district_name'];

    $query = "INSERT INTO loginiot (username, passwd, district_name) VALUES ( '$username', '$passwd','$dist_name')";
    $result = mysqli_query($connection, $query);

    if ($result == true) {
        echo "Registration Sucessfull";
    } else {
        echo "Some thing went wrong" . mysqli_error($connection);
    }
}

?>


<div class="home-content">
    <div class="row">

        <div class="col-sm-6">
            <form action="" method="post" class="form-control mt-5 p-4">
                <h3>Registration</h3>
                <br>
                <label for="dname">Select District</label>
                <select class="form-select" name="district_name" id="dname">
                    <option value="">-- Select --</option>
                    <?php

                    $q = "SELECT * FROM districts";
                    $select_district = mysqli_query($connection, $q);

                    while ($row = mysqli_fetch_assoc($select_district)) {

                        $d_name = $row['district_name'];

                        echo "<option value='{$d_name}'>{$d_name}</option>";
                    }
                    ?>
                </select>
                <br>
                <label for="cu">Create a Username</label><br>
                <input type="text" name="username" id="cu" class="form-control">
                <br>
                <label for="cp">Create a Password</label><br>
                <input type="text" name="passwd" id="cp" class="form-control">
                <br>
                <button type="submit" name="register" class="btn btn-primary form-control">Register Me</button>
                <br><br>
                <button type="reset" class="btn btn-warning form-control">Reset</button>

            </form>
        </div>
    </div>
</div>

<?php include "includes/footer.php"; ?>