<?php
require_once('config.php');

start_page();
nav_bar();
start_content();
?>
    <h3>Posts</h3>
    <p><?php print_content("posts"); ?></p>
    <hr>
    <div class="col-xs-12 col-sm-10 col-md-8 col-lg-6 mx-auto">
        <?php
        $sql = "SELECT * FROM posts ORDER BY id DESC";
        $query = DB::query($sql);
        $posts = $query -> fetchAll(PDO::FETCH_ASSOC);
        foreach($posts as $post) {
            ?>

            <div class="card mb-4 text-center">
                <?php
                if ($post['image_url'] != "") {
                    print "<img class='card-img-top' src='/business/images/posts/" . $post['image_url'] . "' alt='" . $post['title'] . "'>";
                }
                ?>
                <div class="card-body" >
                    <h2 class="card-title"><?php print $post['title']; ?></h2>

                    <?php
                    $read_flag = 0;
                    if(strlen($post['content']) > 100){
                        $post['content'] = substr($post['content'], 0, 100) . "...";
                        $read_flag = 1;
                    }
                    ?>
                    <p class="card-text"><?php print $post['content']; ?></p>
                    <?php
                    if($read_flag) {
                        ?>
                        <a href = "/business/posts/posts_single.php?id=<?php echo $post['id']; ?>" class="btn business-bg">Read More</a >
                        <?php
                    }
                    ?>
                </div>
                <div class="card-footer text-muted">
                    Posted on <?php print $post['uploaded']; ?>
                </div >
            </div >
            <?php
        }
        ?>
    </div>
<?php
end_content();
footer();
script_includes();
end_page();