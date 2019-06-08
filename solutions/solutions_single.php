<?php
require_once('../config.php');

start_page();
nav_bar();
start_content();

$params = array(
    "id" => $_REQUEST['id']
);
$sql = "SELECT * FROM products WHERE id = :id";
$query = DB::query($sql, $params);
$product = $query -> fetch(PDO::FETCH_ASSOC);
?>
    <div class="container-fluid">
        <p><?php print_content("single_solution"); ?></p>
        <hr>

        <div class="col-xs-12 col-sm-12 col-md-10 col-lg-9 mx-auto">
            <?php
            if($product != false) {

                ?>
                <div class="card">
                    <div class="card-body" >
                        <?php
                        if ($product['image_url'] != "") {
                            print "<img class='img-fluid p-3 mx-auto d-block' style='max-height: 300px; object-fit: contain' src='/business/images/products/" . $product['image_url'] . "' alt='" . $product['full_name'] . "'>";
                            print "<hr>";
                        }
                        ?>
                        <form method="post" action="/business/contact.php">
                            <input id="request_type1" name="request_type1" readonly hidden value="<?php echo $product['full_name']; ?>">
                            <button class="btn btn-success float-right" type="submit">I'm Interested</button>
                        </form>
                        <h3 class="card-title"><?php print $product['full_name']; ?></h3>
                        <br>
                        <p class="card-text"><?php print $product['description']; ?></p>
                        <br>
                        <?php
                        if($product['url'] != "")
                        {
                            print "<a class='btn btn-secondary'  target='_blank' href='" . $product['url'] . "'>Visit Website</a>";
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