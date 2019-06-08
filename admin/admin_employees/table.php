<?php
require_once('../../config.php');
check_user();

$data = array("data" => array());

$sql = "SELECT * FROM employees";
$query = DB::query($sql);
$result = $query -> fetchAll(PDO::FETCH_ASSOC);

foreach($result as $row)
{
    $edit = "<button class='btn' onclick='edit(" . $row['id'] . ")'>Edit</button>";

    $tmp = array();
    $tmp[] = $row['id'];
    $tmp[] = $row['full_name'];
    $tmp[] = $row['image_url'];
    $tmp[] = $edit;
    $data['data'][] = $tmp;
}

echo json_encode($data);
