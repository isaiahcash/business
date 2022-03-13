<?php

function start_page()
{
    record_access();

    ?>
    <!DOCTYPE HTML>
    <html lang="en">
    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>The Test Company</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/business/includes/css/bootstrap.css">
        <link rel="stylesheet" href="/business/includes/source/datatables/datatables.js">
        <link rel="stylesheet" href="/business/includes/source/datatables/DataTables-1.10.18/css/dataTables.bootstrap4.css">
        <link rel="stylesheet" href="/business/includes/css/font-awesome.css">

        <link rel="stylesheet" href="/business/includes/css/style.css">
    </head>
    <body>

    <?php
    navigate_home();
}

function script_includes()
{
    ?>

    <script src="/business/includes/js/jquery-3.js"></script>
    <script src="/business/includes/js/bootstrap.js"></script>
    <script src="/business/includes/js/popper.js"></script>


    <script src="/business/includes/source/datatables/datatables.js"></script>
    <script src="/business/includes/source/datatables/DataTables-1.10.18/js/dataTables.bootstrap4.js"></script>

    <script src="/business/includes/js/scripts.js"></script>

    <?php
}

function end_page()
{
    ?>
    </body>
    </html>
    <?php
}

function nav_bar()
{
    
    $pages = array(
        array("/business/index.php", "Home", ""),
        array("/business/about.php", "About Us", ""),
        array("/business/companies.php", "Companies", ""),
        array("/business/solutions.php","Solutions", ""),
        array("/business/posts.php", "Posts", ""),
        array("/business/contact.php", "Contact", "")
    );

    $current = basename($_SERVER['PHP_SELF']);

    foreach($pages as &$page)
    {
        if($page[0] == $current)
        {
            $page[2] = " active";
        }
    }

    ?>

    <nav class="navbar navbar-expand-lg navbar-light bg-custom navbar-fixed sticky-top">
        <a class="navbar-brand hidden-sm-down" href="/business/index.php">
            <div class="d-inline-block d-sm-none">TTC</div>
            <div class="d-none d-sm-inline-block">The Test Company</div>

        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item <?php echo $pages[0][2]; ?> mx-3">
                    <a class="nav-link" href="<?php echo $pages[0][0]; ?>"><?php echo $pages[0][1]; ?></a>
                </li>
                <li class="nav-item <?php echo $pages[1][2]; ?> mx-3">
                    <a class="nav-link" href="<?php echo $pages[1][0]; ?>"><?php echo $pages[1][1]; ?></a>
                </li>
                <li class="nav-item <?php echo $pages[2][2]; ?> mx-3">
                    <a class="nav-link" href="<?php echo $pages[2][0]; ?>"><?php echo $pages[2][1]; ?></a>
                </li>
                <li class="nav-item <?php echo $pages[3][2]; ?> mx-3">
                    <a class="nav-link" href="<?php echo $pages[3][0]; ?>"><?php echo $pages[3][1]; ?></a>
                </li>
                <li class="nav-item <?php echo $pages[4][2]; ?> mx-3">
                    <a class="nav-link" href="<?php echo $pages[4][0]; ?>"><?php echo $pages[4][1]; ?></a>
                </li>
                <li class="nav-item <?php echo $pages[5][2]; ?> mx-3">
                    <a class="btn btn-contact" href="<?php echo $pages[5][0]; ?>"><?php echo $pages[5][1]; ?></a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="site">

    <?php

}

