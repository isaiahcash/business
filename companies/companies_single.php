<?php
require_once('../config.php');

start_page();
nav_bar();
start_content();

$params = array(
    "id" => $_REQUEST['id']
);
$sql = "SELECT * FROM companies WHERE id = :id";
$query = DB::query($sql, $params);
$company = $query -> fetch(PDO::FETCH_ASSOC);
?>
<div class="container">
    <p><?php print_content("single_company"); ?></p>
    <hr>

    <div class="col-xs-12 col-sm-12 mx-auto">
        <?php
        if($company != false) {

            ?>

            <div class="card">

                <div class="card-body" >
                    <?php
                    if ($company['image_url'] != "") {
                        print "<img class='img-fluid p-3 mx-auto d-block' style='max-height: 300px; object-fit: contain' src='/business/images/companies/" . $company['image_url'] . "' alt='" . $company['full_name'] . "'>";
                        print "<hr>";
                    }
                    ?>
                    <form method="post" action="/business/contact.php">
                        <input id="request_type1" name="request_type1" readonly hidden value="<?php echo $company['full_name']; ?>">
                        <button class="btn btn-success float-right" type="submit">I'm Interested</button>
                    </form>
                    <h3 class="card-title"><?php print $company['full_name']; ?></h3>
                    <br>
                    <p class="card-text"><?php print $company['description']; ?></p>
                    <br>
                    <?php
                    if($company['url'] != "")
                    {
                        print "<a class='btn btn-secondary ml-1 mt-1' target='_blank' href='" . $company['url'] . "'>Visit Website</a>";
                    }
                    if($company['info1_url'] != "" && $company['info1_name'] != "")
                    {
                        print "<a class='btn btn-secondary ml-1 mt-1' target='_blank' href='" . $company['info1_url'] . "'>" . $company['info1_name'] . "</a>";
                    }
                    if($company['info2_url'] != "" && $company['info2_name'] != "")
                    {
                        print "<a class='btn btn-secondary ml-1 mt-1' target='_blank' href='" . $company['info2_url'] . "'>" . $company['info2_name'] . "</a>";
                    }
                    if($company['info3_url'] != "" && $company['info3_name'] != "")
                    {
                        print "<a class='btn btn-secondary ml-1 mt-1' target='_blank' href='" . $company['info3_url'] . "'>" . $company['info3_name'] . "</a>";
                    }
                    if($company['info4_url'] != "" && $company['info4_name'] != "")
                    {
                        print "<a class='btn btn-secondary ml-1 mt-1' target='_blank' href='" . $company['info4_url'] . "'>" . $company['info4_name'] . "</a>";
                    }

                    $params = array("id" => $company['id']);
                    $sql = "SELECT * FROM products WHERE company_id = :id";
                    $products = DB::query($sql, $params) -> fetchAll(PDO::FETCH_ASSOC);
                    if(count($products) > 0) {

                        ?>


                        <hr>
                        <h5>Featured Solutions</h5>
                        <?php
                        $data = "<div class='container-fluid'>";
                        if (count($products) > 0) {
                            $data .= "<div class='row'>";

                            foreach ($products as $product) {
                                $data .= "<a class='col-xs-12 col-sm-6 col-md-4 col-lg-3' href='/business/solutions/solutions_single.php?id=" . $product['id'] . "' style='height: 280px;'>";
                                $data .= "<div class='card' style='height: 250px;'>";
                                if ($product['image_url'] != "") {
                                    $data .= "<img class='card-img-top p-3' style='height: 130px; object-fit: contain' src='/business/images/products/" . $product['image_url'] . "' alt=''>";
                                }
                                $data .= "<div class='card-body text-center' style='color: #000000'>";
                                $data .= $product['full_name'];
                                $data .= "</div>";
                                $data .= "</div>";
                                $data .= "</a>";
                            }
                            $data .= "</div>";
                        }
                        $data .= "</div>";
                        print $data;
                    }
                        ?>


                </div>
            </div>


            <?php
        }
        else {
            ?>

            <p>Company could not be found.</p>
            <?php
        }
        ?>
    </div>
</div>
<?php
end_content();
footer();
script_includes();
end_page();