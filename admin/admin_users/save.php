<?php
require_once('../../config.php');
check_user();

$data = array(); // array sent back to ajax
$tmp = array(); // array within data array

if($_POST['edit_password'] != "" && $_POST['edit_username'] != "") {
// upload the form data to database
    $params = array(
        "id" => $_POST['id_hidden'],
        "username" => strtolower($_POST['edit_username']),
        "password" => hash('sha256', $_POST['edit_password'])
    );

    $sql = "UPDATE admins SET username = :username, password = :password WHERE id = :id";
    $query = DB::query($sql, $params);

// set an alert for success/fail database update for form data
    $tmp = array();
    if ($query != false) {
        $tmp[] = true;
        $tmp[] = "Successfully updated data.";
    } else {
        $tmp[] = false;
        $tmp[] = "Error updating data.";
    }
    $data[] = $tmp;
}
else{
    $tmp[] = false;
    $tmp[] = "Error updating data. Fields were empty.";
    $data[] = $tmp;
}

// return to ajax
echo json_encode($data);
