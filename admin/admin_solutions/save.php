<?php
require_once('../../config.php');
check_user();

$data = array(); // array sent back to ajax
$data = image_update("products", $data);

// upload the rest of the form data to database
$params = array(
    "id" => $_POST['id_hidden'],
    "full_name" => $_POST['edit_full_name'],
    "description" => $_POST['edit_desc'],
    "url" => $_POST['edit_url'],
    "company_id" => $_POST['edit_company_id']
);

$sql = "UPDATE products SET full_name = :full_name, description = :description, url = :url, company_id = :company_id WHERE id = :id";
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
