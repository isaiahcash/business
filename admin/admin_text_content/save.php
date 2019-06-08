<?php
require_once('../../config.php');
check_user();

$data = array(); // array sent back to ajax
$tmp = array(); // array within data array

if($_POST['edit_content'] != "") {
    // upload the form data to database
    $params = array(
        "id" => $_POST['id_hidden'],
        "content" => $_POST['edit_content']
    );

    $sql = "UPDATE text_content SET content = :content WHERE id = :id";
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
    $tmp[] = "Error updating data. Content was empty.";
    $data[] = $tmp;
}

// return to ajax
echo json_encode($data);
