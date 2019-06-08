<?php
require_once('config.php');

start_page();
nav_bar();
start_content();
?>

    <h3>Companies</h3>
    <p><?php print_content('companies'); ?></p>
    <hr>
    <div class="container">
        <div class="row">
        <?php
        $sql = "SELECT * FROM companies ORDER BY full_name ASC";
        $companies = DB::query($sql) -> fetchAll(PDO::FETCH_ASSOC);
        foreach($companies as $company)
        {
            ?>
                <a class="card col-xs-12 col-sm-6 col-md-4 col-lg-3 card-no-border"  href="/business/companies/companies_single.php?id=<?php echo $company['id']; ?>" style="height: 220px;">
                    <img class="card-img-top p-3" style="height: 130px; object-fit: contain" src="/business/images/companies/<?php echo $company['image_url']; ?>" alt="">
                    <div class="card-body text-center" style="color: #000000">
                        <?php
                        print $company['full_name'];
                        ?>
                    </div>
                </a>

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
