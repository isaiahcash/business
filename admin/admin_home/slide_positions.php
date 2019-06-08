<?php
require_once('../../config.php');
check_user();

$data = array();
$data['slide_position_options'] = retrieve_slide_options();

echo json_encode($data);