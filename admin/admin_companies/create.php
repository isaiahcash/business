<?php
require_once('../../config.php');
check_user();

$data = array(); // array sent back to ajax

// upload the rest of the form data to database
$params = array(
    "full_name" => $_POST['create_full_name'],
    "description" => $_POST['create_desc'],
    "url" => $_POST['create_url'],
    "info1_url" => $_POST['create_info1_url'],
    "info1_name" => $_POST['create_info1_name'],
    "info2_url" => $_POST['create_info2_url'],
    "info2_name" => $_POST['create_info2_name'],
    "info3_url" => $_POST['create_info3_url'],
    "info3_name" => $_POST['create_info3_name'],
    "info4_url" => $_POST['create_info4_url'],
    "info4_name" => $_POST['create_info4_name']
);

$sql = "INSERT INTO companies (full_name, description, url, info1_url, info1_name, info2_url, info2_name, info3_url, info3_name, info4_url, info4_name) VALUES (:full_name, :description, :url, :info1_url, :info1_name, :info2_url, :info2_name, :info3_url, :info3_name, :info4_url, :info4_name)";
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

$data = image_create("companies", $new_id, $data);

// return to ajax
echo json_encode($data);
