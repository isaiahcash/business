<?php
require_once('config.php');

start_page();
nav_bar();
start_content();
?>


<h3>History</h3>
<p><?php print_content("history"); ?></p>
<hr>
<h3>Team</h3>
<div class="container-fluid">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-9 col-xl-7 mx-auto">
    <div class="row">

        <?php
        $sql = "SELECT * FROM employees";
        $employees = DB::query($sql) -> fetchAll(PDO::FETCH_ASSOC);
        foreach($employees as $employee)
        {
            ?>
            <div class="col-xs-12 col-sm-6 col-md-4">
                <div class="card mb-4">
                    <img class="card-img-top mx-auto mb-3" style="height: 250px; object-fit: cover" src="/business/images/employees/<?php echo $employee['image_url']; ?>" alt="<?php echo $employee['full_name']; ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $employee['full_name']; ?></h5>
                        <p class="card-text"><?php echo $employee['position']; ?></p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <?php if($employee['info1'] != "") print "<li class=\"list-group-item\">" . $employee['info1'] . "</li>"; ?>
                        <?php if($employee['info2'] != "") print "<li class=\"list-group-item\">" . $employee['info2'] . "</li>"; ?>
                        <?php if($employee['info3'] != "") print "<li class=\"list-group-item\">" . $employee['info3'] . "</li>"; ?>
                    </ul>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
    </div>
</div>




<?php
end_content();
footer();
script_includes();
end_page();