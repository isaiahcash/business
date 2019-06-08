<?php
require_once('../../config.php');
check_user();

$data = array(); // array sent back to ajax
$tmp = array(); // array within data array
if($_POST['create_username'] != "" && $_POST['create_password'] != "") {

    $params = array(
        "username" => strtolower($_POST['create_username']),
    );
    $sql = "SELECT id FROM admins WHERE username = :username";
    $query = DB::query($sql, $params);
    $result = $query->fetch();
    if ($result != false) {
        $tmp[] = false;
        $tmp[] = "Username already exits.";
        $data[] = $tmp;
        echo json_encode($data);
        die;
    }


    $params = array(
        "username" => strtolower($_POST['create_username']),
        "password" => hash('sha256', $_POST['create_password'])
    );
    $sql = "INSERT INTO admins (username, password) VALUES (:username, :password)";
    $query = DB::query($sql, $params);

// set an alert for success/fail database update for form data
    if ($query != false) {
        $tmp[] = true;
        $tmp[] = "Successfully created data.";
    } else {
        $tmp[] = false;
        $tmp[] = "Error creating data.";
    }
    $data[] = $tmp;
}
else {
    $tmp[] = false;
    $tmp[] = "Error updating data. Fields were empty.";
    $data[] = $tmp;
}

// return to ajax
echo json_encode($data);