function footer()
{
    ?>
    </div>
    <button onclick="topFunction()" id="top_button" title="Go to top"> <i class="fa fa-angle-up"></i></button>
    <footer class="page-footer bg-dark text-light pt-4">
        <div class="container-fluid text-center text-md-left pb-4">
            <div class="row gpc-custom-links">
                <div class="col-md-6 col-lg-4 mt-md-0 mt-3">
                    <div class="card p-2 mb-2">
                        <div class="card-body">
                            <p class="text-muted my-4 business-cl-alt">
                                <?php print_content("footer"); ?>
                            </p>
                        </div>
                    </div>

                </div>
                <hr class="w-100 d-md-none pb-3">
                <div class="col-md-6 col-lg-8">
                    <div class="row">

                        <div class="col-md-4 mb-md-0 mb-1">
                            <div class="my-2">Navigation</div>
                            <ul class="list-unstyled footer-links">
                                <li class="business-cl">
                                    <a href="/business/index.php">Home</a>
                                </li>
                                <li class="business-cl">
                                    <a href="/business/about.php">About Us</a>
                                </li>
                                <li class="business-cl">
                                    <a href="/business/companies.php">Companies</a>
                                </li>
                                <li class="business-cl">
                                    <a href="/business/solutions.php">Solutions</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-4 mb-md-0 mb-1">
                            <div class="my-2">&nbsp</div>
                            <ul class="list-unstyled footer-links">
                                <li class="business-cl">
                                    <a href="/business/contact.php">Contact</a>
                                </li>
                                <li class="business-cl">
                                    <a href="/business/careers.php">Careers</a>
                                </li>
                                <li class="business-cl">
                                    <a href="/business/posts.php">Posts</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-4 mb-md-0 mb-1">
                            <div class="my-2">&nbsp</div>

                            <ul class="list-unstyled footer-links">

                                <li class="business-cl">
                                    <a href="/business/imprint.php">Imprint</a>
                                </li>
                                <li class="business-cl">
                                    <a href="/business/admin/admin.php">Admin</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="footer-copyright text-center py-3 business-bg">
            © The Test Company <?php echo date('Y'); ?>
            <br>
            <p>Created by Isaiah Cash</p>
        </div>

    </footer>
    <?php
}

function start_content($full_width = null)
{

    $flag = 1;
    if($_SERVER["REQUEST_URI"] == "/" || $_SERVER["REQUEST_URI"] == "" || $_SERVER["REQUEST_URI"] == "/index.php" || $_SERVER["REQUEST_URI"] == "/business" || $_SERVER["REQUEST_URI"] == "/business/" || $_SERVER["REQUEST_URI"] == "/business/index.php") $flag = 0;
    $crumbs = explode("/",$_SERVER["REQUEST_URI"]);
    array_shift($crumbs);

    if($full_width)
    {
        ?>
        <div class="container-fluid mt-0 px-0">
        <div class="clearfix">
        <div class="col px-0" style="min-height: 800px">
        <?php
    } else {
        ?>
        <div class="container-fluid">
        <div class="row">
        <div class="col main-content">
        <?php
    }

    if($flag)
    {
        ?>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/business/index.php">Home</a></li>
                <?php
                for($i = 1; $i < count($crumbs); $i ++)
                {
                    $url = $crumbs[$i];
                    $name = ucfirst(str_replace(array(".php","_"),array(""," "),$crumbs[$i]));

                    if($i == (count($crumbs) - 1))
                    {
                        if(strpos($url, "companies_single.php") !== false)
                        {
                            $id = intval(substr($url, strpos($url, "?id=") + 4));
                            $sql = "SELECT full_name FROM companies WHERE id = :id";
                            $query = DB::query($sql, array("id" => $id));
                            $result = $query -> fetch(PDO::FETCH_ASSOC);
                            $name = $result['full_name'];
                        }
                        elseif(strpos($url, "solutions_single.php") !== false)
                        {
                            $id = intval(substr($url, strpos($url, "?id=") + 4));
                            $sql = "SELECT full_name FROM products WHERE id = :id";
                            $query = DB::query($sql, array("id" => $id));
                            $result = $query -> fetch(PDO::FETCH_ASSOC);
                            $name = $result['full_name'];
                        }
                        elseif(strpos($url, "posts_single.php") !== false)
                        {
                            $id = intval(substr($url, strpos($url, "?id=") + 4));
                            $sql = "SELECT title FROM posts WHERE id = :id";
                            $query = DB::query($sql, array("id" => $id));
                            $result = $query -> fetch(PDO::FETCH_ASSOC);
                            $name = $result['title'];
                        }
                        elseif(strpos($url, "contact.php") !== false)
                        {
                            $name = "Contact";
                        }
                        if(strpos($url, "careers.php") !== false)
                        {
                            $name = "Careers";
                        }

                        print "<li class='breadcrumb-item'>" . $name . "</li>";
                    }
                    else
                    {
                        if($url == "companies") $url = "/business/companies.php";
                        elseif($url == "solutions") $url = "/business/solutions.php";
                        elseif($url == "posts") $url = "/business/posts.php";
                        print "<li class='breadcrumb-item'><a href='" . $url . "'>" . $name . "</a></li>";
                    }
                }
                ?>
            </ol>
        </nav>



        <?php
    }


}

function end_content()
{

    ?>
    </div>
    </div>
    </div>
    <?php
}

