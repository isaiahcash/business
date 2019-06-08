<?php
require_once('config.php');

start_page();
nav_bar();
start_content();
?>

    <h3>Solutions</h3>
    <p><?php print_content('solutions'); ?></p>
    <hr>
    <select id="company_select" name="company_select" class="custom-select" style="width: 300px">
        <option value="">All Companies</option>
        <?php
        $sql = "SELECT * FROM companies ORDER BY full_name ASC";
        $companies = DB::query($sql) -> fetchAll(PDO::FETCH_ASSOC);
        foreach($companies as $company)
            {
                $params = array("company_id" => $company['id']);
                $sql = "SELECT id FROM products WHERE company_id = :company_id";
                $solutions = DB::query($sql, $params) -> fetch(PDO::FETCH_ASSOC);
                if($solutions !== false) {
                    print "<option value='" . $company['id'] . "'>" . $company['full_name'] . "</option>";
                }
            }
        ?>
    </select>
    <hr>
    <div id="product_area">

    </div>



<?php
end_content();
footer();
script_includes();
?>
<script>
    var product_area = $("#product_area");
    var company_select = $("#company_select");

    $(document).ready(function() {
        company_select.change(function(){
            product_filter(company_select.find("option:selected").attr('value'));
        });

        product_filter(0);
    });


    function product_filter(company_id) {
        console.log(company_id);
        $.post('/business/solutions/ajax.php', {company_id: company_id},
            function (data) {
                console.log(data);
                product_area.html(JSON.parse(data));
            });
    }
</script>


<?php
end_page();