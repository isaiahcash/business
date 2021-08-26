<?php
require_once('config.php');
record_access();
$loc = $_SERVER['HTTP_REFERER'];
$loc = strtok($loc, '?');

if(isset($_REQUEST)) {
    if (isset($_REQUEST['full_name']) && isset($_REQUEST['email_address'])) {
        $fn = $_REQUEST['full_name'];
        $email = $_REQUEST['email_address'];
        $rt = $_REQUEST['request_type'];
        $com = $_REQUEST['comments'];
        $phone = $_REQUEST['phone_number'];

        if ($rt == NULL) $rt = "";
        if ($com == NULL) $com = "";
        if ($phone == NULL) $phone = "";

        $params = array(
            "full_name" => $fn,
            "email_address" => $email,
            "phone_number" => $phone,
            "request_type" => $rt,
            "comments" => $com,
            "submit_time" => time()
        );

        $sql = "INSERT INTO contact_forms (full_name, email_address, phone_number, request_type, comments, submit_time) VALUES (:full_name, :email_address, :phone_number, :request_type, :comments, :submit_time)";
        $query = DB::query($sql, $params);

        if ($query !== false) {

            if($rt != "") $subject = "Request: " . $rt;
            else $subject = "Automated Email";

            $body = "Full Name: " . $fn . "<br>";
            $body .= "Email Address: " . $email . "<br>";
            $body .= "Phone Number: " . $phone . "<br>";
            $body .= "Request Type: " . $rt . "<br>";
            $body .= "Comments: " . $com . "<br>";

//            send_mail($subject, $body);

            header("location: " . $loc . "?err=0");
            die;
        }
    }
}

header("location: " . $loc . "?err=1");
die;

