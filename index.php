<?php
require_once('config.php');

start_page();
nav_bar();
start_content(1);

$sql = "SELECT * FROM home ORDER BY slide_position ASC";
$query = DB::query($sql);
$images = $query -> fetchAll();
?>

    <div id="home_carousel" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <?php
            $i = 0;
            foreach($images as $image)
            {
                if($i == 0) $flag = "class='active'";
                else $flag = "";

                print "<li data-target='#home_carousel' data-slide-to='" . $i . "' " . $flag . "></li>";
                $i++;
            }
            ?>
        </ol>
        <?php
        $i = 0;
        foreach($images as $image)
        {
            if($i == 0) $flag = "active";
            else $flag = "";

            $position = $image['text_position'];

            $style = "";
            if($position == "Top Left") $style = "top: 30px; left: 30px; margin-bottom: 30px; margin-right: 30px";
            elseif($position == "Top") $style = "top: 30px; left: 50%; margin-bottom: 30px; transform: translateX(-50%); min-width: 300px;";
            elseif($position == "Top Right") $style = "top: 30px; right: 30px; margin-bottom: 30px; margin-left: 30px";
            elseif($position == "Left") $style = "top: 50%; left: 30px; transform: translateY(-50%); margin-right: 30px";
            elseif($position == "Center") $style = "top: 50%; left: 50%; transform: translate(-50%, -50%); min-width: 300px;";
            elseif($position == "Right") $style = "top: 50%; right: 30px; transform: translateY(-50%); margin-left: 30px";
            elseif($position == "Bottom Left") $style = "bottom: 30px; left: 30px; margin-top: 30px; margin-right: 30px";
            elseif($position == "Bottom Right") $style = "bottom: 30px; right: 30px; margin-top: 30px; margin-left: 30px";
            else $style = "bottom: 30px; left: 50%; margin-top: 30px; transform: translateX(-50%); min-width: 300px;";


            print "<div class='carousel-item " . $flag . "'>";
            print "<div style='position: relative'>";
            print "<img class='d-block w-100' style='height: 600px; object-fit: cover' src='/business/images/home/" . $image['image_url'] . "' alt=''>";
            print "<div class='card card-body home-card' style='position: absolute; " . $style . "'>";
            print $image['text_content'];
            print "</div>";
            print "</div>";
            print "</div>";
            $i++;
        }

        ?>
        <a class="carousel-control-prev" href="#home_carousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#home_carousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <div class="d-block p-5 mb-5 business-bg text-white text-center font-italic" style="font-size: 18pt">
        <?php print_content("home_quote"); ?>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12 col-md-9">
                <h4>Who We Are</h4>
                <hr>
                <?php print_content("home_who_we_are"); ?>
            </div>
            <div class="col-xs-12 col-md-3">
                <h4>Recent Posts</h4>
                <hr>
                <?php
                $sql = "SELECT * FROM posts ORDER BY id DESC LIMIT 5";
                $query = DB::query($sql);
                $posts = $query -> fetchAll(PDO::FETCH_ASSOC);
                foreach($posts as $post) {
                    $link_text = $post['title'] . " - " . date("m/d", strtotime($post['uploaded']));
                    print "<a class='btn btn-post w-100 my-2 d-none d-xl-inline-flex' href='/business/posts/posts_single.php?id=" . $post['id'] . "'>" . $link_text . "</a>";
                    print "<a class='btn btn-post w-100 my-2 d-md-none' href='/business/posts/posts_single.php?id=" . $post['id'] . "'>" . $link_text . "</a>";
                    if(strlen($link_text) > 20) $link_text = substr($post['title'], 0, 20) . "...";
                    print "<a class='btn btn-post w-100 my-2 d-none d-md-inline-flex d-xl-none' href='/business/posts/posts_single.php?id=" . $post['id'] . "'>" . $link_text . "</a>";
                }

                print "<a class='btn btn-post-view-all w-100 my-2 d-none d-xl-inline-flex' href='/business/posts.php'>View All</a>";
                print "<a class='btn btn-post-view-all w-100 my-2 d-md-none' href='/business/posts.php'>View All</a>";
                print "<a class='btn btn-post-view-all w-100 my-2 d-none d-md-inline-flex d-xl-none' href='/business/posts.php'>View All</a>";

                ?>
                <br>
                <br>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <h4>Who We Serve</h4>
                <hr>
                <?php print_content("home_who_we_serve"); ?>
                <br style="margin-bottom: 200px">
            </div>
        </div>
    </div>


<?php
end_content();
footer();
script_includes();
end_page();