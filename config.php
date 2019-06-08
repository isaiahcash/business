<?php
session_start();
$_SESSION['max_file_size'] =  10000000000000000000;
date_default_timezone_set("America/New_York");
require_once('includes/functions.php');
require_once('includes/mysql.php');
require_once('includes/credentials.php');