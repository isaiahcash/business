<?php
require_once('../../config.php');
check_user();

$data = array("data" => array());

$sql = "SELECT * FROM home";
$query = DB::query($sql);
$result = $query -> fetchAll(PDO::FETCH_ASSOC);

foreach($result as $row)
{
    $edit = "<button class='btn' onclick='edit(" . $row['id'] . ")'>Edit</button>";

    $tmp = array();
    $tmp[] = $row['id'];
    $tmp[] = $row['slide_position'];
    $tmp[] = $row['image_url'];
    $tmp[] = $row['text_position'];
    $tmp[] = substr(htmlentities($row['text_content']), 0, 200);
    $tmp[] = $edit;
    $data['data'][] = $tmp;
}

echo json_encode($data);
