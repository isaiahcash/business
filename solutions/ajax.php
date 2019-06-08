<?php
require_once('../config.php');

$company_id = $_POST['company_id'];
if(intval($company_id) > 0)
{
    $sql = "SELECT * FROM products WHERE company_id = :company_id ORDER BY full_name ASC";
    $products = DB::query($sql, array("company_id" => $company_id)) -> fetchAll(PDO::FETCH_ASSOC);
}
else
{
    $sql = "SELECT * FROM products ORDER BY full_name ASC";
    $products = DB::query($sql) -> fetchAll(PDO::FETCH_ASSOC);
}

$data = "<div class='container'>";
if(count($products) > 0)
{

    $data .= "<div class='row'>";

    foreach($products as $product)
    {

        $data .= "<a class='col-xs-12 col-sm-6 col-md-4 col-lg-3' href='/business/solutions/solutions_single.php?id=" . $product['id'] . "' style='height: 280px;'>";
        $data .= "<div class='card m-1' style='height: 250px;'>";
        if($product['image_url'] != "")
        {
            $data .= "<img class='card-img-top p-3' style='height: 130px; object-fit: contain' src='/business/images/products/" .  $product['image_url'] . "' alt=''>";
        }
        $data .= "<div class='card-body text-center' style='color: #000000'>";
        $data .= $product['full_name'];
        $data .= "</div>";
        $data .= "</div>";
        $data .= "</a>";

    }

    $data .= "</div>";
}
else
{
    $data .= "No products found.";
}
$data .= "</div>";

echo json_encode($data);
