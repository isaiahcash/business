<?php
require_once('../../config.php');
check_user();

$data = array(); // array sent back to ajax

if(!isset($_POST['edit_blocked_access'])) $_POST['edit_blocked_access'] = 0;

// upload the rest of the form data to database
$params = array(
    "id" => $_POST['id_hidden'],
    "client_name" => $_POST['edit_client_name'],
    "block_access" => $_POST['edit_blocked_access'],
);

$sql = "UPDATE known_clients SET client_name = :client_name, block_access = :block_access WHERE id = :id";
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
