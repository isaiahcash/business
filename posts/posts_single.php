<?php
require_once('../config.php');

start_page();
nav_bar();
start_content();

$params = array(
    "id" => $_REQUEST['id']
);
$sql = "SELECT * FROM posts WHERE id = :id";
$query = DB::query($sql, $params);
$post = $query -> fetch(PDO::FETCH_ASSOC);
?>

    <p><?php print_content("single_post"); ?></p>
    <hr>
    <div class="col-xs-12 col-sm-10 col-md-9 col-lg-7 mx-auto">
<?php
if($post != false) {

    ?>

    <div class="card mb-4 text-center">
                <?php
                if ($post['image_url'] != "") {
                    print "<img class='card-img-top' src='/business/images/posts/" . $post['image_url'] . "' alt='" . $post['title'] . "'>";
                }
                ?>
                <div class="card-body" >
                    <h2 class="card-title"><?php print $post['title']; ?></h2>


                    <p class="card-text"><?php print $post['content']; ?></p>



                </div>
                <div class="card-footer text-muted">
                    Posted on <?php print $post['uploaded']; ?>
                </div >
    </div>


    <?php
}
else {
    ?>

        <p>Post could not be found.</p>
        <?php
}
?>
    </div>
<?php
end_content();
footer();
script_includes();
end_page();