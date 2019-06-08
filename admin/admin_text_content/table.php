<?php
require_once('../../config.php');
check_user();

$data = array("data" => array());

$sql = "SELECT * FROM text_content";
$query = DB::query($sql);
$result = $query -> fetchAll(PDO::FETCH_ASSOC);

foreach($result as $row)
{
    $edit = "<button class='btn' onclick='edit(" . $row['id'] . ")'>Edit</button>";

    $tmp = array();
    $tmp[] = $row['id'];
    $tmp[] = $row['field'];
    if(strlen($row['content']) > 50)
    {
        $row['content'] = substr($row['content'], 0, 50) . "...";
    }
    $tmp[] = $row['content'];
    $tmp[] = $edit;
    $data['data'][] = $tmp;
}

echo json_encode($data);
