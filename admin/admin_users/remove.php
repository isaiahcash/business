<?php
require_once('../../config.php');
check_user();

$data = array();
$tmp = array();

$params = array(
    "id" => $_POST['id']
);
$sql = "DELETE FROM admins WHERE id = :id";
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
