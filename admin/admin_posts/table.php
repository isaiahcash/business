<?php
require_once('../../config.php');
check_user();

$data = array("data" => array());

$sql = "SELECT * FROM posts";
$query = DB::query($sql);
$result = $query -> fetchAll(PDO::FETCH_ASSOC);

foreach($result as $row)
{
    $edit = "<button class='btn' onclick='edit(" . $row['id'] . ")'>Edit</button>";

    $tmp = array();
    $tmp[] = $row['id'];
    $tmp[] = $row['title'];
    if(strlen($row['content']) > 50)
    {
        $row['content'] = substr($row['content'], 0, 50) . "...";
    }
    $tmp[] = $row['content'];
    $tmp[] =  date("Y-m-d H:i:s", strtotime($row['uploaded']));
    $tmp[] = $edit;
    $data['data'][] = $tmp;
}

echo json_encode($data);
