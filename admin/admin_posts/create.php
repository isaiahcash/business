<?php
require_once('../../config.php');
check_user();

$data = array(); // array sent back to ajax
$tmp = array(); // array within data array
$message = ""; // holds messages
$upload_flag = 0; // if upload continues through code successful
$upload_new = 0; // if file was selected to upload
$target_dir = __DIR__ . "/../../images/posts/";

if($_POST['create_title'] != "" && $_POST['create_content'] != "") {
    $params = array(
        "title" => $_POST['create_title'],
        "content" => $_POST['create_content'],
        "uploaded" => date("m/d/Y g:i:sa")
    );
    $sql = "INSERT INTO posts (title, content, uploaded) VALUES (:title, :content, :uploaded)";
    $query = DB::query($sql, $params);

    // set an alert for success/fail database update for form data
    if ($query != false) {
        $tmp[] = true;
        $tmp[] = "Successfully created data.";
    } else {
        $tmp[] = false;
        $tmp[] = "Error creating data.";
    }
    $data[] = $tmp;
}
else
{
    $tmp[] = false;
    $tmp[] = "Error updating data. Fields were empty.";
    $data[] = $tmp;
    echo json_encode($data);
    die;
}


$new_id = DB::lastInsertId();

$data = image_create("posts", $new_id, $data);

// return to ajax
echo json_encode($data);
