<?php
require_once('../../config.php');
check_user();

$data = array(); // array sent back to ajax
$tmp = array(); // array within data array
$message = ""; // holds messages
$upload_flag = 0; // if upload continues through code successful
$upload_new = 0; // if file was selected to upload
$target_dir = __DIR__ . "/../../images/employees/";


// upload the rest of the form data to database
$params = array(
    "full_name" => $_POST['create_full_name'],
    "position" => $_POST['create_position'],
    "info1" => $_POST['create_info1'],
    "info2" => $_POST['create_info2'],
    "info3" => $_POST['create_info3']
);
$sql = "INSERT INTO employees (full_name, position, info1, info2, info3) VALUES (:full_name, :position, :info1, :info2, :info3)";
$query = DB::query($sql, $params);

// set an alert for success/fail database update for form data
if($query != false)
{
    $tmp[] = true;
    $tmp[] = "Successfully created data.";
}
else
{
    $tmp[] = false;
    $tmp[] = "Error creating data.";
}
$data[] = $tmp;

$new_id = DB::lastInsertId();

$data = image_create("employees", $new_id, $data);

// return to ajax
echo json_encode($data);
