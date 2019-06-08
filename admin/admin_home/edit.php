<?php
require_once('../../config.php');
check_user();

$data = array();

$params = array("id" => $_POST['id']);
$sql = "SELECT * FROM home WHERE id = :id";
$query = DB::query($sql, $params);
$result = $query -> fetch(PDO::FETCH_ASSOC);

if($result['image_url'] == "") $result['image_url'] = "/business/images/blank.png";
else $result['image_url'] = "/business/images/home/" . $result['image_url'];
$data = $result;

$data['slide_position_options'] = retrieve_slide_options();
$data['slide_position'] = intval($data['slide_position']);

echo json_encode($data);
