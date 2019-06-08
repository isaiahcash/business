<?php
require_once('../../config.php');
check_user();

$data = array(); // array sent back to ajax
$data = image_update("companies", $data);

// upload the rest of the form data to database
$params = array(
    "id" => $_POST['id_hidden'],
    "full_name" => $_POST['edit_full_name'],
    "description" => $_POST['edit_desc'],
    "url" => $_POST['edit_url'],
    "info1_url" => $_POST['edit_info1_url'],
    "info1_name" => $_POST['edit_info1_name'],
    "info2_url" => $_POST['edit_info2_url'],
    "info2_name" => $_POST['edit_info2_name'],
    "info3_url" => $_POST['edit_info3_url'],
    "info3_name" => $_POST['edit_info3_name'],
    "info4_url" => $_POST['edit_info4_url'],
    "info4_name" => $_POST['edit_info4_name'],

);

$sql = "UPDATE companies SET full_name = :full_name, description = :description, url = :url, info1_url = :info1_url, info1_name = :info1_name, info2_url = :info2_url, info2_name = :info2_name, info3_url = :info3_url, info3_name = :info3_name, info4_url = :info4_url, info4_name = :info4_name WHERE id = :id";
$query = DB::query($sql, $params);

// set an alert for success/fail database update for form data
$tmp = array();
if($query != false)
{
    $tmp[] = true;
    $tmp[] = "Successfully updated data.";
}
else
{
    $tmp[] = false;
    $tmp[] = "Error updating data.";
}
$data[] = $tmp;

// return to ajax
echo json_encode($data);
