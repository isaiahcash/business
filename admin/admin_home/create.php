<?php
require_once('../../config.php');
check_user();

$data = array(); // array sent back to ajax
$tmp = array(); // array within data array
$message = ""; // holds messages
$upload_flag = 0; // if upload continues through code successful
$upload_new = 0; // if file was selected to upload
$target_dir = __DIR__ . "/../../images/home/";


// upload the rest of the form data to database
$params = array(
    "text_position" => $_POST['create_text_position'],
    "text_content" => $_POST['create_text_content'],
    "slide_position" => intval($_POST['create_slide_position'])
);
$sql = "INSERT INTO home (text_position, text_content, slide_position) VALUES (:text_position, :text_content, :slide_position)";
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

$data = image_create("home", $new_id, $data);

// return to ajax
echo json_encode($data);