function print_content($field)
{
    $sql = "SELECT * FROM text_content WHERE field = :field";
    $query = DB::query($sql, array("field" => $field));
    $content = $query -> fetch();
    if($content == false) print "This content is in development.";
    else print $content['content'];
}

function check_user()
{
    if(!$_SESSION['admin']) {
        header("Location: ../login.php");
    }

}

function get_IP()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

function record_access()
{


    $ip = get_IP();
    $url = $_SERVER['REQUEST_URI'];
    $access_time = time();

    $params = array(
        "ip_address" => $ip
    );
    $sql = "SELECT id, block_access, page_visits FROM known_clients WHERE ip_address = :ip_address";
    $query = DB::query($sql, $params);
    $result = $query->fetch(PDO::FETCH_ASSOC);

    if($result !== false) {
        $page_visits = intval($result['page_visits']) + 1;
        $params = array(
            "page_visits" => $page_visits,
            "last_accessed" => $access_time,
            "id" => $result['id']
        );
        $sql = "UPDATE known_clients SET page_visits = :page_visits, last_accessed = :last_accessed WHERE id = :id";
        $query = DB::query($sql, $params);
    }
    else
    {
        $page_visits = 1;
        $params = array(
            "ip_address" => $ip,
            "block_access" => 0,
            "page_visits" => $page_visits,
            "last_accessed" => $access_time,
            "ip_info" => "",
            "client_name" => ""
        );
        $sql = "INSERT INTO known_clients (ip_address, block_access, page_visits, last_accessed, ip_info, client_name) VALUES (:ip_address, :block_access, :page_visits, :last_accessed, :ip_info, :client_name)";
        $query = DB::query($sql, $params);
    }

    $params = array(
        "ip_address" => $ip,
        "requested_url" => $url,
        "access_time" => $access_time
    );

    $sql = "INSERT INTO access_log (ip_address, access_time, requested_url) VALUES (:ip_address, :access_time, :requested_url)";
    $query = DB::query($sql, $params);

}

function admin_start_content()
{
    $pages = array(
        array("admin.php", "Settings", ""),
        array("admin_home.php", "Home Page", ""),
        array("admin_posts.php", "Posts", ""),
        array("admin_users.php", "Users", ""),
        array("admin_text_content.php", "Text Content", ""),
        array("admin_employees.php", "Employees", ""),
        array("admin_companies.php","Companies", ""),
        array("admin_solutions.php","Solutions", ""),
        array("admin_access.php","Known Clients & Access Log", "")

    );

    $current = basename($_SERVER['PHP_SELF']);

    foreach($pages as &$page)
    {
        if($page[0] == $current)
        {
            $page[2] = " active";
        }
    }

    ?>
    <style>
        body{
            min-width: 1000px;
            width: auto !important;
        }
    </style>
    <a href="../logout.php" class="btn btn-danger float-right mt-1 mr-1">Logout</a>
    <a href="../index.php" class="btn btn-primary float-right mt-1 mr-1">Home Page</a>
    <div class="container-fluid">
    <div class="row">
    <div class="col-2">
        <div class="list-group mt-5">
            <a href="<?php echo $pages[0][0]; ?>" class="list-group-item list-group-item-action <?php echo $pages[0][2]; ?>"><?php echo $pages[0][1]; ?></a>
            <a href="<?php echo $pages[1][0]; ?>" class="list-group-item list-group-item-action <?php echo $pages[1][2]; ?>"><?php echo $pages[1][1]; ?></a>
            <a href="<?php echo $pages[2][0]; ?>" class="list-group-item list-group-item-action <?php echo $pages[2][2]; ?>"><?php echo $pages[2][1]; ?></a>
            <a href="<?php echo $pages[3][0]; ?>" class="list-group-item list-group-item-action <?php echo $pages[3][2]; ?>"><?php echo $pages[3][1]; ?></a>
            <a href="<?php echo $pages[4][0]; ?>" class="list-group-item list-group-item-action <?php echo $pages[4][2]; ?>"><?php echo $pages[4][1]; ?></a>
            <a href="<?php echo $pages[5][0]; ?>" class="list-group-item list-group-item-action <?php echo $pages[5][2]; ?>"><?php echo $pages[5][1]; ?></a>
            <a href="<?php echo $pages[6][0]; ?>" class="list-group-item list-group-item-action <?php echo $pages[6][2]; ?>"><?php echo $pages[6][1]; ?></a>
            <a href="<?php echo $pages[7][0]; ?>" class="list-group-item list-group-item-action <?php echo $pages[7][2]; ?>"><?php echo $pages[7][1]; ?></a>
            <a href="<?php echo $pages[8][0]; ?>" class="list-group-item list-group-item-action <?php echo $pages[8][2]; ?>"><?php echo $pages[8][1]; ?></a>
        </div>
        <br>
        <div id="alert_area"></div>
    </div>
    <div class="col-10 mt-5">

    <?php
}

