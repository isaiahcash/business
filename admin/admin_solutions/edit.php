<?php
require_once('../../config.php');
check_user();

$data = array();

$params = array("id" => $_POST['id']);
$sql = "SELECT * FROM products WHERE id = :id";
$query = DB::query($sql, $params);
$result = $query -> fetch(PDO::FETCH_ASSOC);

if($result['image_url'] == "") $result['image_url'] = "/business/images/blank.png";
else $result['image_url'] = "/business/images/products/" . $result['image_url'];
$data = $result;

echo json_encode($data);
