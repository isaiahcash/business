<?php
require_once('../../config.php');
check_user();

$data = array(); // array sent back to ajax
$tmp = array(); // array within data array
$message = ""; // holds messages
$upload_flag = 0; // if upload continues through code successful
$upload_new = 0; // if file was selected to upload
$target_dir = __DIR__ . "/../../images/products/";


// upload the rest of the form data to database
$params = array(
    "full_name" => $_POST['create_full_name'],
    "description" => $_POST['create_desc'],
    "url" => $_POST['create_url'],
    "company_id" => $_POST['create_company_id']
);
$sql = "INSERT INTO products (full_name, description, url, company_id) VALUES (:full_name, :description, :url, :company_id)";
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

$data = image_create("products", $new_id, $data);

// return to ajax
echo json_encode($data);
