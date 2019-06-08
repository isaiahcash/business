<?php
require_once('../../config.php');
check_user();

$data = array("data" => array());

$sql = "SELECT * FROM access_log";
$query = DB::query($sql);
$result = $query -> fetchAll(PDO::FETCH_ASSOC);

foreach($result as $row)
{
    $flag = 0;
    $tmp = array();
    $current_ip = get_IP();
    if($current_ip == $row['ip_address']) $flag = 1;
    $tmp[] = $row['id'];
    if($flag) $tmp[] = $row['ip_address'] . " <div class='text-success'>(Current Browser)</div>";
    else $tmp[] = $row['ip_address'];
    $tmp[] = $row['requested_url'];
    if($row['access_time'] != "") $tmp[] =  date("Y-m-d H:i:s", $row['access_time']);
    else $tmp[] = "";
    $data['data'][] = $tmp;
}

echo json_encode($data);
