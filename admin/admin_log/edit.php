<?php
require_once('../../config.php');
check_user();

$data = array();

$params = array("id" => $_POST['id']);
$sql = "SELECT * FROM known_clients WHERE id = :id";
$query = DB::query($sql, $params);
$result = $query -> fetch(PDO::FETCH_ASSOC);

if($result['last_accessed'] != "") $result['last_accessed'] = date("Y-m-d H:i:s", $result['last_accessed']);
else $result['last_accessed'] = "";

$data = $result;

echo json_encode($data);