function admin_end_content()
{
    ?>
    <button onclick="topFunction()" id="top_button" title="Go to top"> <i class="fa fa-angle-up"></i></button>
    </div>
    </div>
    </div>

    <?php
}

function image_update($type, $data)
{

    $tmp = array(); // array within data array
    $message = ""; // holds messages
    $upload_flag = 0; // if upload continues through code successful
    $upload_new = 0; // if file was selected to upload
    $target_dir = "/var/www/html/isaiahcash/business/images/" . $type . "/";

    // if file is being uploaded
    if((isset($_FILES['edit_new_image']) && $_FILES['edit_new_image']['size'] > 0)) {
        // set the variables to true
        $upload_new = 1;
        $upload_flag = 1;

        // get the target directory
        $target_file = $target_dir . basename($_FILES["edit_new_image"]["name"]);

        //get the file type of the current image
        $image_file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // check if image file is an actual image or fake image
        if (isset($_POST["submit"])) {
            $check = getimagesize($_FILES["edit_new_image"]["tmp_name"]);
            if ($check !== false) {
                $upload_flag = 1;
            } else {
                $message = "File is not an image.";
                $upload_flag = 0;
            }
        }

        // check file size
        if ($_FILES["edit_new_image"]["size"] > $_SESSION['max_file_size']) {
            $message = "Sorry, your file is too large.";
            $upload_flag = 0;
        }
        // allow certain file formats
        if ($image_file_type != "jpg" && $image_file_type != "png" && $image_file_type != "jpeg") {
            $message = "Sorry, only JPG, JPEG, & PNG files are allowed.";
            $upload_flag = 0;
        }
        // if everything is ok, try to upload file
        if ($upload_flag == 1) {

            if (move_uploaded_file($_FILES["edit_new_image"]["tmp_name"], $target_file)) {

                // get the old file and remove it
                $params = array(
                    "id" => $_POST['id_hidden'],
                );
                $sql = "SELECT image_url FROM " . $type . " WHERE id = :id";
                $query = DB::query($sql, $params);
                $result = $query -> fetch();
                // if there was an image, unlink (remove) it
                if($result['image_url'] != "")
                {
                    unlink($target_dir . $result['image_url']);
                }

                // add new image url to database
                $params = array(
                    "id" => $_POST['id_hidden'],
                    "image_url" => basename($_FILES["edit_new_image"]["name"])
                );

                $sql = "UPDATE " . $type . " SET image_url = :image_url WHERE id = :id";
                $query = DB::query($sql, $params);

                // database was updated
                if($query != false)
                {
                    $upload_flag = 1;
                    $message = "The file " . basename($_FILES["edit_new_image"]["name"]) . " has been uploaded.";
                }
                // database wasn't updated
                else {
                    $upload_flag = 0;
                    $message = "Error uploading filea.";
                }
                // if the file could not be found or directory has incorrect permissions
            } else {
                $upload_flag = 0;
                $message = "Error uploading file. Temporary file could not be moved.";
            }
        }
    }

    // set an alert for success/fail of upload
    if($upload_new == 1)
    {
        if($upload_flag == 1) $tmp[] = true;
        else $tmp[] = false;
        $tmp[] = $message;
        $data[] = $tmp;
    }

    return $data;
}

