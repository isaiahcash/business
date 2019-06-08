<?php
require_once('../../config.php');
check_user();

$data = array(); // array sent back to ajax
$data = image_update("employees", $data);

// upload the rest of the form data to database
$params = array(
    "id" => $_POST['id_hidden'],
    "full_name" => $_POST['edit_full_name'],
    "position" => $_POST['edit_position'],
    "info1" => $_POST['edit_info1'],
    "info2" => $_POST['edit_info2'],
    "info3" => $_POST['edit_info3']
);

$sql = "UPDATE employees SET full_name = :full_name, position = :position, info1 = :info1, info2 = :info2, info3 =:info3 WHERE id = :id";
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
