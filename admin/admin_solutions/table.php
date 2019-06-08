<?php
require_once('../../config.php');
check_user();

$data = array("data" => array());

$sql = "SELECT * FROM products";
$query = DB::query($sql);
$result = $query -> fetchAll(PDO::FETCH_ASSOC);

$sql = "SELECT id, full_name FROM companies";
$query = DB::query($sql);
$companies = $query -> fetchAll(PDO::FETCH_ASSOC);



foreach($result as $row)
{
    $company_name = "";
    $edit = "<button class='btn' onclick='edit(" . $row['id'] . ")'>Edit</button>";

    $tmp = array();
    $tmp[] = $row['id'];
    $tmp[] = $row['full_name'];
    foreach($companies as $company)
    {
        if($company['id'] == $row['company_id'])
        {
            $company_name = $company['full_name'];
            break;
        }
    }
    $tmp[] = $company_name;
    $tmp[] = $row['image_url'];
    $tmp[] = $edit;
    $data['data'][] = $tmp;
}

echo json_encode($data);
