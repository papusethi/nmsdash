<?php include "includes/db_con.php"; ?>
<?php include "includes/header.php"; ?>
<?php include "functions.php"; ?>
<?php if (isset($_SESSION['district_name'])) {
    header('location:admin/index.php');
} ?>
<?php

if (isset($_POST['login'])) {

    $login_type = $_POST['login_radio'];
    $username = $_POST['username'];
    $passwd = $_POST['passwd'];

    switch ($login_type) {
        case "admin":
            if ($username == "admin" && $passwd == "admin") {
                echo "Admin Login Successful";
                $_SESSION['district_name'] = "Admin";
                header("location: /nmsdash/admin/index.php");
            } else {
                $_SESSION['admin_error'] = "credentials are wrong,Try again";
                header("refresh:2");
            }
            break;
        case "agent":
            $query = "SELECT * FROM loginiot WHERE username = '$username' and passwd='$passwd'";
            $result = mysqli_query($connection, $query);
            if ($result->num_rows > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $_SESSION['district_name'] = $row['district_name'];
                    header("location: /nmsdash/admin/index.php");
                }
            } else {
                $_SESSION['admin_error'] = "Invalid Creadentials!! Login failed";
                header("refresh:2");
            }
            break;
        default:
            echo "Some thing went wrong";
    }
}

?>


<div class="home-content">
    <?php
    if (isset($_SESSION['admin_error'])) {
        admin_error();
    }
    ?>
    <div class="row">

        <div class="col-sm-6">
            <form action="" method="post" class="form-control p-4">
                <h3>Login</h3>
                <br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="login_radio" id="adminRadio" value="admin" required>
                    <label class="form-check-label" for="adminRadio">Login as Admin</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="login_radio" id="agentRadio" value="agent">
                    <label class="form-check-label" for="agentRadio">Login as IoT Agent</label>
                </div>
                <br>
                <br>

                <label for="username">Enter Username</label><br>
                <input type="text" name="username" id="username" class="form-control" required>
                <br>
                <label for="passwd">Enter Password</label><br>
                <input type="text" name="passwd" id="passwd" class="form-control" required>
                <br>
                <button type="submit" name="login" class="btn btn-success form-control">Login</button>
                <br><br>
                <button type="reset" class="btn btn-warning form-control">Reset</button>

            </form>
        </div> <!-- end -->

    </div>
</div>

<?php include "includes/footer.php"; ?>