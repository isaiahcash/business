<?php
require_once('../../config.php');
check_user();

$data = array();
$tmp = array();
$target_dir = __DIR__ . "/../../images/companies/";

// delete the image
$params = array("id" => $_POST['id']);
$sql = "SELECT image_url FROM companies WHERE id = :id";
$query = DB::query($sql, $params);
$result = $query -> fetch(PDO::FETCH_ASSOC);
// if there was an image, unlink (remove) it
if($result['image_url'] != "")
{
    unlink($target_dir . $result['image_url']);
}

$sql = "DELETE FROM companies WHERE id = :id";
$query = DB::query($sql, $params);

if($query == false)
{
    $tmp[] = false;
    $tmp[] = "Error removing data.";
}
else
{
    $tmp[] = true;
    $tmp[] = "Successfully removed data.";
}
$data[] = $tmp;

echo json_encode($data);
