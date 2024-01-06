<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/zip');

header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');

include('../../../config/config.php');
$file = DATA_PATH.trim($_GET['path']);
$action = trim($_GET['act']);
if ($action == 'save') {
    saveImg();
}
if ($action == 'sent') {
    fileStream();
}