function image_create($type, $id, $data)
{
    $tmp = array(); // array within data array
    $message = ""; // holds messages
    $upload_flag = 0; // if upload continues through code successful
    $upload_new = 0; // if file was selected to upload
    $target_dir = "/var/www/html/isaiahcash/business/images/" . $type . "/";


    // if file is being uploaded
    if((isset($_FILES['create_new_image']) && $_FILES['create_new_image']['size'] > 0)) {

        // set the variables to true
        $upload_new = 1;
        $upload_flag = 1;

        // get the target directory
        $target_file = $target_dir . basename($_FILES["create_new_image"]["name"]);
        //get the file type of the current image
        $image_file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // check if image file is an actual image or fake image
        if (isset($_POST["submit"])) {
            $check = getimagesize($_FILES["create_new_image"]["tmp_name"]);
            if ($check !== false) {
                $upload_flag = 1;
            } else {
                $message = "File is not an image.";
                $upload_flag = 0;
            }
        }

        // check file size
        if ($_FILES["create_new_image"]["size"] > $_SESSION['max_file_size']) {
            $message = "Sorry, your file is too large.";
            $upload_flag = 0;
        }
        // allow certain file formats
        if ($image_file_type != "jpg" && $image_file_type != "png" && $image_file_type != "jpeg") {
            $message = "Sorry, only JPG, JPEG, & PNG files are allowed.";
            $upload_flag = 0;
        }
        // if everything is ok, try to upload file
        if ($upload_flag == 1) {
            if (move_uploaded_file($_FILES["create_new_image"]["tmp_name"], $target_file)) {

                // add new image url to database
                $params = array(
                    "id" => $id,
                    "image_url" => basename($_FILES["create_new_image"]["name"])
                );

                $sql = "UPDATE " . $type . " SET image_url = :image_url WHERE id = :id";
                $query = DB::query($sql, $params);

                // database was updated
                if($query != false)
                {
                    $upload_flag = 1;
                    $message = "The file " . basename($_FILES["create_new_image"]["name"]) . " has been uploaded.";
                }
                // database wasn't updated
                else {
                    $upload_flag = 0;
                    $message = "Error uploading file.";
                }
                // if the file could not be found or directory has incorrect permissions
            } else {
                $upload_flag = 0;
                 $message = "Error uploading file. Temporary file could not be moved.";
            }
        }
    }

    // set an alert for success/fail of upload
    if($upload_new == 1)
    {
        if($upload_flag == 1) $tmp[] = true;
        else $tmp[] = false;
        $tmp[] = $message;
        $data[] = $tmp;
    }

    return $data;
}

function alert_message()
{
    if(isset($_GET['err'])) {
        if ($_GET['err'] == "0") return array("Thank you! We will be in touch shortly.", "success");
        elseif ($_GET['err'] == "1") return array("There was an error with your request. Please try again later.", "danger");
    }
    return "";
}

function alert_message_show($alert_msg)
{
    if(is_array($alert_msg)) {
        print "<div class='alert alert-" . $alert_msg[1] . "' role='alert'>" . $alert_msg[0] . "</div>";

    }
    return;
}

function get_setting($setting_name)
{
    $sql = "SELECT * FROM admin_settings";
    $query = DB::query($sql);
    $results = $query -> fetchAll(PDO::FETCH_ASSOC);

    foreach($results as $result)
    {
        if($result['setting_name'] == $setting_name) return $result['setting_value'];
    }

    return "";
}

function save_setting($setting_name)
{
    if(isset($_POST[$setting_name])) {
        if ($_POST[$setting_name] != "") {

            $params = array(
                "setting_name" => $setting_name,
                "setting_value" => $_POST[$setting_name]
            );
            $sql = "UPDATE admin_settings SET  setting_value = :setting_value WHERE setting_name = :setting_name";
            $query = DB::query($sql, $params);

            if($query !== false) alert_message_show(array("Successfully updated " . $setting_name, "success"));
            else alert_message_show(array("Failed to update " . $setting_name, "danger"));

        }
    }
}

function retrieve_slide_options()
{
    $range = range(1, 100);

    $sql = "SELECT * FROM home";
    $query = DB::query($sql);
    $results = $query -> fetchAll(PDO::FETCH_ASSOC);

    foreach($results as $result)
    {
        if(intval($result['slide_position']) > 0)
        {
            $taken_pos = intval($result['slide_position']);
            unset($range[$taken_pos - 1]);
        }
    }

    return $range;
}


function send_mail($subject, $msg)
{
    $sql = "SELECT setting_value FROM admin_settings WHERE setting_name = 'form_email'";
    $query = DB::query($sql);
    $result = $query -> fetch(PDO::FETCH_ASSOC);
    $to = $result['setting_value'];

    $headers = "";
    $headers .= "Reply-To: Business Site <isaiahcash.web@gmail.com>\r\n";
    $headers .= "Return-Path: Business Site <isaiahcash.web@gmail.com>\r\n";
    $headers .= "From: Business Site <isaiahcash.web@gmail.com>\r\n";

    $headers .= "Organization: isaiahcash.com\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
    $headers .= "X-Priority: 3\r\n";
    $headers .= "X-Mailer: PHP". phpversion() ."\r\n";

    $check = mail($to, $subject, $msg, $headers);
}