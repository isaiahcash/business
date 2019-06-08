<?php
require_once('../../config.php');
check_user();

$data = array("data" => array());

$sql = "SELECT * FROM known_clients";
$query = DB::query($sql);
$result = $query -> fetchAll(PDO::FETCH_ASSOC);

foreach($result as $row)
{
    $flag = 0;
    $current_ip = get_IP();
    if($current_ip == $row['ip_address']) $flag = 1;

    if($flag) $edit = "<button class='btn' onclick='edit(" . $row['id'] . ", 1)'>Edit</button>";
    else $edit = "<button class='btn' onclick='edit(" . $row['id'] . ", 0)'>Edit</button>";

    $tmp = array();

    $tmp[] = $row['id'];
    if($flag) $tmp[] = $row['ip_address'] . " <div class='text-success'>(Current Browser)</div>";
    else $tmp[] = $row['ip_address'];
    $tmp[] = $row['client_name'];
    if($row['last_accessed'] != "") $tmp[] = date("Y-m-d H:i:s", $row['last_accessed']);
    else $tmp[] = "";
    $tmp[] = $row['page_visits'];
    if($row['block_access'] == 1) $tmp[] = "Yes";
    else $tmp[] = "No";
    $tmp[] = $edit;
    $data['data'][] = $tmp;
}

echo json_encode($data);
