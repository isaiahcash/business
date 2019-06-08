<?php
require_once('../../config.php');
check_user();

$data = array(); // array sent back to ajax
$data = image_update("home", $data);

// upload the rest of the form data to database
$params = array(
    "id" => $_POST['id_hidden'],
    "text_position" => $_POST['edit_text_position'],
    "text_content" => $_POST['edit_text_content'],
    "slide_position" => intval($_POST['edit_slide_position'])
);

$sql = "UPDATE home SET text_position = :text_position, text_content = :text_content, slide_position = :slide_position WHERE id = :id";
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
