<?php
require_once('../../config.php');
check_user();

$data = array();

$params = array("id" => $_POST['id']);
$sql = "SELECT * FROM text_content WHERE id = :id";
$query = DB::query($sql, $params);
$result = $query -> fetch(PDO::FETCH_ASSOC);

$data = $result;

echo json_encode($data);
