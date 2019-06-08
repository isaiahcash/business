<?php
require_once('../../config.php');
check_user();

$data = array(); // array sent back to ajax
$data = image_update("posts", $data);

if($_POST['edit_title'] != "" && $_POST['edit_content'] != "") {
// upload the form data to database
    $params = array(
        "id" => $_POST['id_hidden'],
        "title" => $_POST['edit_title'],
        "content" => $_POST['edit_content']
    );

    $sql = "UPDATE posts SET title = :title, content = :content WHERE id = :id";
    $query = DB::query($sql, $params);

// set an alert for success/fail database update for form data
    $tmp = array();
    if ($query != false) {
        $tmp[] = true;
        $tmp[] = "Successfully updated data.";
    } else {
        $tmp[] = false;
        $tmp[] = "Error updating data.";
    }
    $data[] = $tmp;
}
else{
    $tmp[] = false;
    $tmp[] = "Error updating data. Fields were empty.";
    $data[] = $tmp;
}

// return to ajax
echo json_encode($data);
