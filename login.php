<?php
require_once('config.php');
if($_SESSION['admin']) {
    header("Location: admin.php");
}
if($_POST)
{
    $params = array("username" => strtolower($_POST['username']), "password" => hash("sha256", $_POST['password']));
    $sql = "SELECT id FROM admins WHERE username = :username AND password = :password";
    $query = DB::query($sql, $params);
    $result = $query->fetch();

    if($result == false) {
        $alert_message = "Invalid entry.";
    }
    else{
        $_SESSION['admin'] = 1;
        header('location: admin/admin.php');
    }
}

start_page();
?>

    <div class="container-fluid mt-5">
        <div class="row justify-content-center">
            <div class="card col-md-6 m-3 p-3">
                <?php
                if($alert_message != ""){
                    ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $alert_message; ?>
                    </div>
                    <?php
                }
                ?>
                <form action="login.php" method="post">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Username">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>

            </div>
        </div>
    </div>


<?php
script_includes();
end_page();